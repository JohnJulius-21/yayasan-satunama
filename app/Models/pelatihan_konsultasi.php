<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pelatihan_konsultasi extends Model
{
    use HasFactory;
    protected $table = 'pelatihan_konsultasis';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_konsultasi', 
        'id_tema', 
        'nama_pelatihan', 
        'metode_pelatihan',
        'lokasi_pelatihan',  
        'tanggal_mulai',
        'tanggal_selesai',
        'image',
        'file',
        'deskripsi_pelatihan',
    ];


    public function fasilitator_konsultasi()
    {
        return $this->belongsToMany(fasilitator_pelatihan_test::class, 'fasilitator_konsultasis', 'id_konsultasi', 'id_fasilitator');
    }

    public function gambarkonsultasi()
    {
        return $this->hasMany(gambar_konsultasi::class, 'id_konsultasi');
    }

    public function filekonsultasi()
    {
        return $this->hasMany(file_konsultasi::class, 'id_konsultasi');
    }

    public function peserta_konsultasi()
    {
        return $this->hasMany(peserta_konsultasi::class, 'id_konsultasi');
    }
}
