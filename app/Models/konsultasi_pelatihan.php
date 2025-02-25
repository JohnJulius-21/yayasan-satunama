<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class konsultasi_pelatihan extends Model
{
    use HasFactory;

    protected $table = 'konsultasi_pelatihan';
    protected $primaryKey = 'id_pelatihan_konsultasi';

    public $timestamps = false;

    protected $fillable = [
        'nama_pelatihan',
        'id_tema',
        'fee_pelatihan',
        'metode_pelatihan',
        'lokasi_pelatihan',
        'kuota_peserta',
        'tanggal_pendaftaran',
        'tanggal_batas_pendaftaran',
        'tanggal_mulai',
        'tanggal_selesai',
        'deskripsi_pelatihan',
    ];

    // Relasi ke tabel reguler_images
    // public function images()
    // {
    //     return $this->hasMany(RegulerImage::class, 'id_reguler', 'id_reguler');
    // }

    // // Relasi ke tabel reguler_files
    // public function files()
    // {
    //     return $this->hasMany(RegulerFile::class, 'id_reguler', 'id_reguler');
    // }

    // Relasi ke fasilitator melalui tabel pivot reguler_fasilitators
    public function fasilitators()
    {
        return $this->belongsToMany(Fasilitator::class, 'konsultasi_fasilitators', 'id_pelatihan', 'id_fasilitator');
    }
}
