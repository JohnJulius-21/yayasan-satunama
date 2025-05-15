<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class peserta_pelatihan_reguler extends Model
{
    use HasFactory;

    use HasFactory;
    protected $table = 'peserta_pelatihan_reguler';
    protected $primaryKey = 'id_peserta_reguler';
    protected $fillable = [
        'gender',
        'id_user',
        'id_reguler',
        'rentang_usia',
        'id_kabupaten',
        'id_provinsi',
        'id_negara',
        'organisasi',
        'informasi',
        'nama_peserta',
        'email_peserta',
        'no_hp',
        'email_peserta',
        'nama_organisasi',
        'jabatan_peserta',
        'pelatihan_relevan',
        'harapan_pelatihan',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    
    // public function informasi_pelatihan(){
    //     return $this->belongsTo(informasi_pelatihan::class, 'id_informasi');
    // }
    
    public function tema()
    {
        return $this->belongsTo(tema::class, 'id_tema');
    }
    public function jenis_organisasi(){
        return $this->belongsTo(jenis_organisasi::class, 'id_organisasi');
    }
    public function kabupaten_kota(){
        return $this->belongsTo(kabupaten_kota::class, 'id_kabupaten');
    }
    public function provinsi(){
        return $this->belongsTo(provinsi::class, 'id_provinsi');
    }
    public function negara(){
        return $this->belongsTo(negara::class, 'id_negara');
    }
    public function reguler(){
        return $this->belongsTo(reguler::class, 'id_reguler');
    }
    public function status()
{
    return $this->hasOne(status::class, 'id_peserta', 'id_peserta_reguler');
}


    public function hasilEvaluasiReguler(){
        return $this->belongsTo(hasil_evaluasi_reguler::class, 'id_peserta_reguler', 'id_peserta');
    }

    public function hasilSurveyReguler()
    {
        return $this->belongsTo(hasil_surveykepuasan_reguler::class, 'id_peserta_reguler','id_peserta');
    }

    public function hasilStudiReguler()
    {
        return $this->belongsTo(hasil_studidampak_reguler::class, 'id_peserta_reguler','id_peserta');
    }


    public function getIsFilledAttribute()
    {
        return hasil_evaluasi_reguler::where('id_reguler', $this->id_reguler)
            ->where('id_peserta', $this->id_peserta)
            ->exists();
    }

    public function evaluasiPelatihan()
    {
        return $this->hasMany(evaluasi_pelatihan_reguler::class, 'id_user', 'id_user');
    }

    // public function getIsFilledAttributes()
    // {
    //     return hasil_evaluasi_reguler::where('id_reguler', $this->id_reguler)
    //         ->where('id_user', $this->id_user)
    //         ->exists();
    // }

    public function surveyPelatihan()
    {
        return $this->hasMany(survey_pelatihan_reguler::class, 'id_user', 'id_user');
    }
    
    public function getIsFilledAttributess()
    {
        return studidampak_pelatihan_reguler::where('id_pelatihan', $this->id_pelatihan)
            ->where('id_user', $this->id_user)
            ->exists();
    }

    public function studiPelatihan()
    {
        return $this->hasMany(studidampak_pelatihan_reguler::class, 'id_user', 'id_user');
    }

    
}
