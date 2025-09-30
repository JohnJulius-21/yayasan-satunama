<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ctga extends Model
{
    protected $table = 'registrasi_ctga';
    protected $primaryKey = 'id_registrasi';

    protected $fillable = [
        'nama_lembaga',
        'email_lembaga',
        'kontak_lembaga',
        'nama_pemimpin_lembaga',
        'legalitas_lembaga',
        'id_negara',
        'id_provinsi',
        'id_kabupaten',
        'alamat_lembaga',
    ];

    // Relasi
    public function negara()
    {
        return $this->belongsTo(negara::class, 'id_negara');
    }

    public function provinsi()
    {
        return $this->belongsTo(provinsi::class, 'id_provinsi');
    }

    public function kabupaten()
    {
        return $this->belongsTo(kabupaten_kota::class, 'id_kabupaten');
    }
}
