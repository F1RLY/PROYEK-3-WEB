<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'userID', 'angkatan', 'kelas', 'link'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'userID');
    }
    
    public function kelompok()
    {
        return $this->hasMany(Kelompok::class, 'mahasiswa');
    }
}