<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tema extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'tema';
    public $timestamps = false;
}
