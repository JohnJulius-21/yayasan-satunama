<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    use HasFactory;
    protected $table = 'discussions';
    protected $primaryKey = 'id_diskusi';

    protected $fillable = [
        'id_user',
        'title',
        'content',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function comments()
    {
        return $this->hasMany(komen::class, 'id_diskusi');
    }

    public function files()
    {
        return $this->hasMany(discussion_file::class, 'id_diskusi');
    }

    
}
