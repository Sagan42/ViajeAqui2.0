<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Linha;
use App\Models\Adm;
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
        $linhaPesquisada = new Linha;
        $linhaPesquisada->origem = $request->SelecionarOrigem;
        $linhaPesquisada->destino = $request->SelecionarDestino;
        $linhaPesquisada->dataSaida = $request->dataSaida;
        $linha = Linha::all();
        return view('verPassagens', ['linhaPesquisada' => $linhaPesquisada, 'linha' => $linha]);
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
