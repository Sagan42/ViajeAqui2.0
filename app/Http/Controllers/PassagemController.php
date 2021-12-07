<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Passagem;
use App\Models\Usuario;
use App\Models\Linha;
use App\Models\Cliente;
use App\Models\Viajem;
use Session;

class PassagemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Variaveis instanciadas para listar as passagens dos clientes
        $usuario = Usuario::find(Session::get('usuario.id'));
        $passagens = Passagem::all();
        $linha = Linha::all();
        $viajens = Viajem::all();
        $comprado = 0;

        return view('clients.minhasPassagens', ['passagens' => $passagens, 'linha' => $linha, 'usuario' => $usuario, 'viajens' => $viajens, 'comprado' => $comprado]);
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
