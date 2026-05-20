<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $table = 'dosen';
    public $timestamps = false;
    
    protected $fillable = ['nama', 'NIP'];
    
    public function proyek()
    {
        return $this->hasMany(Proyek::class, 'dosenId');
    }
}