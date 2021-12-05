@extends('components.layoutTelaAdm')

@section('contentTelaAdm')
<h2 class = "tituloPagina">Listagem de Funcionários</h2>

<div class = "container-listar-clientes">
    <div class="container-pesquisa">
            <i class="fas fa-search"></i>
            <label for="pesquisaClientes">Pesquisa de Funcionários </label> 
            <input type="text">
    </div>
    
    <table>
        <thead>
            <th id="inicio-th"> # </th>
            <th >Nome</th>
            <th>CPF</th>
            <th>Permissao</th>
            <th id="final-th">Detalhes/Editar</th>
        </thead>
        
        @foreach ($usuarios as $usuario)
        <tr>
            <td> {{ $loop->index }} </td>
            <td> {{ $usuario->nome }} </td>
            <td> {{ $usuario->cpf }} </td>
             
            @if($usuario->tipoUsuario == 1)
            <td>Funcionario</td>
            @elseif ($usuario->tipoUsuario == 2)
            <td>Administrador</td>
            @endif 
            
            <td> <a href="/adm/editarUsuario/{{$usuario->id}}"><i class="fa fa-eye"></i></a> </td>
        </tr>
        @endforeach

    </table>

    <div class ="container-setas">
        <ul>{{$usuarios->onEachSide(1)->links()}}</ul>
        
    </div>



</div>
@endsection