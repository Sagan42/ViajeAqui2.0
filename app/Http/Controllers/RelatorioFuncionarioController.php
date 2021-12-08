<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
use Session;


class RelatorioFuncionarioController extends Controller
{
    //Método que gera o relatorio de passagens vendidas
    public function gerarRelatorio_passagensVendidas (Request $request){
        $idUser = Session::get('usuario.id');

        //seleciona todas as passagens vendidas pelo funcionario
        $arrayLinha = DB::select('SELECT count(passagem.id) as qtd FROM passagem INNER JOIN funcionario on passagem.id_funcionario = funcionario.id WHERE funcionario.id_usuario = ?',[$idUser]);

        $vendidas = $arrayLinha[0]->qtd;

        return view('funcionario.relatorios', ['passagensVendidas' => $vendidas]);

    }
    //
    //Método que gera o relatorio de passagens vendidas por linha
    public function gerarRelatorio_passagensVendidasPorLinha (Request $request){
        $idUser = Session::get('usuario.id');
        //Select de todas as passagens que um funcionario vendeu por linha
        $arrayLinha = DB::select('SELECT passagem.origem as origem, passagem.destino as destino, passagem.tipoLinha as tipoLinha FROM passagem INNER JOIN funcionario on passagem.id_funcionario = funcionario.id WHERE funcionario.id_usuario = ?',[$idUser]);

        //transforma os dados da consulta do banco, em um array com a linha e tipo de linha como os valores
        $newArray = array();
        foreach ($arrayLinha as $obj){
            $str = "{$obj->origem} - {$obj->destino} - {$obj->tipoLinha}";
            array_push($newArray, $str );
        }
        //faz a contagem de quantas linhas aparecem no arrai anterior, e assim tem a quantidade de passagens que foi vendida em cada linha
        $linha_passagensVendidas = array_count_values($newArray);
        //Tipo de relatorio 1 é o relatorio de passagens vendidas por linha
        $tipoRelatorio = 1;
        $pdf = PDF::loadView('funcionario.gerarPDF',compact('linha_passagensVendidas','tipoRelatorio'));
        return $pdf->setPaper('a4')->stream("relatorio.pdf");

    }

    //Método que gera o relatorio de passagens vendidas por linha de forma decrescente
    public function gerarRelatorio_linhasQueMaisVendeu (Request $request){
        $idUser = Session::get('usuario.id');
        $arrayLinha = DB::select('SELECT passagem.origem as origem, passagem.destino as destino, passagem.tipoLinha as tipoLinha FROM passagem INNER JOIN funcionario on passagem.id_funcionario = funcionario.id WHERE funcionario.id_usuario = ?',[$idUser]);

        $newArray = array();
        foreach ($arrayLinha as $obj){
            $str = "{$obj->origem} - {$obj->destino} - {$obj->tipoLinha}";
            array_push($newArray, $str );
        }

        $linha_passagensVendidas = array_count_values($newArray);
        $arrayNovo = array();
        //Cria uma matriz com os dados de linha e quantidade vendidas em cada linha
        foreach($linha_passagensVendidas as $linha => $qtd){
            $arrayTemporario = array();
            array_push($arrayTemporario, $linha, $qtd);
            array_push($arrayNovo, $arrayTemporario);
        }

        //Organiza a matriz em forma decrescente
        array_multisort(array_map(function($element){
            return $element[1];
        },$arrayNovo),SORT_DESC,$arrayNovo);


        //Poem os dados da matriz em uma lista
        $newArray = array();
        foreach ($arrayNovo as $obj){
            $str = "{$obj[0]} - {$obj[1]}";
            array_push($newArray, $str );
        }
        $linha_passagensVendidas = $newArray;
        //Tipo de relatorio 2 é o relatorio de linhas que mais foram vendidas passagens
        $tipoRelatorio = 2;
        $pdf = PDF::loadView('funcionario.gerarPDF',compact('linha_passagensVendidas','tipoRelatorio'));
        return $pdf->setPaper('a4')->stream("relatorio.pdf");

    }

}

