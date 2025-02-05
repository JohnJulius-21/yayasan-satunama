<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class form_surveykepuasan_reguler extends Model
{
    use HasFactory;

    protected $table = 'form_surveykepuasan_reguler';
    protected $primaryKey = 'id_form_surveykepuasan_reguler';
    protected $fillable = ['content'];

    public function reguler(){
        return $this->belongsTo(reguler::class, 'id_reguler');
    }
}
