<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questao extends Model
{
    use HasFactory;
    protected $table = 'questoes';
    protected $fillable = ['texto', 'simulado_id', 'disciplina_id'];

    public function simulado()
    {
        return $this->belongsTo(Simulado::class, 'simulado_id');
    }

    public function disciplina()
    {
        return $this->belongsTo(Disciplina::class, 'disciplina_id');
    }

    public function alternativas()
    {
        return $this->hasMany(Alternativa::class, 'questao_id');
    }
}
