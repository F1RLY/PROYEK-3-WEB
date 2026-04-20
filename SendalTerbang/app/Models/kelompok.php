<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class kelompok extends Model
{
    protected $table = "kelompok";
    protected $primaryKey = "id";

    protected $fillable = [
        'mahasiswa',
        'proyek'
    ];
}
