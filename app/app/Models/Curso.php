<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Curso extends Model
{
    use HasFactory;
    protected $table = 'cursos'; // Nome da tabela na BD
    protected $fillable = ['nome', 'descricao', 'duracao', 'faculdade_id'];

    public function faculdade()
    {
        return $this->belongsTo(Faculdade::class,"faculdade_id");
    }

    public function simulados(){
        return $this->hasMany(simulado::class,'curso_id');
    }

    public function disciplinas()
    {
        return $this->hasMany(Disciplina::class,"curso_id");
    }
    public function usuarios(): MorphMany
    {
        return $this->morphMany(User::class, 'entidade','entidade_tipo','entidade_id');
    }
}
