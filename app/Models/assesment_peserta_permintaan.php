<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class assesment_peserta_permintaan extends Model
{
    use HasFactory;

    protected $table = 'assesment_peserta_permintaan';

    protected $fillable = [
        'id_permintaan',
        'nama_peserta',
        'email_peserta',
        'jenis_kelamin',
        'jabatan',
        'tanggung_jawab',
    ];

    public function permintaan()
    {
        return $this->belongsTo(permintaan::class, 'id_permintaan', 'id_permintaan');
    }
}
