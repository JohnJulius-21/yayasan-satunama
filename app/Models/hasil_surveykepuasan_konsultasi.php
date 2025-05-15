<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hasil_surveykepuasan_konsultasi extends Model
{
    use HasFactory;

    protected $table = 'hasil_surveykepuasan_konsultasi';
    protected $primaryKey = 'id_hasil_surveykepuasan_konsultasi';
    protected $fillable = ['content'];

    public function konsultasi_pelatihan(){
        return $this->belongsTo(konsultasi_pelatihan::class, 'id_pelatihan_konsultasi');
    }

    public function peserta_pelatihan(){
        return $this->belongsTo(peserta_pelatihan_konsultasi::class, 'id_pelatihan_konsultasi');
    }
}
