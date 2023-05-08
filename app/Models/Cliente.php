<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * Classe do cliente
 *
 *
 * @author Thiago Patente
 *
 * @version  1.0.0
 *
 */
class Cliente extends Model
{
    use HasFactory;
    protected $fillable = ['cpf'];



    public function ofertas() {
        //UM cliente POSSUI MUITAS ofertas
        return $this->hasMany('App\Models\Oferta');
    }
}
