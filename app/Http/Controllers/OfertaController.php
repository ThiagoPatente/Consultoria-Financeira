<?php

namespace App\Http\Controllers;

use App\Models\Oferta;
use App\Http\Requests\StoreOfertaRequest;
use App\Http\Requests\UpdateOfertaRequest;

class OfertaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOfertaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOfertaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Oferta  $oferta
     * @return \Illuminate\Http\Response
     */
    public function show(Oferta $oferta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Oferta  $oferta
     * @return \Illuminate\Http\Response
     */
    public function edit(Oferta $oferta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOfertaRequest  $request
     * @param  \App\Models\Oferta  $oferta
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOfertaRequest $request, Oferta $oferta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Oferta  $oferta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Oferta $oferta)
    {
        //
    }

    /**
     * Guarda oferta do cliente
     *
     * @param integer $cliente_id id do cliente
     * @param string $instituicaoFinanceira nome da instituição financeira
     * @param string $modalidadeCredito nome da modalidade
     * @param float $valorAPagar valor à pagar
     * @param float $valorSolicitado valor do crédito
     * @param string $taxaJuros taxa de juros
     * @param integer $qntParcelas quantidade de parcelas
     *
     * @return  \App\Models\Oferta
     *
     * @author Thiago Patente
     *
     * @version  1.0.0
     */
    public static  function guardaOfertaCliente(int $cliente_id,
                                                string $instituicaoFinanceira,
                                                string $modalidadeCredito,
                                                string $valorAPagar,
                                                float $valorSolicitado,
                                                string $taxaJuros,
                                                int $qntParcelas)
    {

        $oferta = Oferta::create(['cliente_id'=>$cliente_id,
                                  'instituicaoFinanceira'=>$instituicaoFinanceira,
                                  'modalidadeCredito'=>$modalidadeCredito,
                                  'valorAPagar'=>$valorAPagar,
                                  'valorSolicitado'=>$valorSolicitado,
                                  'taxaJuros'=>$taxaJuros,
                                  'qntParcelas'=>$qntParcelas]);
        return $oferta;
    }

}
