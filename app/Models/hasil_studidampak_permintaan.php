<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hasil_studidampak_permintaan extends Model
{
    use HasFactory;

    protected $table = 'hasil_studidampak_permintaan';
    protected $primaryKey = 'id_hasil_studidampak_permintaan';
    protected $fillable = ['id_pelatihan_permintaan','content'];

    public function permintaan_pelatihan(){
        return $this->belongsTo(permintaan_pelatihan::class, 'id_pelatihan_permintaan');
    }

    public function peserta(){
        return $this->belongsTo(peserta_pelatihan_permintaan::class, 'id_peserta', 'id_peserta');
    }
}
