<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disciplina extends Model
{
    use HasFactory;
    protected $table = 'disciplinas';
    protected $fillable = ['disciplina', 'descricao', 'curso_id'];

    public function curso()
    {
        return $this->belongsTo(Curso::class, 'curso_id');
    }

    public function topicos()
    {
        return $this->hasMany(Topico::class, 'disciplina_id');
    }

    public function questoes()
    {
        return $this->hasMany(Questao::class, 'disciplina_id');
    }
}
