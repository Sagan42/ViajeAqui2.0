<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
use Session;


class RelatorioAdmController extends Controller
{
    //

    public function gerarRelatorio_passagensVendidasIndividuais (Request $request){
        $arrayFunc = DB::select('SELECT nome FROM funcionario INNER JOIN usuario ON funcionario.id_usuario = usuario.id  INNER JOIN passagem ON funcionario.id = passagem.id_funcionario WHERE diaVenda = ?',[$request->data]);

        $newArray = array();
        foreach ($arrayFunc as $obj){
            array_push($newArray, $obj->nome);
        }

        $funcionario_passagensVendidas = array_count_values($newArray);

        $data = $request->data;
        $dataQuebrada = explode('-',$data);
        $dataPadrão = "{$dataQuebrada[2]}-{$dataQuebrada[1]}-{$dataQuebrada[0]}";

        //Tipo de relatorio 0 é o relatorio de passagens vendidas por funcionario
        $tipoRelatorio = 0;

        $pdf = PDF::loadView('adm.gerarPDF',compact('funcionario_passagensVendidas','data','tipoRelatorio'));
        return $pdf->setPaper('a4')->stream("relatorio do dia {$dataPadrão}.pdf");

    }

    //

    public function gerarRelatorio_passagensVendidasPorDia (Request $request){
        $data = date('Y-m-d');
        if($request->data != null){
            $data = $request->data;
        }
        $passagensVendidas = DB::select('SELECT count(id) as qtd FROM passagem where diaVenda = ?' ,[$data]);
        return view('adm.relatorios', ['passagensVendidas' => $passagensVendidas[0]->qtd, 'newData' => $data]);
    }

    //

    public function gerarRelatorio_passagensVendidasPorLinhaDia (Request $request){

        $arrayLinha = DB::select('SELECT passagem.origem as origem, passagem.destino as destino, passagem.tipoLinha as tipoLinha FROM passagem WHERE diaVenda = ?',[$request->data]);

        $newArray = array();
        foreach ($arrayLinha as $obj){
            $str = "{$obj->origem} - {$obj->destino} - {$obj->tipoLinha}";
            array_push($newArray, $str );
        }

        $linha_passagensVendidas = array_count_values($newArray);

        $data = $request->data;
        $dataQuebrada = explode('-',$data);
        $dataPadrão = "{$dataQuebrada[2]}-{$dataQuebrada[1]}-{$dataQuebrada[0]}";
        //Tipo de relatorio 1 é o relatorio de passagens vendidas por linha
        $tipoRelatorio = 1;
        $pdf = PDF::loadView('adm.gerarPDF',compact('linha_passagensVendidas','data','tipoRelatorio'));
        return $pdf->setPaper('a4')->stream("relatorio do dia {$dataPadrão}.pdf");

    }


}
