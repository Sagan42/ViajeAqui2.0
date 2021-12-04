<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Linha;
use App\Models\Agenda;
use Illuminate\Support\Carbon;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $linhaPesq = new Linha;
        $linhaPesq->origem = $request->SelecionarOrigem;
        $linhaPesq->destino = $request->SelecionarDestino;
        $dataSaida = $request->dataSaida;
        $linhaPesq->dataSaida = $dataSaida;
        //2021-12-01 -> quarta
        // 1 -> quinta
        // 8
        // 2 -> sexta
        // 9

        $agenda = Agenda::all();
        $linha = Linha::all();
        $linhas = array();
        $agendas = array();

        // Data de hoje
        //$dia = Carbon::today()->format('l');
        date_default_timezone_set('America/Sao_Paulo');
        //$dia = Carbon::createFromFormat('Y-m-d', $dataSaida)->toDateString();

        
        //$dataPesquisado = Carbon::createFromFormat('Y-m-d', $dataSaida);
        $dataPesquisado = Carbon::createFromFormat('Y-m-d', $dataSaida)->format('d/m/Y');
        
        //$dataPesquisado->add(1,'day');
        //$weekdays = Carbon::getDays();
        //$diaSemanaPesquisado = Carbon::create($dataPesquisado)->locale('pt-BR')->dayName;

        //dd($diaSemana);
        //retorna data com formato carbon
        //$test = Carbon::createFromFormat('Y-m-d', $dataSaida)->toDateString();

        $diaSemanaPesquisado = Carbon::create($dataSaida)->locale('pt-BR')->dayName;

        foreach($agenda as $a){
            //echo $a->dia_semana, '<br>';
            //echo $diaSemanaPesquisado,'<br>';
            $linhaBusc = Linha::find($a->id_linha);
            //echo $linhaBusc, '<br>';
            if($linhaBusc->origem == $request->SelecionarOrigem && $linhaBusc->destino == $request->SelecionarDestino && $a->dia_semana == $diaSemanaPesquisado){
                array_push($linhas,$linhaBusc);
                //echo $linhaBusc;
            }else if($a->dia_semana == $diaSemanaPesquisado && $linhaBusc->tipoLinha == 'Comum'){
                $linhaAux = $linhaBusc;
                $linhaAux->preco = 0;
                $linhaAux2 = null;
                $preco = 0;

                foreach ($linha as $l){
                    if ($l->origem == $linhaPesq->origem && $l->destino == $linhaPesq->destino && $l->num_linha == $linhaBusc->num_linha) {
                        array_push($linhas,$l);
                        //echo $l;
                    }else if($linhaBusc->origem == $linhaPesq->origem && $l->num_linha == $linhaBusc->num_linha){
                        $linhaAux->preco += $l->preco;
                        if($l->destino == $linhaPesq->destino){
                            $linhaAux->destino = $l->destino;
                            array_push($linhas,$linhaAux);
                            //echo $linhaAux;
                        }
                    }elseif($l->num_linha == $linhaBusc->num_linha){
                        if($l->origem == $linhaPesq->origem){
                            $linhaAux2 = $l;
                        }
                        if ($linhaAux2 != null) {
                            $preco += $l->preco;
                            if($l->destino == $linhaPesq->destino){
                                $linhaAux2->destino = $l->destino;
                                $linhaAux2->preco = $preco;
                                array_push($linhas,$linhaAux2);
                                //echo $linhaAux2;
                            }                            
                        }
                    }
                }
            }
        }
        return view('clients.selecionarPassagens', ['linha' => $linhas, 'agenda' => $agenda, 'linhaPesquisada'=> $linhaPesq, 'dia' => $diaSemanaPesquisado, 'dataSaida' => $dataPesquisado]);
        //var_dump($linhas);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
