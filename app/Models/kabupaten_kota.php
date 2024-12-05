<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kabupaten_kota extends Model
{
    use HasFactory;

    protected $table = 'kabupaten_kota';
     public $timestamps = false;
    protected $primaryKey = 'id';

    public function peserta_reguler()
    {
        return $this->hasMany(peserta_pelatihan_reguler::class, 'id_provinsi');
    }
    public function provinsi()
    {
        return $this->belongsTo(provinsi::class);
    }
    public function konsultasi()
    {
        return $this->hasMany(konsultasi::class, 'id');
    }
}
