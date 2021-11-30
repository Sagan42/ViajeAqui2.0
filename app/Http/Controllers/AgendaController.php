<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Linha;
use App\Models\Agenda;

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
        $linhaPesq->dataSaida = $request->dataSaida;

        $agenda = Agenda::all();
        $linha = Linha::all();
        $linhas = array();

        foreach($agenda as $a){
            $linhaAux = Linha::find($a->id_linha);
            if($linhaAux->tipoLinha == 'Direta'){
                if($linhaAux->origem == $request->SelecionarOrigem && $linhaAux->destino == $request->SelecionarDestino){
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
                            array_push($linhas,$l);
                        }elseif($linhaAux->origem == $request->SelecionarOrigem){
                            $preco += $l->preco;
                            if($destino == $l->origem){
                                if($l->destino == $request->SelecionarDestino){
                                    $linhaPesquisada->destino = $l->destino;
                                    $linhaPesquisada->preco = $preco;
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
                                    array_push($linhas,$linha);
                                }
                            }
                        }
                    }
                }
            }
            //echo "<br>";
        }
        return view('clients.selecionarPassagens', ['linha' => $linhas, 'agenda' => $agenda, 'linhaPesquisada'=> $linhaPesq]);
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
