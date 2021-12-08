<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\UsuarioController;
use App\Models\Adm;
use App\Models\Usuario;
use App\Models\Funcionario;
use App\Models\Linha;
use App\Models\Cliente;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;

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
    public function store(StoreUserRequest $request)
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
            $usuario->senha = Hash::make($request->editSenha);
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

    public function updateUsuario(Request $request, $id){

        $clientes = Cliente::find($id);
        $usuario = Usuario::find($clientes->id_usuario);

        $usuario->nome = $request->editNome;
        $usuario->senha = Hash::make($request->editSenha);
        $usuario->cpf = $request->editCPF;
        $usuario->celular = $request->editCelular;
        $usuario->email = $request->editEmail;
        $usuario->save();

        return redirect()->route('site.adm.listaClientes');
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

    public function listarFuncionarios(){

        $usuarios = Usuario::where('tipoUsuario', '>=', "1")->orderBy('nome')->paginate(8);
        return view('adm.funcionarios', compact('usuarios'));

    }

    public function listarCLientes(){

        $clientes = Usuario::where('tipoUsuario', '=', "0")->orderBy('nome')->paginate(8);
        return view('adm.listaClientes', compact('clientes'));

    }

    public function listarLinhas(){
        $linhas = Linha::paginate(7);
        return view('adm.listarLinhas', compact('linhas'));
    }


    public function pesquisarClientes(Request $request){

        $clientes = Usuario::where('tipoUsuario', '=', '0')->where('nome', 'LIKE', "%{$request->nome}%" )->orderBy('nome')->paginate(7);
        $filtro = $request->all();
        $nome = $request->nome;
        return view('adm.listaClientes', compact('clientes','filtro','nome'));


    }

    public function pesquisarFuncionarios(Request $request){

        $usuarios = Usuario::where('tipoUsuario', '>=', '1')->where('nome', 'LIKE', "%{$request->nome}%" )->orderBy('nome')->paginate(7);
        $filtro = $request->all();
        $nome = $request->nome;
        return view('adm.funcionarios', compact('usuarios','filtro','nome'));


    }

    public function pesquisarLinhas(Request $request){

        $linhas = Linha::where('origem', 'LIKE', "%{$request->nome}%")->orWhere('destino', 'LIKE', "%{$request->nome}%")->paginate(7);
        $filtro = $request->all();
        $nome = $request->nome;
        return view('adm.listarLinhas', compact('linhas','filtro','nome'));

    }

    public function backup(){
        $data = date('d-m-Y');
        $comand = shell_exec("mysqldump --column-statistics=0 --host=localhost --user=root viajeaqui > Backup\/$data.sql");
        return view('adm.home');
    }

}
