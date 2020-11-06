<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;
    
    protected $hidden = ['senha']; //Vai OCULATA senha no retorno

    public function  carros() {
        return $this->hasMany('App\Models\Carro');
    }
}
