<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdmController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PassagemController;
use App\Http\Controllers\LinhaController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\RelatorioAdmController;
use App\Http\Controllers\RelatorioFuncionarioController;
use App\Models\Passagem;
use App\Models\Linha;
use App\Models\Usuario;
use App\Models\Cliente;

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



});

Route::get('/cadastro', [ClienteController::class, 'create'])->name('site.cadastro');
Route::post('/cadastro', [ClienteController::class, 'store'])->name('site.cadastro');

Route::get('/login', function () {
    return view('telasCadastrais.login');
})->name('site.login');

Route::post('/login', [UsuarioController::class, 'login']);
Route::get('/logout', [UsuarioController::class, 'logout'])->name('site.logout');


Route::get('/recuperar', function () {
    return view('telasCadastrais.recuperarsenha');
})->name('site.recuperar');

Route::post('/recuperar', [ClienteController::class, 'recuperar'])->name('site.recuperar');



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

    Route::post('/pagamento/concluido', [LinhaController::class, 'confirmarPagamento'])->name('site.client.confirmarPagamento');
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


    Route::get('/listarLinhas', [AdmController::class, 'listarLinhas'])->name('site.adm.listarLinhas');

    Route::get('/listaClientes', [AdmController::class, 'listarClientes'])->name('site.adm.listaClientes');

    Route::any('listaClientes/search', [AdmController::class, 'pesquisarClientes'])->name('site.adm.pesquisarClientes');

    Route::any('listaFuncionarios/search', [AdmController::class, 'pesquisarFuncionarios'])->name('site.adm.pesquisarFuncionarios');

    Route::any('listarLinhas/search', [AdmController::class, 'pesquisarLinhas'])->name('site.adm.pesquisarLinhas');

    Route::get('/editarClientes/{id}', function($id) {
        $clientes = Cliente::find($id);
        $usuario = Usuario::find($clientes->id_usuario);
        return view('adm.editarCliente' ,['id'=> $id], compact('usuario'));
    })->name('site.adm.editarClientes');

    Route::post('/editarClientes/{id}', [AdmController::class, 'updateUsuario'])->name('site.adm.editarCliente');

    Route::get('/funcionarios', [AdmController::class, 'listarFuncionarios'])->name('site.adm.funcionarios');

    Route::get('/editarUsuario/{id}', function($id) {
        $funcionarios = Usuario::where('tipoUsuario', '>=','1')->get();
        return view('adm.editarUsuario' ,['id'=> $id], compact('funcionarios'));
    })->name('site.adm.editarUsuario');

    Route::post('/editarUsuario/{id}', [AdmController::class, 'update'])->name('site.adm.editarUsuario');

    Route::prefix('/alterarFuncao')->group(function(){
        Route::get('/', function () {
            return view('adm.alterarFuncao');
        })->name('site.adm.alterarFuncao');
    });

    Route::get('/backup', [AdmController::class, 'backup']);

    Route::get('/backupHome', function () {
        return view('adm.home');
    })->name('site.adm.homeBackup');
    // ADM RELATORIOS ROTAS

    Route::get('/relatorios', [RelatorioAdmController::class, 'gerarRelatorio_passagensVendidasPorDia_eAcessos'])->name('site.adm.relatorios');

    Route::get('/relatorios/passvendidasfunc', [RelatorioAdmController::class, 'gerarRelatorio_passagensVendidasIndividuais'])->name('site.adm.relatorios.PassengensVendidasFuncionario');

    Route::get('/relatorios/passvendidaslinha', [RelatorioAdmController::class, 'gerarRelatorio_passagensVendidasPorLinhaDia'])->name('site.adm.relatorios.PassengensVendidasLinha');
});



//  FUNCIONARIOS ROTAS
Route::prefix('/funcionario')->middleware('checkFuncionario')->group(function(){
    Route::get('/', function () {
        return view('funcionario.home');
    })->name('site.funcionario.home');

    Route::prefix('/relatorios')->group(function(){
        Route::get('/', [RelatorioFuncionarioController::class, 'gerarRelatorio_passagensVendidas'] )->name('site.funcionario.relatorios');

        Route::get('/passvendidaslinha', [RelatorioFuncionarioController::class, 'gerarRelatorio_passagensVendidasPorLinha'])->name('site.funcionario.relatorios.PassengensVendidasLinha');

        Route::get('/linhasmaisvendidas', [RelatorioFuncionarioController::class, 'gerarRelatorio_linhasQueMaisVendeu'])->name('site.funcionario.relatorios.LinhasMaisVendidas');
    });

    Route::prefix('/venderpassagens')->group(function(){
        Route::get('/', function () {
            return view('funcionario.venderPassagens');
        })->name('site.funcionario.venderpassagens');
    });

    Route::get('/funcionario/venderPassagens/', [FuncionarioController::class, 'selecionarPassagens'])->name('site.funcionario.selecionarPassagens');

    Route::any('/gerenciarLinhas', [LinhaController::class, 'listarLinhaFuncionario'])->name('site.funcionario.gerenciarLinhas');

});
    
Route::prefix('/alterarFuncao')->group(function(){
    Route::get('/', function () {
        return view('funcionario.alterarFuncao');
    })->name('site.funcionario.alterarFuncao');


});


Route::get('/alterarFuncao/cliente', [UsuarioController::class, 'alterarFuncao'])->name('site.alterarFuncao');