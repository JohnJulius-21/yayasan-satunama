<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class status extends Model
{
    use HasFactory;

    protected $table = 'status_bayar_pelatihan';
    protected $primaryKey = 'id_status';

    protected $fillable = [
        'id_reguler',
        'id_peserta'
    ];

    public function peserta()
    {
        return $this->belongsTo(peserta_pelatihan_reguler::class, 'id_peserta', 'id_peserta');
    }

    public function reguler()
    {
        return $this->belongsTo(reguler::class, 'id_reguler', 'id_reguler');
    }
}
