<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class negara extends Model
{
    use HasFactory;
    public $table = 'negara';
    public $timestamps = false;
    protected $primaryKey = 'id';


    public function peserta_reguler()
    {
        return $this->hasMany(peserta_pelatihan_reguler::class, 'id_negara');
    }
    public function provinsi()
    {
        return $this->hasMany(provinsi::class);
    }
    // public function konsultasi()
    // {
    //     return $this->hasMany(konsultasi::class, 'id');
    // }
}
