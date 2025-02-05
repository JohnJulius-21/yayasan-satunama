<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class form_studidampak_reguler extends Model
{
    use HasFactory;
    
    protected $table = 'form_studidampak_reguler';
    protected $primaryKey = 'id_form_studidampak_reguler';
    protected $fillable = ['id_reguler','content'];

    public function reguler(){
        return $this->belongsTo(reguler::class, 'id_reguler');
    }
}
