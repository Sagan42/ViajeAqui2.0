@extends('components.layoutTelaAdm')

@section('contentTelaAdm')

<h2 class = "tituloPagina">Listagem de Linhas</h2>

        <div class = "container-listar-linhas">
            <div class="container-pesquisa">
                    <i class="fas fa-search"></i>
                    <label for="pesquisaLinha">Pesquisa de Linhas </label> 
                    <input type="text">
            </div>
            
            <table>
                <thead>
                    <th id="inicio-th">&nbsp # &nbsp</th>
                    <th >Origem/Destino</th>
                    <th>Tipo da Linha</th>
                    <th id="final-th">Detalhes</th>
                </thead>
                
                @foreach ($linhas as $linha)
                <tr>
                    <td>{{ $linha->id }}</td>
                    <td>{{ $linha->origem }}/ {{ $linha->destino }}</td>
                    <td>{{ $linha->tipoLinha }}</td>
                    <td><i class="far fa-eye"></i></td>
                </tr>
                @endforeach

            </table>

            <div class ="container-setas">
                <i class="far fa-caret-square-left fa-2x"></i>
                <input type="text" class = "caixa-direcao-tabela">
                <i class="far fa-caret-square-right fa-2x"></i>
            </div>



        </div>


@endsection