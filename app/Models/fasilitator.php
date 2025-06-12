<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fasilitator extends Model
{
    use HasFactory;

    protected $table = 'fasilitator_pelatihan';

    protected $primaryKey = 'id_fasilitator';

    // protected $casts = [
    //     'body' => 'array',
    // ];

    protected $fillable = [
        'nama_fasilitator',
        'nik',
        'email_fasilitator',
        'nomor_telepon',
        'alamat',
        'jenis_kelamin',
        'id_gender',
        'id_internal_eksternal',
        'asal_lembaga',
        'body'
    ];

    public function internal_eksternal()
    {
        return $this->belongsTo(internal_eksternal::class, 'id_internal_eksternal');
    }
    // public function fasilitator_pelatihan_test(){
    //     return $this->belongsToMany(fasilitator_pelatihan_test::class);
    // }
    public function gender()
    {
        return $this->belongsTo(gender::class, 'id_gender');
    }
    public function pelatihan()
    {
        return $this->belongsToMany(pelatihan::class);
    }

    public function reguler()
    {
        return $this->belongsToMany(reguler::class, 'fasilitator_reguler', 'id_pelatihan');
    }
    public function foto()
    {
        return $this->belongsTo(fasilitator_foto::class, 'id_fasilitator', 'id_fasilitator');
    }

}
