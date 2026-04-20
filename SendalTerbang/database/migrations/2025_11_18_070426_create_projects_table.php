<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('proyek', function (Blueprint $table) {
            $table->id();
            $table->string('judul_proyek');
            $table->string('nama_anggota');
            $table->string('dosen_pembimbing');
            $table->string('mitra')->nullable();
            $table->string('angkatan')->nullable();
            $table->year('tahun_penerbit');
            $table->string('file_laporan')->nullable();
            $table->string('url_proyek')->nullable();
            $table->string('foto_proyek')->nullable();
            $table->enum('status', ['Menunggu', 'Disetujui', 'Ditolak'])->default('Menunggu');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyek');
    }
};
