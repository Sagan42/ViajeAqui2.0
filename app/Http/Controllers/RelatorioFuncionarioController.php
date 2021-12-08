<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
use Session;


class RelatorioFuncionarioController extends Controller
{
    public function gerarRelatorio_passagensVendidas (Request $request){
        $idUser = Session::get('usuario.id');

        $arrayLinha = DB::select('SELECT count(passagem.id) as qtd FROM passagem INNER JOIN funcionario on passagem.id_funcionario = funcionario.id WHERE funcionario.id_usuario = ?',[$idUser]);

        $vendidas = $arrayLinha[0]->qtd;

        return view('funcionario.relatorios', ['passagensVendidas' => $vendidas]);

    }
    //
    public function gerarRelatorio_passagensVendidasPorLinha (Request $request){
        $idUser = Session::get('usuario.id');
        $arrayLinha = DB::select('SELECT origem, destino, tipoLinha FROM passagem INNER JOIN linha on passagem.id_linha = linha.id INNER JOIN funcionario on passagem.id_funcionario = funcionario.id WHERE funcionario.id_usuario = ?',[$idUser]);


        $newArray = array();
        foreach ($arrayLinha as $obj){
            $str = "{$obj->origem} - {$obj->destino} - {$obj->tipoLinha}";
            array_push($newArray, $str );
        }

        $linha_passagensVendidas = array_count_values($newArray);
        //Tipo de relatorio 1 é o relatorio de passagens vendidas por linha
        $tipoRelatorio = 1;
        $pdf = PDF::loadView('funcionario.gerarPDF',compact('linha_passagensVendidas','tipoRelatorio'));
        return $pdf->setPaper('a4')->stream("relatorio.pdf");

    }

    public function gerarRelatorio_linhasQueMaisVendeu (Request $request){
        $idUser = Session::get('usuario.id');
        $arrayLinha = DB::select('SELECT origem, destino, tipoLinha FROM passagem INNER JOIN linha on passagem.id_linha = linha.id INNER JOIN funcionario on passagem.id_funcionario = funcionario.id WHERE funcionario.id_usuario = ?',[$idUser]);

        $newArray = array();
        foreach ($arrayLinha as $obj){
            $str = "{$obj->origem} - {$obj->destino} - {$obj->tipoLinha}";
            array_push($newArray, $str );
        }

        $linha_passagensVendidas = array_count_values($newArray);
        $arrayNovo = array();
        foreach($linha_passagensVendidas as $linha => $qtd){
            $arrayTemporario = array();
            array_push($arrayTemporario, $linha, $qtd);
            array_push($arrayNovo, $arrayTemporario);
        }

        array_multisort(array_map(function($element){
            return $element[1];
        },$arrayNovo),SORT_DESC,$arrayNovo);



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

