<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SosialMediaMahasiswa extends Model
{
    protected $table = 'mahasiswa_sosial_media';
    protected $fillable = ['mahasiswa_id', 'sosial_media_id', 'link'];
}