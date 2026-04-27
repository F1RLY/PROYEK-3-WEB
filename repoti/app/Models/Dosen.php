<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $table = 'dosen';
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'nama', 'NIP'
    ];
    
    public function proyek()
    {
        return $this->hasMany(Proyek::class, 'dosenId');
    }
}