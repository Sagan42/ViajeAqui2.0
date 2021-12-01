<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Linha;
use App\Models\Adm;
use App\Models\Agenda;
use Illuminate\Support\Carbon;

use Session;

class LinhaController extends Controller
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $linha = new Linha;
        $linha->origem = $request->origem;
        $linha->destino = $request->destino;
        $linha->preco = $request->valor;
        $linha->num_linha = $request->num_linha;
        $linha->quantidadePassagem = $request->vagas;
        $linha->tipoLinha = $request->linha;
        $adm = Adm::where('id_usuario', '=', Session::get('usuario.id'))->first();
        
        $linha->id_adm = $adm->id;
        $linha->save();

        return redirect()->route('site.adm.cadLinha');
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function linhaPesquisada(Request $request) {
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
        $dataPesquisado = Carbon::createFromFormat('Y-m-d', $dataSaida);
        //$dataPesquisado->add(1,'day');
        //$weekdays = Carbon::getDays();
        //$diaSemanaPesquisado = Carbon::create($dataPesquisado)->locale('pt-BR')->dayName;

        //dd($diaSemana);
        //retorna data com formato carbon
        //$test = Carbon::createFromFormat('Y-m-d', $dataSaida)->toDateString();
        
        $diaSemanaPesquisado = Carbon::create($dataPesquisado)->locale('pt-BR')->dayName;
        
        for($i = 0; $i < 4; $i++) {     
            $dataPesquisado->add(7,'day');       
            foreach($agenda as $a){
                if($a->dia_semana == $diaSemanaPesquisado) {
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
                }
            }
        }
        return view('verPassagens', ['linha' => $linhas, 'agenda' => $agenda, 'linhaPesquisada'=> $linhaPesq, 'dia' => $diaSemanaPesquisado]);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function linhaPesquisadaLogado(Request $request) {
        $linhaPesquisada = new Linha;
        $linhaPesquisada->origem = $request->SelecionarOrigem;
        $linhaPesquisada->destino = $request->SelecionarDestino;
        $linhaPesquisada->dataSaida = $request->dataSaida;
        $linha = Linha::all();
        return view('clients.selecionarPassagens', ['linhaPesquisada' => $linhaPesquisada, 'linha' => $linha]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function pagamento(Request $request)
    {
        $id = $request->selecionado;
        $linhaComprada = Linha::findOrFail($id);;
        
        //dd($linhaComprada);
        return view('clients.formaPagamento',['linhaComprada'=>$linhaComprada]);
    }
}
