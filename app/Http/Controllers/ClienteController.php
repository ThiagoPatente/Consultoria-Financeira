<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Http\Requests\StoreClienteRequest;
use App\Http\Requests\UpdateClienteRequest;

class ClienteController extends Controller
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
     * store new cliente
     *
     */
    public function store(string  $cpf)
    {

        //

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return use App\Models\Cliente
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateClienteRequest  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClienteRequest $request, Cliente $cliente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        //
    }


    /**
     * Função que busca no banco de dados se o cpf do cliente já exista
     *
     * @param string $cpf cpf do cliente
     *
     * @return Array $cliente array do cliente caso exista
     *
     * @author Thiago Patente <talpatente@gmail.com>
     *
     * @version 1.0.0
     */
    public  static function consultarClienteCPF(string $cpf)
    {
        $cliente =  Cliente::where('cpf','=', $cpf)->get()->toArray();
        return $cliente;
    }


    /**
     * Guarda no banco dados o cliente cadastrado
     *
     * @param string $cpf string do cliente
     *
     * @return  \App\Models\Cliente
     *
     * @author Thiago Patente <talpatente@gmail.com>
     *
     * @version 1.0.0
     */
    public  static  function guardarClienteConsultado(string  $cpf)
    {

        $cliente =  Cliente::create(['cpf' => $cpf]);
        return $cliente;
    }



}
