<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class gambarProyek extends Model
{
    protected $table = "gambar_proyek";
    protected $primaryKey = "id";
    protected $fillable = [
        'proyekId',
        'gambarId',
    ];
}
