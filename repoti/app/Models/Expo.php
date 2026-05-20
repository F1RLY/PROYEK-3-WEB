<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expo extends Model
{
    protected $table = 'expo';

    protected $fillable = [
        'nama',
        'deskripsi',
        'status',
        'tanggal_mulai',
        'tanggal_selesai',
    ];

    protected $casts = [
        'tanggal_mulai'   => 'datetime',
        'tanggal_selesai' => 'datetime',
    ];

    public function proyeks()
    {
        return $this->belongsToMany(Proyek::class, 'expo_proyek', 'expo_id', 'proyek_id');
    }

    public function penilaians()
    {
        return $this->hasMany(Penilaian::class, 'expo_id');
    }
}