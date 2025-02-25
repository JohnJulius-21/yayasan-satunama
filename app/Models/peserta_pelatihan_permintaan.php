<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class peserta_pelatihan_permintaan extends Model
{
    use HasFactory;
    protected $table = 'peserta_pelatihan_permintaan';
    protected $primaryKey = 'id_peserta';
    protected $fillable = [ 
        'id_permintaan', 
        'nama_peserta',
        'email_peserta', 
    ];

    public function permintaan(){
        return $this->belongsTo(permintaan::class, 'id_permintaan');
    }

    public function permintaan_pelatihan(){
        return $this->belongsTo(permintaan_pelatihan::class, 'id_permintaan');
    }

    public function user(){
        return $this->belongsTo(User::class, 'id_user');
    }

    public function getIsFilledAttribute()
    {
        return evaluasi_pelatihan_permintaan::where('id_permintaan', $this->id_permintaan)
            ->where('id_user', $this->id_user)
            ->exists();
    }

    public function evaluasiPelatihan()
    {
        return $this->hasMany(evaluasi_pelatihan_permintaan::class, 'id_user', 'id_user');
    }

    public function getIsFilledAttributes()
    {
        return survey_pelatihan_permintaan::where('id_permintaan', $this->id_permintaan)
            ->where('id_user', $this->id_user)
            ->exists();
    }

    public function surveyPelatihan()
    {
        return $this->hasMany(survey_pelatihan_permintaan::class, 'id_user', 'id_user');
    }
    
    public function getIsFilledAttributess()
    {
        return studidampak_pelatihan_permintaan::where('id_permintaan', $this->id_permintaan)
            ->where('id_user', $this->id_user)
            ->exists();
    }

    public function studiPelatihan()
    {
        return $this->hasMany(studidampak_pelatihan_permintaan::class, 'id_user', 'id_user');
    }
}
