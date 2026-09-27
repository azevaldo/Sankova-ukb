<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desempenho extends Model
{
    use HasFactory;
    protected $table='desempenhos';
    protected $fillable=['corretas','incorretas','nsimulados','user_id'];
    public function usuario(){
        return $this->belongsTo(User::class,'user_id');
    }
}
