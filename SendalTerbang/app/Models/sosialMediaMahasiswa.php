<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class sosialMediaMahasiswa extends Model
{
    // SESUAIKAN: samakan dengan nama tabel di PHPMyAdmin Anda
    protected $table = 'mahasiswa_sosial_media'; 

    protected $fillable = [
        'mahasiswa_id', 
        'sosial_media_id', 
        'link'
    ];

    // PENTING: Matikan timestamps jika tabel tidak punya kolom created_at/updated_at
    public $timestamps = false;
}