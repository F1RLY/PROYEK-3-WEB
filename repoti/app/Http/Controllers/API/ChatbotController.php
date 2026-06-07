<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Proyek;

class ChatbotController extends Controller
{
    public function chat(Request $request)
{
    $request->validate([
        'message' => 'required|string|max:1000',
        'history' => 'nullable|array',
    ]);

    $proyek = Proyek::with(['dosen', 'kelompok'])
        ->where('verifikasi', 1)
        ->latest()
        ->take(10)
        ->get()
        ->map(function ($p) {
            $ketua = $p->kelompok->first()?->nama ?? '-';
            $dosenNama = optional($p->dosen)->nama ?? '-';
            return "- {$p->judul} | Dosen: {$dosenNama} | Ketua: {$ketua}";
        })
        ->join("\n");

    $systemPrompt = <<<EOT
Kamu adalah asisten RepoTI, platform repository tugas akhir mahasiswa IT Polindra.
Tugasmu membantu mahasiswa menemukan proyek yang relevan.

Daftar proyek yang tersedia:
{$proyek}

Jawab pertanyaan pengguna berdasarkan data di atas.
Jika tidak ada proyek relevan, sampaikan dengan sopan.
Jawab dalam Bahasa Indonesia, singkat dan ramah.
EOT;

    // Susun messages: system + history + pesan baru
    $messages = [
        ['role' => 'system', 'content' => $systemPrompt],
    ];

    // Tambahkan history (max 10 pesan terakhir agar tidak terlalu panjang)
    $history = $request->history ?? [];
    $history = array_slice($history, -10); // ambil 10 terakhir saja
    foreach ($history as $h) {
        if (isset($h['role']) && isset($h['content'])) {
            $messages[] = [
                'role'    => $h['role'],
                'content' => $h['content'],
            ];
        }
    }

    try {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('GROQ_API_KEY'),
            'Content-Type'  => 'application/json',
        ])->post('https://api.groq.com/openai/v1/chat/completions', [
            'model'      => 'llama-3.1-8b-instant',
            'max_tokens' => 500,
            'messages'   => $messages,
        ]);

        $data = $response->json();

        if (isset($data['error'])) {
            return response()->json([
                'success' => false,
                'reply'   => 'Error: ' . $data['error']['message'],
            ]);
        }

        $reply = $data['choices'][0]['message']['content'] ?? null;

        return response()->json([
            'success' => true,
            'reply'   => $reply ?? 'Tidak ada jawaban.',
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'reply'   => 'Gagal: ' . $e->getMessage(),
        ], 500);
    }
}
}