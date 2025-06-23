<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class presensi_reguler extends Model
{
    protected $table = 'presensi_reguler';
    protected $fillable = ['id_presensi', 'id_reguler', 'judul_presensi', 'qr_code'];

    protected $primaryKey = 'id_presensi';
    public function reguler()
    {
        return $this->belongsTo(reguler::class, 'id_reguler', 'id_reguler');
    }
}
