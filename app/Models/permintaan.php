<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class permintaan extends Model
{
    use HasFactory;

    protected $table = 'permintaan';
    protected $primaryKey = 'id_permintaan';


    protected $fillable = [
        'id_tema',
        'id_mitra',
        'judul_pelatihan',
        'jenis_pelatihan',
        'tanggal_waktu_mulai',
        'tanggal_waktu_selesai',
        'no_pic',
        'masalah',
        'kebutuhan',
        'materi',
        'request_khusus',
    ];

    public function mitra()
    {
        return $this->belongsTo(mitra::class, 'id_mitra');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function permintaan()
    {
        return $this->belongsTo(permintaan::class, 'id_permintaan', 'id_permintaan');
    }

    public function tema()
    {
        return $this->belongsTo(tema::class, 'id_tema');
    }

    public function assessment_peserta()
    {
        return $this->hasMany(assesment_peserta_permintaan::class, 'id_permintaan');
    }
}
