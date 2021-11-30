<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdmController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PassagemController;
use App\Http\Controllers\LinhaController;
use App\Http\Controllers\AgendaController;
use App\Models\Passagem;
use App\Models\Linha;
use App\Models\Usuario;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/** Rotas Logout */
Route::prefix('/')->middleware('checkLogout')->group(function(){
    Route::get('/', function () {
        return view('home');
    })->name('site.home');

    //Route::post('/verpassagens', [LinhaController::class, 'linhaPesquisada'])->name('site.verPassagens');
    Route::get('/verpassagens', [LinhaController::class, 'linhaPesquisada'])->name('site.verPassagens');

    Route::get('/login', function () {
        return view('telasCadastrais.login');
    })->name('site.login');

    Route::post('/login', [UsuarioController::class, 'login']);
    Route::get('/logout', [UsuarioController::class, 'logout'])->name('site.logout');

    

    Route::get('/recuperar', function () {
        return view('telasCadastrais.recuperarsenha');
    })->name('site.recuperar');
});

Route::get('/cadastro', [ClienteController::class, 'create'])->name('site.cadastro');
Route::post('/cadastro', [ClienteController::class, 'store'])->name('site.cadastro');

/** Rotas Cliente Cliente */
Route::prefix('/cliente')->middleware('checkCliente')->group(function(){
    Route::get('/', function () {
        return view('clients.home');
    })->name('site.client.home');

    Route::get('/conta', [UsuarioController::class, 'edit'])->name('site.client.minhaConta');
    Route::post('/conta', [UsuarioController::class, 'update'])->name('site.client.minhaConta');

    Route::get('/passagens', [PassagemController::class, 'index'])->name('site.client.minhasPassagens');

    Route::get('/cliente/passagens', [AgendaController::class, 'index'])->name('site.client.selecionarPassagens');

    Route::post('/pagamento', [LinhaController::class, 'pagamento'])->name('site.client.formaPagamento');
});


//  ADM ROTAS
Route::prefix('/adm')->middleware('checkAdm')->group(function(){
    Route::get('/', function () {
        return view('adm.home');
    })->name('site.adm.home');

    Route::get('/#', [AdmController::class, 'edit'])->name('site.adm.minhaConta');

    Route::get('/cadFuncionario', function() {
        return view();
    })->name('site.adm.cadFuncionario');
    Route::post('/cadFuncionario', [AdmController::class, 'storeFuncionario'])->name('site.adm.cadFuncionario');

    Route::get('/cadAdm', function(){
            return view();
    })->name('site.adm.cadAdm');
    Route::post('/cadAdm', [AdmController::class, 'store'])->name('site.adm.cadAdm');

    Route::get('/cadUsuario', function(){
        return view('adm.cadUsuario');
    })->name('site.adm.cadUsuario');

    Route::post('/cadUsuario', [AdmController::class, 'store'])->name('site.adm.cadUsuario');

    Route::get('/cadLinha', function() {
        return view('adm.cadLinha');
    })->name('site.adm.cadLinha');
    Route::post('/cadLinha', [LinhaController::class, 'store'])->name('site.adm.cadLinha');

    Route::get('/paginaLinhas', function(){
        return view('adm.paginaLinhas');
    })->name('site.adm.paginaLinhas');


    Route::get('/listaClientes', function(){
        $clientes = Usuario::where('tipoUsuario', '0')->orderBy('nome')->get();
        return view('adm.listaClientes', compact('clientes'));
    })->name('site.adm.listaClientes');

    Route::get('/listarLinhas', function(){
        $linhas = Linha::all();
        return view('adm.listarLinhas', compact('linhas'));
    })->name('site.adm.listarLinhas');

    Route::get('/funcionarios', function() {
        $usuarios = Usuario::where('tipoUsuario', '>=', "1")->orderBy('nome')->get();
        return view('adm.funcionarios', compact('usuarios'));
    })->name('site.adm.funcionarios');

    Route::get('/relatorios', function() {
        return view('adm.relatorios');
    })->name('site.adm.relatorios');

    Route::get('/editarUsuario/{id}', function($id) {
        $funcionarios = Usuario::where('tipoUsuario', '>=','1')->get();
        return view('adm.editarUsuario' ,['id'=> $id], compact('funcionarios'));
    })->name('site.adm.editarUsuario');

    Route::post('/editarUsuario/{id}', [AdmController::class, 'update'])->name('site.adm.editarUsuario');
});

//  FUNCIONARIOS ROTAS
Route::prefix('/funcionario')->middleware('checkFuncionario')->group(function(){
    Route::get('/', function () {
        return view('funcionario.home');
    })->name('site.funcionario.home');

    Route::prefix('/relatorios')->group(function(){
        Route::get('/', function () {
            return view('funcionario.relatorios');
        })->name('site.funcionario.relatorios');
    });

    Route::prefix('/venderpassagens')->group(function(){
        Route::get('/', function () {
            return view('funcionario.venderPassagens');
        })->name('site.funcionario.venderpassagens');
    });

    Route::prefix('/gerenciarLinhas')->group(function(){
        Route::get('/', function () {
            return view('funcionario.gerenciarLinhas');
        })->name('site.funcionario.gerenciarLinhas');
    });

    Route::prefix('/mudarLogin')->group(function(){
        Route::get('/', function () {
            return view('funcionario.mudarLogin');
        })->name('site.funcionario.mudaLogin');
    });

});