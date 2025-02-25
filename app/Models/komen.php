<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class komen extends Model
{
    use HasFactory;

    protected $table = 'komen_diskusi';
    protected $primaryKey = 'id_komen';
    protected $fillable = ['id_diskusi', 'id_user', 'id_parent', 'content'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function discussion()
    {
        return $this->belongsTo(Discussion::class, 'id_diskusi',  'id_diskusi');
    }

    // Relasi ke komentar utama (parent)
    public function parent()
    {
        return $this->belongsTo(Komen::class, 'id_parent');
    }

    // Relasi ke balasan komentar (replies)
    public function replies()
    {
        return $this->hasMany(Komen::class, 'id_parent')->with('replies', 'user'); // Rekursif
    }
}
