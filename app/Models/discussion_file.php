<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class discussion_file extends Model
{
    use HasFactory;

    protected $table = 'discussions_files';
    protected $primaryKey = 'id_file';

}
