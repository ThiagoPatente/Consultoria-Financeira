<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\OfertaController;

/**
 * Controller da consultoria de oferta de crédito
 *
 * @package #
 *
 * @author Thiago Patente
 *
 * @version  1.0.0
 *
 * @access public
 */
class ConsultaController extends Controller
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
     * Display the specified resource.
     *
     * @param  string
     * @return \Illuminate\Http\Response
     */
    public function show( string $cliente)
    {
        //
    }


    /**
     * Função que faz a consulta das melhores oferta de crédito de ordem da melhor para a pior recebendo o cpf
     *
     * @param Request $request
     *
     * @return Json  Contendo mensagem com as melhores ofertas ou erro
     *
     * @author Thiago Patente <talpatente@gmail.com>
     *
     * @version 1.0.0
     */
    public function store(Request $request)
    {

        $clienteConsultado = $this->consultarCpf($request->cpf);

        if(!$clienteConsultado){


            return response()->json(['erro' => 'O cpf solicitado não existe'], 404);
        }


       $ofertas = $this->consultarOfertas($clienteConsultado['instituicoes'],$request->cpf);


       if(!$ofertas){

            return response()->json(['erro' => 'O cliente não possui oferta de crédito'], 404);

       }

       //verificar se o cliente já esta cadastrado
       $verificarExistencia = ClienteController::consultarClienteCPF($request->cpf);

       //if que verifica se o cliente esta cadastrado,caso esteja, não efetuar o cadastro das ofertas e do cliente
       if(count($verificarExistencia) == 0){

         $cliente = ClienteController::guardarClienteConsultado($request->cpf);

         $cliente_id = $cliente->id;

         for ($i=0; $i <count($ofertas) ; $i++)
         {


                        $oferta  = OfertaController::guardaOfertaCliente($cliente_id,
                                                              $ofertas[$i]['instituicaoFinanceira'],
                                                              $ofertas[$i]['modalidadeCredito'],
                                                              $ofertas[$i]['valorAPagar'],
                                                              $ofertas[$i]['valorSolicitado'],
                                                              $ofertas[$i]['taxaJuros'],
                                                              $ofertas[$i]['qntParcelas']);
         }


    }



        return response()->json($ofertas, 201);

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param string
     *
     * @return \Illuminate\Http\Response
     */
    public function edit( string $cliente)
    {
        //
    }
    /**
     * Função que busca na API gosat as linhas de crédito que o cliente tem pelo CPF
     *
     * @param string $cpf cpf do cliente
     *
     * @return Array das ofertas de crédito ou mensagem de erro caso não tenha achado
     *
     * @author Thiago Patente <talpatente@gmail.com>
     *
     * @version 1.0.0
     */
    public function consultarCpf (string $cpf){

        //Chamada da api para buscar as instituiçoes do cliente
        $response = Http::post('https://dev.gosat.org/api/v1/simulacao/credito',['cpf'=> $cpf]);


        if($response->status() === 422)
        {
                return false;
        }

        else {

              return   json_decode ($response,true);


        }
    }

    /**
     * Função que busca a oferta de crédito do cliente por instituição
     *
     * @param string $cpf cpf do cliente
     * @param integer $instituicao_id id da instuitição
     * @param string $codModalidade modalidade da oferta de crédito
     *
     * @return Array das ofertas de crédito ou mensagem de erro caso não tenha achado
     *
     * @author Thiago Patente <talpatente@gmail.com>
     *
     * @version 1.0.0
     */
    public function consultarLinhaCredito (string $cpf,int $instituicao_id, string $codModalidade){

        //chamada da api para buscar as ofertas de crédito pelo cliente por instituição
        $response = Http::post('https://dev.gosat.org/api/v1/simulacao/oferta',['cpf'=> $cpf,
                                                                                'instituicao_id' => $instituicao_id,
                                                                                'codModalidade'  => $codModalidade]);
        if($response->status() === 422)
        {
                return false;
        }

        else {

              return   json_decode ($response,true);


        }
    }


    /**
     * Função que busca na API gosat as ofertas do cliente pelas as instituições e retorna com as melhores ofertas
     * de ordem da melhor para a pior
     *
     * @param Array $instituicoes array com as instituições que o cliente é cadastrado
     * @param string $cpf cpf do cliente
     *
     * @return Array com as ofertas de linha de crédito organizadas da melhor para a pior
     *
     * @author Thiago Patente <talpatente@gmail.com>
     *
     * @version 1.0.0
     */
    public function consultarOfertas ( Array $instituicoes,string $cpf){

        // array das ofertas
        $arrayofertas = [];


        //variavel para ser utilizada como index do array no loop
        $indexInstituicao = 0;

        foreach ($instituicoes as $instituicao )
        {


            foreach ($instituicao['modalidades']  as   $modalidade )
            {

                $oferta = $this->consultarLinhaCredito($cpf, $instituicao['id'],$modalidade['cod']);

                if(!$oferta){

                    return false;
                }

                $valoresImportantes = $this->calculoJuros($oferta['valorMin'],$oferta['QntParcelaMin'],$oferta['jurosMes'] *100);

                //colocando as ofertas dentro do array de ofertas
                array_push($arrayofertas,['instituicaoFinanceira' => $instituicao['nome'],
                                          'modalidadeCredito'     => $modalidade['nome'],
                                          'valorAPagar'           => "R$:".$valoresImportantes['valorTotal'],
                                          'valorSolicitado'       => $oferta['valorMin'],
                                          'taxaJuros'             => ($oferta['jurosMes'] *100)."%",
                                          'qntParcelas'           => $oferta['QntParcelaMin'],
                                          'jurosTotal'            => $valoresImportantes['jurosTotal']
                                        ]);

            }

            $indexInstituicao = $indexInstituicao+ 1;

        }

        return  $this->organizarofertas($arrayofertas);


    }

    /**
     * Função que calcular os valores de total juros e a ser pago para que a organização das ofertas seja feita pela valor de juros menor
     *
     * @param float $investimento_inicial valor do crédito
     * @param integer $meses parcelas
     * @param float $taxa_de_juros taxa de juros
     * @param integer $investimento_mensal valor de investimento mensal caso tenha
     *
     * @return Array com os valores total de juros e valor total a ser pago
     *
     * @author Thiago Patente <talpatente@gmail.com>
     *
     * @version 1.0.0
     */
    public function calculoJuros(float $investimento_inicial,  int $meses  , float $taxa_de_juros, float $investimento_mensal = 0){


        $investimento_acumulado = $investimento_inicial;
        $juros_compostos_total = 0;
        $investimento_acumulado2 = $investimento_inicial + ($investimento_mensal * $meses);

        for ($i = 0; $i < $meses; $i++) {
            $juros_compostos = ($investimento_acumulado * $taxa_de_juros) / 100;
            $juros_compostos_total += $juros_compostos;
            $investimento_acumulado += $juros_compostos + $investimento_mensal;
        }

        $valor_a_receber = $investimento_acumulado2 + $juros_compostos_total;

        return  ['jurosTotal' => $juros_compostos_total,
                 'valorTotal' => number_format($valor_a_receber, 2, ",", ".")];
    }

    /**
     * Função que organiza as ofertas da melhor pra pior com base no valor total de juros
     *
     * @param Array $ofertas Array de ofertas
     *
     * @return Array $filteredArray array com as ofertas ordenadas da melhor pra pior com base no valor total de juros
     *
     * @author Thiago Patente <talpatente@gmail.com>
     *
     * @version 1.0.0
     */
    public function organizarofertas(Array $ofertas){

        $sort = array();
        foreach($ofertas as $k => $v) {
            $sort['jurosTotal'][$k] = $v['jurosTotal'];

        }

        //aqui é realizado a ordenação do array
        array_multisort($sort['jurosTotal'], SORT_ASC,$ofertas);

        // retirando do array a informação de valor total juros pois ele so é utilizado para a ordenação.
        $filteredArray = array_map(function($array) {
            unset($array['jurosTotal']);
            return $array;
        }, $ofertas);

        return $filteredArray;


    }


}



