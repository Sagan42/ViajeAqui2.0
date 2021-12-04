<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\LoginUserRequest;
use App\Models\Usuario;
use App\Models\Cliente;
use App\Models\Acesso;
use App\Rules\ExistsPassword;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Hash;
class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = Usuario::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
            $usuario = new Usuario;
            $usuario->nome = $request->cadNome;
            $usuario->senha = Hash::make($request->cadSenha);
            $usuario->email = $request->cadEmail;
            $usuario->cpf = $request->cadCPF;
            $usuario->celular = $request->cadCelular;


            //alterar o tipo quando for funcionario ou adm
            if($request->tipoUsuario == null){
                $usuario->tipoUsuario = 0;
            }elseif($request->tipoUsuario == 1){
                $usuario->tipoUsuario = 1;
            }else{
                $usuario->tipoUsuario = 2;
            }

            $usuario->save();
            return $usuario;

        //cadastrar na tabela de clientes, verificar quem esta criando usuario
        //session()->put('id_user', $usuario->id);
        //echo session(key: 'id_user');
        //session()->put('id_user', $usuario->id);
        //return session(key: 'id_user');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function show(Usuario $usuario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */

    public function padraoEmail($email){
        //Mudar email para padrão xx***@******com
        $arrayEmail = explode('@',$email);

        $texto = substr($arrayEmail[0], -3);
        $arrayEmail[0] = str_replace($texto,'***',$arrayEmail[0]);

        $texto = substr($arrayEmail[1],0,6);
        $arrayEmail[1] = str_replace($texto,'******',$arrayEmail[1]);

        $emailMudado = "$arrayEmail[0]@$arrayEmail[1]";

        return $emailMudado;
        //Fim mudar email
    }

    public function edit(Usuario $usuario)
    {
        //pegar dados do user

        $usuario = Usuario::find(Session::get('usuario.id'));
        //echo $usuario;
        $pEmail = (\App\Http\Controllers\UsuarioController::padraoEmail($usuario->email));
        $usuario->email = $pEmail;
        return view('clients.minhaConta', ['usuario' => $usuario]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Usuario $usuario)
    {
        $usuario = Usuario::find(Session::get('usuario.id'));
        //Metodo para fazer com que fique escondida algumas informações do email
        $pEmail = (\App\Http\Controllers\UsuarioController::padraoEmail($usuario->email));

        if($request->editSenhaNova != null && $request->editSenhaNovaConfirm != null && $request->editSenhaNova != $request->editSenhaNovaConfirm){
            //Esconder informações do email para mandar para a tela
            $usuario->email = $pEmail;
            return view('clients.minhaConta', ['usuario' => $usuario, 'msg' => "As senhas estão diferentes"]);
        }
        else if($request->editSenhaNova != null && $request->editSenhaNovaConfirm == null){
            $usuario->email = $pEmail;
            return view('clients.minhaConta', ['usuario' => $usuario, 'msg' => "Preencha o campo CONFIRMAR SENHA"]);
        }

        else if($request->editSenhaNova == null && $request->editSenhaNovaConfirm != null){
            $usuario->email = $pEmail;
            return view('clients.minhaConta', ['usuario' => $usuario, 'msg' => "Preencha o campo NOVA SENHA"]);
        }

        else if($request->editEmailNovo != null && $request->editEmailNovoConfirm != null && $request->editEmailNovo != $request->editEmailNovoConfirm){
            $usuario->email = $pEmail;
            return view('clients.minhaConta', ['usuario' => $usuario, 'msg' => "Os Emails estão diferentes"]);
        }

        else if($request->editEmailNovo != null && $request->editEmailNovoConfirm == null){
            $usuario->email = $pEmail;
            return view('clients.minhaConta', ['usuario' => $usuario, 'msg' => "Preencha o campo CONFIRMAR EMAIL"]);
        }

        else if($request->editEmailNovo == null && $request->editEmailNovoConfirm != null){
            $usuario->email = $pEmail;
            return view('clients.minhaConta', ['usuario' => $usuario, 'msg' => "Preencha o campo NOVO EMAIL"]);
        }

        else if(Hash::check($request->editSenhaAtual, $usuario->senha)){
            if($request->editSenhaNova != null){
                $senhaComHash = Hash::make($request->editSenhaNova);
                $usuario->senha = $senhaComHash;
            }
            if($request->editEmailNovo != null){
                $usuario->email = $request->editEmailNovo;
            }

            $usuario->nome = $request->editNome;
            $usuario->celular = $request->editCelular;
            $usuario->save();

            $usuario->email = $pEmail;
            return view('clients.minhaConta', ['usuario' => $usuario, 'msg' => "Dados atualizados com sucesso"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usuario $usuario)
    {
        //
    }

    public function login(LoginUserRequest $request){

        $usuario = Usuario::where('cpf', $request->loginCPF)->get()->first();
        
        if(Hash::check($request->loginSenha, $usuario->senha) == true) {
            Session::put('usuario', $usuario);
            if($usuario->tipoUsuario == "0"){
                $cliente = Cliente::where([['id_usuario','=', $usuario->id]])->first();

                $acesso = new Acesso;
                $acesso->id_cliente = $cliente->id;
                $acesso->dataAcesso = now();
                $acesso->save();

                return redirect()->route('site.client.home');
            }
            else if($usuario->tipoUsuario == "1"){
                return redirect()->route('site.funcionario.home');
            }
            else if($usuario->tipoUsuario == "2"){
                return redirect()->route('site.adm.home');
            }
        }
        else{

            $request->validate([
                'loginSenha' => new ExistsPassword,
            ]);
        }                
    }

    public function logout(){
        Session::flush();
        return redirect()->route('site.home');
    }

    public function storeUserAdm(){
        $usuario = new Usuario;
        $usuario->nome = "Tiago";
        $usuario->senha = "PBL2021";
        $usuario->email = "tiago@hotmail.com";
        $usuario->cpf = "999999999";
        $usuario->celular = "75 999999999";
        $usuario->tipoUsuario = 3;
        $usuario->save();

        //session()->put('id_user', $usuario->id);
        Session::put('id_user', $usuario->id);
        //return session(key: 'id_user');
    }
}
