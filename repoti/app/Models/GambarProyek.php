<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GambarProyek extends Model
{
    protected $table = 'gambar_proyek';
    protected $fillable = ['proyekId', 'gambarId', 'created_at', 'updated_at'];
}