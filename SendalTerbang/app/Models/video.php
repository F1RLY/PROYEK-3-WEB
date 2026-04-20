<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class video extends Model
{
    /** @use HasFactory<\Database\Factories\VideoFactory> */
    use HasFactory;

    protected $table = 'video_proyek';
    protected $fillable = [
        'videoCode',
        'lokasi',
        'proyekId',
    ];

}
