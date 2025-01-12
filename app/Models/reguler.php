<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reguler extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_reguler';
    protected $table = 'reguler';

}
