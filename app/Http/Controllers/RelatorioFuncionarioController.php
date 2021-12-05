<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
use Session;


class RelatorioFuncionarioController extends Controller
{
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

    public function gerarRelatorio_passagensVendidasPorLinhaDia (Request $request){
        $arrayLinha = DB::select('SELECT nome FROM funcionario INNER JOIN usuario ON funcionario.id_usuario = usuario.id  INNER JOIN passagem ON funcionario.id = passagem.id_funcionario WHERE diaVenda = ?',[$request->data]);

        $arrayLinha = DB::select('SELECT origem, destino, tipoLinha FROM passagem INNER JOIN linha on passagem.id_linha = linha.id WHERE diaVenda = ?',[$request->data]);

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
        $pdf = PDF::loadView('adm.gerarPDF',compact('linha_passagensVendidas','tipoRelatorio'));
        return $pdf->setPaper('a4')->stream("relatorio do dia {$dataPadrão}.pdf");

    }


}

