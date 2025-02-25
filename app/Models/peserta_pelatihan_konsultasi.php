<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class peserta_pelatihan_konsultasi extends Model
{
    use HasFactory;
    protected $table = 'peserta_pelatihan_konsultasi';
    protected $primaryKey = 'id_peserta';
    protected $fillable = [ 
        'id_konsultasi', 
        'id_user', 
        'nama_peserta',
        'email_peserta', 
    ];

    public function konsultasi(){
        return $this->belongsTo(konsultasi::class, 'id_konsultasi');
    }

    public function pelatihan_konsultasi(){
        return $this->belongsTo(konsultasi_pelatihan::class, 'id_konsultasi', 'id_konsultasi');
    }

    public function user(){
        return $this->belongsTo(User::class, 'id_user');
    }

    public function getIsFilledAttribute()
    {
        return evaluasi_pelatihan_konsultasi::where('id_konsultasi', $this->id_konsultasi)
            ->where('id_user', $this->id_user)
            ->exists();
    }

    public function evaluasiPelatihan()
    {
        return $this->hasMany(evaluasi_pelatihan_konsultasi::class, 'id_user', 'id_user');
    }

    public function getIsFilledAttributes()
    {
        return survey_pelatihan_konsultasi::where('id_konsultasi', $this->id_konsultasi)
            ->where('id_user', $this->id_user)
            ->exists();
    }

    public function surveyPelatihan()
    {
        return $this->hasMany(survey_pelatihan_konsultasi::class, 'id_user', 'id_user');
    }
    
    public function getIsFilledAttributess()
    {
        return studidampak_pelatihan_konsultasi::where('id_konsultasi', $this->id_konsultasi)
            ->where('id_user', $this->id_user)
            ->exists();
    }

    public function studiPelatihan()
    {
        return $this->hasMany(studidampak_pelatihan_konsultasi::class, 'id_user', 'id_user');
    }
}
