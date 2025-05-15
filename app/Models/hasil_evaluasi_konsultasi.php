<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hasil_evaluasi_konsultasi extends Model
{
    use HasFactory;

    protected $table = 'hasil_evaluasi_konsultasi';
    protected $primaryKey = 'id_hasil_evaluasi_konsultasi';
    protected $fillable = ['content'];

    public function konsultasi_pelatihan(){
        return $this->belongsTo(konsultasi_pelatihan::class, 'id_konsultasi_pelatihan');
    }

    public function peserta(){
        return $this->belongsTo(peserta_pelatihan_konsultasi::class, 'id_peserta', 'id_peserta');
    }
}
