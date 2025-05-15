<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hasil_studidampak_reguler extends Model
{
    use HasFactory;

    protected $table = 'hasil_studidampak_reguler';
    protected $primaryKey = 'id_hasil_studidampak_reguler';
    protected $fillable = ['id_reguler','content'];

    public function reguler(){
        return $this->belongsTo(reguler::class, 'id_reguler');
    
    }
    public function peserta(){
        return $this->belongsTo(peserta_pelatihan_reguler::class, 'id_peserta', 'id_peserta_reguler');
    }
}
