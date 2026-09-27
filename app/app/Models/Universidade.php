<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Universidade extends Model
{
    use HasFactory;
  
    protected $table = 'universidades'; // Nome da tabela na BD
    protected $fillable = ['nome', 'sigla','endereco', 'descricao',  'municipio_id','site','email'];

   

    public function municipio()
    {
        return $this->belongsTo(Municipio::class,"municipio_id");
    }

    public function faculdades()
    {
        return $this->hasMany(Faculdade::class,"universidade_id");
    }
    public function usuarios(): MorphMany
    {
        return $this->morphMany(User::class, 'entidade', 'entidade_tipo', 'entidade_id');
    }
}
