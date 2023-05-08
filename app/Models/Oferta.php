<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * Classe de ofertas do cliente
 *
 *
 * @author Thiago Patente
 *
 * @version  1.0.0
 */
class Oferta extends Model
{
    use HasFactory;

    protected $fillable = ['cliente_id',
                           'instituicaoFinanceira',
                           'modalidadeCredito',
                           'valorAPagar',
                           'valorSolicitado',
                           'taxaJuros',
                           'qntParcelas'];


    public function cliente() {
        //UM oferta PERTENCE a UM cliente
        return $this->belongsTo('App\Models\Cliente');
    }
}
