<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class form_studidampak_permintaan extends Model
{
    use HasFactory;

    protected $table = 'form_studidampak_permintaan';
    protected $primaryKey = 'id_form_studidampak_permintaan';
    protected $fillable = ['id_pelatihan_permintaan','content'];

    public function permintaan_pelatihan(){
        return $this->belongsTo(permintaan_pelatihan::class, 'id_pelatihan_permintaan');
    }
}
