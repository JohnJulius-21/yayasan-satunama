<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class konsultasi extends Model
{
    use HasFactory;
    protected $table = "konsultasi";
    protected $primaryKey = 'id_konsultasi';
    protected $fillable = [
        'id_user',
        'jenis_organisasi',
        'id_kabupaten',
        'id_provinsi',
        'id_negara',
        'nama_organisasi',
        'alamat',
        'email',
        'no_hp',
        'deskripsi_kebutuhan'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // public function organisasi()
    // {
    //     return $this->belongsTo(Organisasi::class. 'id_jenis_organisasi');
    // }
    public function kabupaten_kota()
    {
        return $this->belongsTo(kabupaten_kota::class, 'id_kabupaten');
    }
    public function negara()
    {
        return $this->belongsTo(negara::class, 'id_negara');
    }
    public function provinsi()
    {
        return $this->belongsTo(provinsi::class, 'id_provinsi');
    }
}
