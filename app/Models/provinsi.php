<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class provinsi extends Model
{
    use HasFactory;
    public $table = 'provinsi';
    public $timestamps = false;
    protected $primaryKey = 'id';

    public function negara()
    {
        return $this->hasMany(negara::class);
    }
    public function kabupaten_kota()
    {
        return $this->hasMany(kabupaten_kota::class);
    }
}
