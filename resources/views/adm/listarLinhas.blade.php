@extends('components.layoutTelaAdm')

@section('contentTelaAdm')

<h2 class = "tituloPagina">Listagem de Linhas</h2>

        <div class = "container-listar-linhas">
            
            <div class="container-pesquisa">
                
                <form action="{{route("site.adm.pesquisarLinhas")}}" method="GET">
                    
                    <i class="fas fa-search"></i>
                        <label for="pesquisaLinhas">Pesquisa de Linhas </label>
                        
                        @if(isset($nome))
                            <input class="inputPesquisa" type="text" name="nome" title="Nome da Linha" value="{{$nome}}">
                        @else
                            <input class="inputPesquisa" type="text" name="nome" title="Nome da Linha" placeholder="Nome da Linha">
                        @endif

                        <button  type="submit" class="btn btn-info btnPesquisar" title="Pesquisar"><i class="fas fa-search"></i></button>
                </form>            
            
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
                
                @if(isset($filtro))
                    <ul>{{$linhas->appends($filtro)->onEachSide(1)->links()}}</ul>         
                @else    
                    <ul>{{$linhas->onEachSide(1)->links()}}</ul>            
                @endif         
            
            </div>



        </div>


@endsection