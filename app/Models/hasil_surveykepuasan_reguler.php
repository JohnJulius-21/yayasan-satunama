<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hasil_surveykepuasan_reguler extends Model
{
    use HasFactory;

    protected $table = 'hasil_surveykepuasan_reguler';
    protected $primaryKey = 'id_hasil_surveykepuasan_reguler';
    protected $fillable = ['content'];

    public function reguler(){
        return $this->belongsTo(reguler::class, 'id_pelatihan_reguler');
    }

    public function peserta(){
        return $this->belongsTo(peserta_pelatihan_reguler::class, 'id_pesera', 'id_peserta_reguler');
    }
    public function user(){
        return $this->belongsTo(user::class, 'id_user');
    }
}
