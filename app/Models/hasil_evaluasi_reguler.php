<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hasil_evaluasi_reguler extends Model
{
    use HasFactory;

    protected $table = 'hasil_evaluasi_reguler';
    protected $primaryKey = 'id_hasil_evaluasi_reguler';
    protected $fillable = ['id_peserta','content'];

    public function reguler(){
        return $this->belongsTo(reguler::class, 'id_reguler');
    }

    public function peserta(){
        return $this->belongsTo(peserta_pelatihan_reguler::class, 'id_peserta', 'id_peserta_reguler');
    }
    public function user(){
        return $this->belongsTo(user::class, 'id_user');
    }
}
