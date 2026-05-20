<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    protected $table = 'penilaian';

    protected $fillable = [
        'expo_id',
        'proyek_id',
        'nilai',
        'nama_penilai',
        'email_penilai',
        'penilai_ip',
    ];

    public function expo()
    {
        return $this->belongsTo(Expo::class, 'expo_id');
    }

    public function proyek()
    {
        return $this->belongsTo(Proyek::class, 'proyek_id');
    }
}