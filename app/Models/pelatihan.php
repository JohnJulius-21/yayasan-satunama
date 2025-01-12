<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pelatihan extends Model
{
    use HasFactory;
    protected $table = 'reguler';
    protected $primaryKey = 'id_reguler';
    protected $dates = ['tanggal_mulai'];
    protected $fillable = [
        'id_tema', 
        'nama_pelatihan',
        'fee_pelatihan',
        'metode_pelatihan',
        'lokasi_pelatihan',
        'tanggal_pendaftaran',
        'tanggal_batas_pendaftaran',
        'kuota_peserta',
        'tanggal_mulai',
        'tanggal_selesai',
        'image',
        'file',
        'deskripsi_pelatihan',
    ];
    public $timestamps = false;


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function peserta_reguler()
    {
        return $this->hasMany(peserta_pelatihan_reguler::class);
    }
    public function tema()
    {
        return $this->belongsTo(tema::class, 'id_tema');
    }
    public function gender()
    {
        return $this->belongsTo(gender::class);
    }
    // public function jenis_produk()
    // {
    //     return $this->belongsTo(Produk::class);
    // }
    public function fasilitator_pelatihan()
    {
        return $this->belongsToMany(fasilitator_pelatihan_reguler::class, 'pelatihan_fasilitators', 'id_pelatihan', 'id_fasilitator');
    }
    // public function pelatihan_fasilitator()
    // {
    //     return $this->belongsToMany(pelatihan_fasilitator::class, 'id_pelatihan');
    // }
    public function silabus_pelatihan()
    {
        return $this->belongsToMany(silabus_pelatihan::class);
    }
    // public function fasilitator_pelatihan3()
    // {
    //     return $this->belongsTo(fasilitator_pelatihan_test::class, 'id_fasilitator3');
    // }
    public function pelatihanuser()
    {
        return $this->belongsTo(pelatihanuser::class);
    }
    public function rentang_usia()
    {
        return $this->belongsTo(rentang_usia::class, 'id_rentang_usia');
    }

    // public function getCreatedAtAttribute()
    // {
    //     return Carbon::parse($this->attributes['tanggal_mulai'])->translatedFormat('l, d F Y');
    // }

    public function user_presensi()
    {
        return $this->hasMany(UserPresensi::class, 'id_pelatihan');
    }

    public function gambarPelatihan()
    {
        return $this->hasMany(gambar_pelatihan::class, 'id_pelatihan');
    }

    public function filePelatihan()
    {
        return $this->hasMany(file_pelatihan::class, 'id_pelatihan');
    }
}
