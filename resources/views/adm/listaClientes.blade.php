@extends('components.layoutTelaAdm')



@section('contentTelaAdm')

<h2 class = "tituloPagina">Listagem de Clientes</h2>

<div class = "container-listar-clientes">
    <div class="container-pesquisa">
            <i class="fas fa-search"></i>
            <label for="pesquisaClientes">Pesquisa de Clientes </label> 
            <input type="text">
    </div>
    
    <table>
        <thead>
            <th id="inicio-th"> # </th>
            <th >Nome</th>
            <th>CPF</th>
            <th id="final-th">Detalhes/Editar</th>
        </thead>
        
        @foreach ($clientes as $cliente)
        <tr>
            <td> {{ $loop->index }} </td>
            <td> {{ $cliente->nome }} </td>
            <td> {{ $cliente->cpf }} </td>
            <td><i class="far fa-eye"></i></td>
        </tr>
        @endforeach

    </table>

    <div class ="container-setas">
        <ul>{{$clientes->onEachSide(1)->links()}}</ul>        
    </div>
    


</div>


@endsection