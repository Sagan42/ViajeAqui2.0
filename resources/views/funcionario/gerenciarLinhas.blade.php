@extends('components.layoutTelaFuncionario')

@section('contentTelaFuncionario')


        <div class = "container-listar-linhas">
            
            <h2 class = "tituloPagina" >Gerenciar Linhas</h2>
            <div class="container-pesquisa">
                
                <form action="{{route("site.funcionario.gerenciarLinhas")}}" method="GET">
                    
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
                    
                    <th id="inicio-th">Origem</th>
                    <th>Destino</th>
                    <th>Tipo da Linha</th>
                    <th id="final-th">Detalhes</th>
                </thead>
                
                @if($linhas->total() == 0)

                    <tr style="background-color: #fff;" >
                        <td colspan="5" style="text-align: center;color: #810000d0; font-weight: bold" >
                        Sem Resultados
                        </td>
                    </tr>
                    
                @else
                   @foreach ($linhas as $linha)
                    <tr>
                        
                        <td>{{ $linha->origem }}</td>
                        <td> {{ $linha->destino }}</td>
                        <td>{{ $linha->tipoLinha }}</td>
                        <td><a href="/funcionario/editarLinha/{{$linha->id}}"><i class="far fa-eye"></i></a></td>
                    </tr>
                    @endforeach
                @endif
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
