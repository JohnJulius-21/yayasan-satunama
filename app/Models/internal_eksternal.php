<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class internal_eksternal extends Model
{
    use HasFactory;

    protected $table = 'internal_eksternals';
    protected $primaryKey = 'id_internal_eksternal';
    protected $fillable = ['id_internal_eksternal', 'internal_eksternal'];

    public function fasilitator_pelatihan()
    {
        return $this->hasMany(fasilitator::class, 'id_internal_eksternal');
    }
}
