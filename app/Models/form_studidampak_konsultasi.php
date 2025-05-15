<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class form_studidampak_konsultasi extends Model
{
    use HasFactory;

    protected $table = 'form_studidampak_konsultasi';
    protected $primaryKey = 'id_form_studidampak_konsultasi';
    protected $fillable = ['id_pelatihan_konsultasi','content'];

    public function konsultasi_pelatihan(){
        return $this->belongsTo(konsultasi_pelatihan::class, 'id_pelatihan_konsultasi');
    }
}
