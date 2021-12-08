<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
use Session;


class RelatorioAdmController extends Controller
{
    //
    //Método para gerar relatorio de passagens vendidas por funcionário no dia
    public function gerarRelatorio_passagensVendidasIndividuais (Request $request){

        //select para trazer todos os funcionarios que venderam passagens no dia
        $arrayFunc = DB::select('SELECT nome FROM funcionario INNER JOIN usuario ON funcionario.id_usuario = usuario.id  INNER JOIN passagem ON funcionario.id = passagem.id_funcionario WHERE diaVenda = ?',[$request->data]);


        $newArray = array();
        foreach ($arrayFunc as $obj){
            array_push($newArray, $obj->nome);
        }

        //contar quantas passagens cada funcionario vendeu
        $funcionario_passagensVendidas = array_count_values($newArray);

        //pegar a data do dia, e colocar no padrão br dd/mm/yy
        $data = $request->data;
        $dataQuebrada = explode('-',$data);
        $dataPadrão = "{$dataQuebrada[2]}-{$dataQuebrada[1]}-{$dataQuebrada[0]}";

        //Tipo de relatorio 0 é o relatorio de passagens vendidas por funcionario
        $tipoRelatorio = 0;

        $pdf = PDF::loadView('adm.gerarPDF',compact('funcionario_passagensVendidas','data','tipoRelatorio'));
        return $pdf->setPaper('a4')->stream("relatorio do dia {$dataPadrão}.pdf");

    }

    //
    // metodo para gerar relatorio de passagens totais vendidas no dia, e quantidade de acessos no dia
    public function gerarRelatorio_passagensVendidasPorDia_eAcessos (Request $request){
        $data = date('Y-m-d');
        if($request->data != null){
            $data = $request->data;
        }
        //Select para saber quantas passagens foram vendidas no dia
        $passagensVendidas = DB::select('SELECT count(id) as qtd FROM passagem WHERE diaVenda = ?' ,[$data]);
        //Select para saber quantos acessos foram feitos no dia
        $acessos = DB::select("SELECT count(id) as qtd FROM acesso WHERE dataAcesso LIKE ".DB::getPdo()->quote("$data%"));
        return view('adm.relatorios', ['passagensVendidas' => $passagensVendidas[0]->qtd,'acessos' => $acessos[0]->qtd, 'newData' => $data]);
    }

    //
    //metodo para gerar relatorio de passagens vendidas por linha
    public function gerarRelatorio_passagensVendidasPorLinhaDia (Request $request){

        //select de linhas que venderam passagens no dia
        $arrayLinha = DB::select('SELECT passagem.origem as origem, passagem.destino as destino, passagem.tipoLinha as tipoLinha FROM passagem WHERE diaVenda = ?',[$request->data]);

        //tranformar o arraylinha que é uma matriz em uma lista de linhas
        $newArray = array();
        foreach ($arrayLinha as $obj){
            $str = "{$obj->origem} - {$obj->destino} - {$obj->tipoLinha}";
            array_push($newArray, $str );
        }
        //contar quantas passagens foram vendidas em cada linha, ou seja quantas vezes cada linha aparece nessa lista
        $linha_passagensVendidas = array_count_values($newArray);

        //pegar a data do dia, e colocar no padrão br dd/mm/yy
        $data = $request->data;
        $dataQuebrada = explode('-',$data);
        $dataPadrão = "{$dataQuebrada[2]}-{$dataQuebrada[1]}-{$dataQuebrada[0]}";

        //Tipo de relatorio 1 é o relatorio de passagens vendidas por linha
        $tipoRelatorio = 1;
        $pdf = PDF::loadView('adm.gerarPDF',compact('linha_passagensVendidas','data','tipoRelatorio'));
        return $pdf->setPaper('a4')->stream("relatorio do dia {$dataPadrão}.pdf");

    }


}
