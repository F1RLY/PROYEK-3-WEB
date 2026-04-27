<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proyek extends Model
{
    protected $table = 'proyek';
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'repoCode', 
        'judul', 
        'deskripsi', 
        'link', 
        'file_laporan',
        'file_ppt',
        'dosenId',
        'verifikasi',
        'proposal',    // ← tambahkan
        'laporan'      // ← tambahkan
    ];
    
    protected $attributes = [
        'proposal' => 0,
        'laporan' => 0,
        'verifikasi' => 0,
        'dosenId' => null,
        'file_ppt' => null,
    ];
    
    // Relasi
    public function kelompok()
    {
        return $this->hasMany(Kelompok::class, 'proyek');
    }
    
    public function gambars()
    {
        return $this->belongsToMany(Gambar::class, 'gambar_proyek', 'proyekId', 'gambarId');
    }
    
    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'dosenId');
    }
}