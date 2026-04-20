<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proyek extends Model
{
    protected $table = 'proyek';
    protected $hidden = ["id"];

    protected $fillable = [
        'repoCode',
        'judul',
        'deskripsi',
        'link',
        'dosenId',
        'verifikasi',
        'proposal',
        'laporan',
    ];
    protected $casts = [
        'verifikasi' => 'boolean',
        'proposal' => 'boolean',
        'laporan' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function gambars()
    {
        return $this->belongsToMany(gambar::class, 'gambar_proyek', 'proyekId', 'gambarId');
    }

    public function kelompok()
    {
        return $this->hasMany(kelompok::class, 'proyek', 'id');
    }

}

