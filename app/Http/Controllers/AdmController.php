<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\UsuarioController;
use App\Models\Adm;
use App\Models\Usuario;
use App\Models\Funcionario;
use App\Models\Linha;
use App\Models\Cliente;
use App\Models\Passagem;
use App\Models\Viajem;
use App\Models\Agenda;
use App\Models\Log;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use Session;

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
        $admCadastrar = Adm::where('id_usuario','=',Session::get('usuario.id'))->first();
        
        $logEditar = new Log;
        $logEditar->id_adm = $admCadastrar->id;
        $r = $request;

        if($request->tipoUsuario==2){
            $usuario = app(\App\Http\Controllers\ClienteController::class)->store($request);
            $adm = new Adm;
            $adm->id_usuario = $usuario->id;
            $adm->admMaster = 0;
            $adm->save();
        }else if($request->tipoUsuario==1){
            app(\App\Http\Controllers\FuncionarioController::class)->store($request);
        }else{
            app(\App\Http\Controllers\ClienteController::class)->store($request);
        }
        
        
        if($r->cadNome != null){
            $logEditar->descricao = "Cadastro do usuário com nome = " . $r->cadNome;
        }
    
        $logEditar->save();

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
        $adm = Adm::where('id_usuario','=',$usuario->id)->first();
        $logEditar = new Log;
        $logEditar->id_adm = $adm->id;

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

        
        if($usuario->nome != null){
            $logEditar->descricao = "Edição de dados do usuário com nome = " . $usuario->nome;
        } else {
            $logEditar->descricao = "Edição de dados do usuário com id = " . $usuario->id;
        }        
        
        $logEditar->save();

        return redirect()->route('site.adm.funcionarios');
    }

    public function updateUsuario(Request $request, $id){

        $clientes = Cliente::find($id);
        $usuario = Usuario::find($clientes->id_usuario);
        $adm = Adm::where('id_usuario','=',Session::get('usuario.id'))->first();
        
        $logEditar = new Log;
        $logEditar->id_adm = $adm->id;

        $usuario->nome = $request->editNome;
        $usuario->senha = Hash::make($request->editSenha);
        $usuario->cpf = $request->editCPF;
        $usuario->celular = $request->editCelular;
        $usuario->email = $request->editEmail;
        $usuario->save();

        if($usuario->nome != null){
            $logEditar->descricao = "Edição de dados do usuário com nome = " . $usuario->nome;
        } else {
            $logEditar->descricao = "Edição de dados do usuário com id = " . $usuario->id;
        } 
        
        $logEditar->save();

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

    //Método de Listar funcionarios
    public function listarFuncionarios(){

        $usuarios = Usuario::where('tipoUsuario', '>=', "1")->orderBy('nome')->paginate(8);
        return view('adm.funcionarios', compact('usuarios'));

    }

    //Método de Listar clientes
    public function listarCLientes(){

        $clientes = Usuario::where('tipoUsuario', '=', "0")->orderBy('nome')->paginate(8);
        return view('adm.listaClientes', compact('clientes'));

    }

    //Método para listar Linhas
    public function listarLinhas(){
        $linhas = Linha::paginate(7);
        return view('adm.listarLinhas', compact('linhas'));
    }


    //Método de pesquisar clientes
    public function pesquisarClientes(Request $request){

        $clientes = Usuario::where('tipoUsuario', '=', '0')->where('nome', 'LIKE', "%{$request->nome}%" )->orderBy('nome')->paginate(7);
        $filtro = $request->all();
        $nome = $request->nome;
        return view('adm.listaClientes', compact('clientes','filtro','nome'));


    }

    //Método de pesquisar funcionarios
    public function pesquisarFuncionarios(Request $request){

        $usuarios = Usuario::where('tipoUsuario', '>=', '1')->where('nome', 'LIKE', "%{$request->nome}%" )->orderBy('nome')->paginate(7);
        $filtro = $request->all();
        $nome = $request->nome;
        return view('adm.funcionarios', compact('usuarios','filtro','nome'));


    }
    //Método de pesquisar linhas
    public function pesquisarLinhas(Request $request){

        $linhas = Linha::where('origem', 'LIKE', "%{$request->nome}%")->orWhere('destino', 'LIKE', "%{$request->nome}%")->paginate(7);
        $filtro = $request->all();
        $nome = $request->nome;
        return view('adm.listarLinhas', compact('linhas','filtro','nome'));

    }

    //Método para fazer backup do banco de dados
    public function backup(){
        $data = date('d-m-Y');
        $comand = shell_exec("mysqldump --host=localhost --user=root viajeaqui > Backup\/$data.sql");
        return redirect()->route('site.adm.home');
    }

    public function selecionarPassagens(Request $request){

       
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
        
        return view('adm.venderPassagens', ['linha' => $linhas, 'agenda' => $agenda, 'linhaPesquisada'=> $linhaPesq, 'dia' => $diaSemanaPesquisado, 'dataSaida' => $dataPesquisado]);

    }
    public function pagamento(Request $request){
        
        $id = $request->selecionado;
        $id_comum = $request->num_linha;
        $origemDaLinha = $request->origemLinha;
        $destinoDaLinha = $request->destinoLinha;
        $dataSaida = $request->dataPesq;
        $horaSaida = $request->horaPesq;
        $tipoL = $request->tipoL;
        $precoLinha = $request->precoLinha;
        $cpf = $request->cpf;
        
        $linha = Linha::where('origem','like', '%' . $origemDaLinha . '%')->first();
        $origemDaLinha = $linha->origem;

        $linha = Linha::where('destino','like', '%' . $destinoDaLinha . '%')->first();
        $destinoDaLinha = $linha->destino;
        
        if ($id_comum == null){
            $linhaComprada = Linha::findOrFail($id);
        } else {
            $linhaComprada = Linha::where('num_linha', $id_comum)->first();
        }

        return view('adm.pagamento',['linhaID' => $id, 
                                            'linhaComprada'=>$linhaComprada, 
                                            'dataSaida' => $dataSaida, 
                                            'horaSaida' => $horaSaida,
                                            'origemLinha' => $origemDaLinha,
                                            'destinoLinha' => $destinoDaLinha,
                                            'tipoLinha' => $tipoL,
                                            'precoLinha' => $precoLinha,
                                            'cpf' => $cpf]);

    }

    public function confirmarPagamento(Request $request)
    {
        //$usuario = Session::get('usuario'); 
        $usuario = Usuario::find(Session::get('usuario.id'));
        $funcionario = Adm::Where('id_usuario', '=', $usuario->id)->first();

        $passagens = Passagem::all();
        $linha = Linha::all();
        $viajens = Viajem::all();

        $dataSaida = $request->dataViajem;
        $horaSaida = $request->horaViajem;
        $origemL = $request->origemL;
        $destinoL = $request->destinoL;
        $precoL = $request->precoL;
        $tipoLinhaC = $request->tipoLinhaC;
        $cpfCliente = $request->cpfCliente;

        $origemL = Linha::where('origem','like', '%' . $origemL . '%')->first();
        $origemL = $origemL->origem;
        $destinoL = Linha::where('destino','like', '%' . $destinoL . '%')->first();
        $destinoL = $destinoL->destino;        

        $data = Carbon::createFromFormat('d/m/Y', $dataSaida)->format('Y-m-d');
        $idLinha = $request->idLinhaComprada;

        $linhaComprada = Linha::findOrFail($idLinha);
        $viajemBuscada = Viajem::where([['id_linha', '=', $linhaComprada->id]])
                                ->where([['dataViajem', '=', $data]])
                                ->first();        
        
        if($viajemBuscada != null && $viajemBuscada->quantidadePassagem != 0){
           $viajemBuscada->quantidadePassagem = ($viajemBuscada->quantidadePassagem - 1);
           $viajemBuscada->save();
        } else if ($viajemBuscada == null){
            $viajem = new Viajem;
            
            $viajem->dataViajem = $data;
            $viajem->horaViajem = $horaSaida;
            $viajem->id_linha = $linhaComprada->id;
            $viajem->quantidadePassagem = $linhaComprada->quantidadePassagem-1;
            $viajem->save();
            $viajemBuscada = $viajem;
        }

        $passagem = new Passagem;  
        $passagem->id_funcionario = $funcionario->id;
        $passagem->id_viajem = $viajemBuscada->id;
        
        $usuarioCliente = Usuario::Where('cpf', '=', $cpfCliente)->first();

        if ($usuarioCliente != null) {
            $cliente = Cliente::Where('id_usuario','=', $usuarioCliente->id)->first();
            $passagem->id_cliente = $cliente->id;

        } else {
            $passagem->id_cliente = null;
        }

        $passagem->origem = $origemL;
        $passagem->destino = $destinoL;
        $passagem->preco = $precoL;
        $passagem->tipoLinha = $tipoLinhaC;
        
        $passagem->diaVenda = Carbon::now()->format('Y-m-d');
        
        //dd($passagem);

        $comprado = 0;
        foreach ($passagens as $p) {
            if($p->id_cliente == $usuario->id && $p->id_viajem == $passagem->id_viajem) {
                $comprado++;
            }
        }
        
        if($comprado == 0){
            $passagem->save();
        }        
        
        $passagens = Passagem::all();
        $viajens = Viajem::all();

        $adm = Adm::where('id_usuario','=',Session::get('usuario.id'))->first();
        
        $logEditar = new Log;
        $logEditar->id_adm = $adm->id;
        
        if($cpfCliente != null){
            $logEditar->descricao = "Venda de Passagem para o cliente de cpf = " . $cpfCliente;
        }

        $logEditar->save();

        return view('adm.home',['linhaComprada'=>$linhaComprada, 'dataSaida' => $dataSaida, 'horaSaida' => $horaSaida, 'passagens' => $passagens, 'linha' => $linha, 'usuario' => $usuario, 'viajens' => $viajens, 'comprado' => $comprado]);
    }
}