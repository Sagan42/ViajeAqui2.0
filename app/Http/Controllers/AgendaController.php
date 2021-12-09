<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Linha;
use App\Models\Agenda;
use App\Models\Viajem;
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

        $agenda = Agenda::all();
        $linha = Linha::all();
        $linhas = array();
        $agendas = array();

        date_default_timezone_set('America/Sao_Paulo');
        
        $dataPesquisado = Carbon::createFromFormat('Y-m-d', $dataSaida)->format('d/m/Y');
        $diaSemanaPesquisado = Carbon::create($dataSaida)->locale('pt-BR')->dayName;

        foreach($agenda as $a){
            if($a->dia_semana == $diaSemanaPesquisado) {
                $linhaAux = Linha::find($a->id_linha);
                if($linhaAux->tipoLinha == 'Direta'){
                    if($linhaAux->origem == $request->SelecionarOrigem && $linhaAux->destino == $request->SelecionarDestino){
                        $viaj = Viajem::where('id_linha','=',$linhaAux->id)
                                        ->where('dataViajem','=', $dataSaida)
                                        ->first();

                        if($viaj != null){
                            $linhaAux->quantidadePassagem = $viaj->quantidadePassagem;
                        }

                        array_push($linhas,$linhaAux);
                    }
                    
                }else{
                    $linhaPesquisada = $linhaAux;
                    $linhaPesquisada->preco = 0;
                    $destino = $linhaAux->destino;
    
                    $preco = 0;
    
                    foreach($linha as $l){
                        if($l->num_linha == $linhaAux->num_linha){
                            if($l->origem == $request->SelecionarOrigem && $l->destino == $request->SelecionarDestino){
                                $l->id = $linhaAux->id;

                                $viaj = Viajem::where('id_linha','=',$l->id)
                                                ->where('dataViajem','=', $dataSaida)
                                                ->first();

                                if($viaj != null){
                                    $l->quantidadePassagem = $viaj->quantidadePassagem;
                                }

                                array_push($linhas,$l);
                            }elseif($linhaAux->origem == $request->SelecionarOrigem){
                                $preco += $l->preco;
                                if($destino == $l->origem){
                                    if($l->destino == $request->SelecionarDestino){
                                        $linhaPesquisada->destino = $l->destino;
                                        $linhaPesquisada->preco = $preco;

                                        $viaj = Viajem::where('id_linha','=',$linhaPesquisada->id)
                                                        ->where('dataViajem','=', $dataSaida)
                                                        ->first();

                                        if($viaj != null){
                                            $linhaPesquisada->quantidadePassagem = $viaj->quantidadePassagem;
                                        }  

                                        array_push($linhas,$linhaPesquisada);
                                    }
                                    $destino = $l->destino;
                                }
                            }else{
                                if($l->origem == $request->SelecionarOrigem){
                                    $linha = $l;
                                    $linha->id = $linhaAux->id;
                                    $preco = 0;
                                }
    
                                if($linha != null || $linha->origem == $request->SelecionarOrigem){
                                    $preco += $l->preco;
                                    if($l->destino == $request->SelecionarDestino){
                                        $linha->preco = $preco;
                                        $linha->destino = $l->destino;

                                        $viaj = Viajem::where('id_linha','=',$linha->id)
                                                        ->where('dataViajem','=', $dataSaida)
                                                        ->first();

                                        if($viaj != null){
                                            $linha->quantidadePassagem = $viaj->quantidadePassagem;
                                        }
                                        
                                        array_push($linhas,$linha);
                                    }
                                }
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
    public function store(Request $request, $id)
    {
        if($request->Segunda){
            $agenda = new Agenda();
            $agenda->hora = $request->horarioSegunda;
            $agenda->dia_semana = 'segunda-feira';
            $agenda->id_linha = $id;
            $agenda->save();
        }if($request->Terca){
            $agenda = new Agenda();
            $agenda->hora = $request->horarioTerca;
            $agenda->dia_semana = 'terça-feira';
            $agenda->id_linha = $id;
            $agenda->save();
        }if($request->Quarta){
            $agenda = new Agenda();
            $agenda->hora = $request->horarioQuarta;
            $agenda->dia_semana = 'quarta-feira';
            $agenda->id_linha = $id;
            $agenda->save();
        }if($request->Quinta){
            $agenda = new Agenda();
            $agenda->hora = $request->horarioQuinta;
            $agenda->dia_semana = 'quinta-feira';
            $agenda->id_linha = $id;
            $agenda->save();
        }if($request->Sexta){
            $agenda = new Agenda();
            $agenda->hora = $request->horarioSexta;
            $agenda->dia_semana = 'sexta-feira';
            $agenda->id_linha = $id;
            $agenda->save();
        }if($request->Sabado){
            $agenda = new Agenda();
            $agenda->hora = $request->horarioSabado;
            $agenda->dia_semana = 'sabado';
            $agenda->id_linha = $id;
            $agenda->save();
        }if($request->Domingo){
            $agenda = new Agenda();
            $agenda->hora = $request->horarioDomingo;
            $agenda->dia_semana = 'domingo';
            $agenda->id_linha = $id;
            $agenda->save();
        }
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
        //dd($request);
        $agenda = Agenda::where('id_linha', '=', $id)->get();
        foreach ($agenda as $a) {
            if($a->dia_semana == 'segunda-feira'){
                $a->hora = $request->horarioSegunda;
                $a->dia_semana = 'segunda-feira';
                $a->id_linha = $id;
                $a->save();
            }if($a->dia_semana == 'terça-feira'){
                $a->hora = $request->horarioTerca;
                $a->dia_semana = 'terça-feira';
                $a->id_linha = $id;
                $a->save();
            }if($a->dia_semana == 'quarta-feira'){
                $a->hora = $request->horarioQuarta;
                $a->dia_semana = 'quarta-feira';
                $a->id_linha = $id;
                $a->save();
            }if($a->dia_semana == 'quinta-feira'){
                $a->hora = $request->horarioQuinta;
                $a->dia_semana = 'quinta-feira';
                $a->id_linha = $id;
                $a->save();
            }if($a->dia_semana == 'sexta-feira'){
                $a->hora = $request->horarioSexta;
                $a->dia_semana = 'sexta-feira';
                $a->id_linha = $id;
                $a->save();
            }if($a->dia_semana == 'sábado'){
                $a->hora = $request->horarioSabado;
                $a->dia_semana = 'sábado';
                $a->id_linha = $id;
                $a->save();
            }if($a->dia_semana == 'domingo'){
                $a->hora = $request->horarioDomingo;
                $a->dia_semana = 'domingo';
                $a->id_linha = $id;
                $a->save();
            }
        }
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
