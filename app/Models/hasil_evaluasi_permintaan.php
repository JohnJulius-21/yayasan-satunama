<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hasil_evaluasi_permintaan extends Model
{
    use HasFactory;

    protected $table = 'hasil_evaluasi_permintaan';
    protected $primaryKey = 'id_hasil_evaluasi_permintaan';
    protected $fillable = ['content'];

    public function permintaan_pelatihan(){
        return $this->belongsTo(permintaan_pelatihan::class, 'id_permintaan_pelatihan');
    }

    public function peserta(){
        return $this->belongsTo(peserta_pelatihan_permintaan::class, 'id_peserta', 'id_peserta');
    }

}
