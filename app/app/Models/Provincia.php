<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
   
    use HasFactory;
    protected $table = 'provincias';
    protected $fillable = ['provincia'];

    public function municipios()
    {
        return $this->hasMany(Municipio::class, 'provincia_id');
    }
}
