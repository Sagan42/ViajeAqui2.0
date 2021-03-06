@extends('components.layoutTelaAdm')



@section('contentTelaAdm')

<h2 class = "tituloPagina">Listagem de Clientes</h2>

<div class = "container-listar-clientes">
    <div class="container-pesquisa">
        <form action="{{route('site.adm.pesquisarClientes')}}" method="GET">
            
            <i class="fas fa-search"></i>
            <label for="pesquisaClientes">Pesquisa de Clientes </label> 

            @if(isset($nome))
            
                <input  class="inputPesquisa" type="text" name="nome" title="Nome do Cliente" value="{{$nome}}">
           
            @else
                <input  class="inputPesquisa" type="text" name="nome" title="Nome do Cliente" placeholder="Nome do Cliente">
            @endif
            
            <button  type="submit" class="btn btn-info btnPesquisar" title="Pesquisar"><i class="fas fa-search"></i></button>
        </form>
    </div>
    
    <table>
        <thead>
            
            <th id="inicio-th">Nome</th>
            <th>CPF</th>
            <th id="final-th">Detalhes/Editar</th>
        </thead>
        
        @if($clientes->total() == 0)
            <tr style="background-color: #fff;" >
                <td colspan="5" style="text-align: center;color: #810000d0; font-weight: bold" >
                Sem Resultados
                </td>
            </tr>
            
        @else

            @foreach ($clientes as $cliente)
            <tr>
                
                <td> {{ $cliente->nome }} </td>
                <td> {{ $cliente->cpf }} </td>
                <td><a href="/adm/editarClientes/{{$cliente->id}}" title="Editar Cliente"><i class="far fa-eye"></i></td>
            </tr>
            @endforeach
        @endif
    </table>

    <div class ="container-setas">
        @if(isset($filtro))
        <ul>{{$clientes->appends($filtro)->onEachSide(1)->links()}}</ul> 
    
        @else

        <ul>{{$clientes->onEachSide(1)->links()}}</ul>
        
        @endif       
    </div>
    


</div>


@endsection