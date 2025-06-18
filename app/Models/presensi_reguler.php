<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class presensi_reguler extends Model
{
    protected $table = 'presensi_reguler';
    protected $fillable = ['judul_presensi', 'qr_code'];
}
