<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material_estudo extends Model
{
    use HasFactory;
    protected $table = 'material_estudos';
    protected $fillable = ['subtema', 'doc', 'topico_id'];

    public function topico()
    {
        return $this->belongsTo(Topico::class, 'topico_id');
    }
}
