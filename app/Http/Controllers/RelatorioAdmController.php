<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RelatorioAdm;
use App\Models\Relatorio;
use App\Models\Adm;
use App\Models\Usuario;
use App\Models\Funcionario;
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
        $pdf = PDF::loadView('adm.gerarPDF',compact('funcionario_passagensVendidas','data'));
        return $pdf->setPaper('a4')->stream('relatorio.pdf');

        //('insert into tablename (columnname1,columnname2,) values (?,?)',[$id,$username]);


    }


}
