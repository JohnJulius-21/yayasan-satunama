<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class form_evaluasi_konsultasi extends Model
{
    use HasFactory;
    protected $table = 'form_evaluasi_konsultasi';
    protected $primaryKey = 'id_form_evaluasi_konsultasi';
    protected $fillable = ['content'];

    public function konsultasi_pelatihan(){
        return $this->belongsTo(konsultasi_pelatihan::class, 'id_pelatihan_konsultasi', 'id_pelatihan_konsultasi');
    }
}
