<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExpoProyek extends Model
{
    protected $table = 'expo_proyek';

    protected $fillable = [
        'expo_id',
        'proyek_id',
    ];

    public function expo()
    {
        return $this->belongsTo(Expo::class, 'expo_id');
    }

    public function proyek()
    {
        return $this->belongsTo(Proyek::class, 'proyek_id');
    }
}