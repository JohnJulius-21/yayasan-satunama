<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class presensi_pelatihan_reguler extends Model
{
    protected $table = 'presensi_pelatihan_reguler';
    protected $fillable = ['id_reguler','id_presensi_reguler','id_peserta', 'tanggal_presensi','qr_code'];

    protected $primaryKey = 'id_presensi';
    public $timestamps = false; // Enable timestamps if needed   
}
