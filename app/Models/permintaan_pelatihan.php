<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class permintaan_pelatihan extends Model
{
    use HasFactory;

    protected $table = 'permintaan_pelatihan';
    protected $primaryKey = 'id_pelatihan_permintaan';

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

    public function peserta_permintaan()
    {
        return $this->hasMany(peserta_pelatihan_permintaan::class, 'id_pelatihan_permintaan', 'id_pelatihan_permintaan');
    }

    public function permintaan()
    {
        return $this->belongsTo(permintaan::class, 'id_permintaan', 'id_permintaan');
    }

    public function tema()
    {
        return $this->belongsTo(tema::class, 'id_tema');
    }

    public function fasilitators()
    {
        return $this->belongsToMany(fasilitator::class, 'permintaan_fasilitators', 'id_pelatihan', 'id_fasilitator');
    }


}
