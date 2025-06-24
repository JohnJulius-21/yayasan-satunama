<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class presensi_pelatihan_permintaan extends Model
{
    protected $table = 'presensi_pelatihan_permintaan';
    protected $fillable = ['id_permintaan','id_presensi_permintaan','id_peserta', 'tanggal_presensi','qr_code'];

    protected $primaryKey = 'id_presensi';
    public $timestamps = false; // Enable timestamps if needed
}
