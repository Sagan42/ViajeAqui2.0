<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\UsuarioController;
use App\Models\Adm;
use App\Models\Usuario;
use App\Models\Funcionario;

class AdmController extends Controller
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
        
        if($request->tipoUsuario==2){
            $usuario = app(\App\Http\Controllers\ClienteController::class)->store($request);
            $adm = new Adm;
            $adm->id_usuario = $usuario->id;
            $adm->admMaster = 0;
            $adm->save();            
        }else{
            app(\App\Http\Controllers\FuncionarioController::class)->store($request);
        }
        return redirect()->route('site.adm.cadUsuario');
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
        $usuario = Usuario::find($id);

        if($request->tipoUsuario == $usuario->tipoUsuario){
            $usuario->nome = $request->editNome;
            $usuario->senha = $request->editSenha;
            $usuario->cpf = $request->editCPF;
            $usuario->celular = $request->editCelular; 
            $usuario->email = $request->editEmail;
            $usuario->save();
        }else if($request->tipoUsuario == 1){
            $usuario->tipoUsuario = 1;
            $usuario->save();
            $adm = Adm::where('id_usuario', '=', $id)->first();
            app(\App\Http\Controllers\AdmController::class)->destroy($adm->id);
            $funcionario = new Funcionario;
            $funcionario->id_usuario = $usuario->id;
            $funcionario->save();
        }else{
            $usuario->tipoUsuario = 2;
            $usuario->save();
            $funcionario = Funcionario::where('id_usuario', '=', $id)->first();
            app(\App\Http\Controllers\FuncionarioController::class)->destroy($funcionario->id);
            $adm = new Adm;
            $adm->id_usuario = $usuario->id;
            $adm->admMaster = 0;
            $adm->save();
        }

        return redirect()->route('site.adm.funcionarios');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Adm::destroy($id);
    }

    public function storeLinha(Request $request){
        app(\App\Http\Controllers\LinhaController::class)->store($request);
        return redirect()->route('adm.cadLinha');
    }

    public function storeFuncionario(Request $request){
        app(\App\Http\Controllers\FuncionarioController::class)->store($request);
        return redirect()->route('adm.cadFuncionario');
    }

    public function storeFirstAdm(){
        $id_usuario = app(\App\Http\Controllers\UsuarioController::class)->storeUserAdm();
        $adm = new Adm;
        $adm->id_usuario = $id_usuario;
        $adm->admMaster = 1;
        $adm->save();
    }
}
