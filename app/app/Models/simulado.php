<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class simulado extends Model
{
    use HasFactory;
    protected $table = 'simulados';
    protected $fillable = ['nome', 'tipo', 'curso_id'];

    public function curso()
    {
        return $this->belongsTo(Curso::class, 'curso_id');
    }

    public function questoes()
    {
        return $this->hasMany(Questao::class, 'simulado_id');
    }
}
