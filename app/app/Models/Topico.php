<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topico extends Model
{
    use HasFactory;
    protected $table = 'topicos';
    protected $fillable = ['tema', 'descricao', 'disciplina_id'];

    public function disciplina()
    {
        return $this->belongsTo(Disciplina::class, 'disciplina_id');
    }

    public function materialEstudos()
    {
        return $this->hasMany(Material_estudo::class, 'topico_id');
    }
}
