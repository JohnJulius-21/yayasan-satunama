<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fasilitator_pelatihan_konsultasi extends Model
{
    use HasFactory;
    protected $table = 'konsultasi_fasilitators';

    protected $primaryKey = 'id_pelatihan_fasilitator';
}
