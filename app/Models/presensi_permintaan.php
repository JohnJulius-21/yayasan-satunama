<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class presensi_permintaan extends Model
{
    protected $table = 'presensi_permintaan';
    protected $fillable = ['id_presensi', 'id_permintaan', 'judul_presensi', 'qr_code'];

    protected $primaryKey = 'id_presensi';
    public function permintaan()
    {
        return $this->belongsTo(permintaan_pelatihan::class, 'id_permintaan', 'id_pelatihan_permintaan');
    }
}
