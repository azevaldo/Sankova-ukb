<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Faculdade extends Model
{
    use HasFactory;
    protected $table = 'faculdades'; // Nome da tabela na BD
    protected $fillable = ['nome', 'descricao', 'universidade_id'];

    public function universidade()
    {
        return $this->belongsTo(Universidade::class,"universidade_id");
    }

    

    public function cursos()
    {
        return $this->hasMany(Curso::class);
    }
    public function usuarios(): MorphMany
    {
        return $this->morphMany(User::class, 'entidade','entidade_tipo','entidade_id');
    }
}
