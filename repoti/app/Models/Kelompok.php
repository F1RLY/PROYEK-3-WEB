<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelompok extends Model
{
    protected $table = 'kelompok';
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'mahasiswa', 'proyek', 'created_at', 'updated_at'
    ];
    
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa');
    }
    
    public function proyek()
    {
        return $this->belongsTo(Proyek::class, 'proyek');
    }
}