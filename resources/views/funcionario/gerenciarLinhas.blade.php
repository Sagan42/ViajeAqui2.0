@extends('components.layoutTelaFuncionario')
@section('contentTelaFuncionario')
<div class="divGerenciarLinhas">
    <h2>Gerenciar Linhas<h2>

    <div class="divTabela">
        <div class="container-pesquisa">
            <i class="fas fa-search"></i>
            <label for="pesquisaLinhas">Pesquisar por Linhas </label> 
            <input type="text">
        </div>

        <table>
            <thead>
                <th id="inicio-th"> Nº </th>
                <th>TIPO</th>
                <th>ORIGEM</th>
                <th>DESTINO</th>
                <th>PREÇO</th>
                <th id="final-th">EDITAR</th>
            </thead>
        
            <tr id="lineImpar">
                <td id="inicio-th" > 1 </td>
                <td> LINHA DIRETA </td>
                <td> FEIRA DE SANTANA, BA </td>
                <td> SALVADOR, BA </td>
                <td> R$ 50,00 </td>
                <td id="final-th"><a href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
            </tr>
            <tr id="linePar">
                <td id="inicio-th"> 2 </td>
                <td> LINHA DIRETA </td>
                <td> FEIRA DE SANTANA, BA </td>
                <td> SALVADOR, BA </td>
                <td> R$ 50,00 </td>
                <td id="final-th"><a href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
            </tr>
            <tr id="lineImpar">
                <td id="inicio-th"> 3 </td>
                <td> LINHA DIRETA </td>
                <td> FEIRA DE SANTANA, BA </td>
                <td> SALVADOR, BA </td>
                <td> R$ 50,00 </td>
                <td id="final-th"><a href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
            </tr>
            <tr id="linePar">
                <td id="inicio-th"> 4 </td>
                <td> LINHA DIRETA </td>
                <td> FEIRA DE SANTANA, BA </td>
                <td> SALVADOR, BA </td>
                <td> R$ 50,00 </td>
                <td id="final-th"><a href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
            </tr>
        </table>
    <!--
        <div class="navegacao">
            <i class="far fa-caret-square-left fa-2x" style="float: left;"></i>
                <div class="divSpan">
                <span id="n1">1<span>
            </div>
            <i class="far fa-caret-square-right fa-2x"></i>
            
        </div>
    -->
    </div> 
</div>
@endsection
