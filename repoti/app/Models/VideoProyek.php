<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoProyek extends Model
{
    use HasFactory;

    protected $table = 'video_proyek';

    protected $fillable = [
        'videoCode',
        'lokasi',
        'proyekId',
    ];

    public function proyek()
    {
        return $this->belongsTo(Proyek::class, 'proyekId');
    }
}