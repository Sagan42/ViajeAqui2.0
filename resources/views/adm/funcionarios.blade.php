@extends('components.layoutTelaAdm')

@section('contentTelaAdm')
<h2 class = "tituloPagina">Listagem de Funcionários</h2>

<div class = "container-listar-clientes">
    <div class="container-pesquisa">
        <form action="{{route("site.adm.pesquisarFuncionarios")}}" method="GET">

            <i class="fas fa-search"></i>
            <label for="pesquisaClientes">Pesquisa de Funcionários </label>

            @if(isset($nome))
                <input class="inputPesquisa" type="text" name="nome" title="Nome do Funcionario" value="{{$nome}}">
            @else
                <input class="inputPesquisa" type="text" name="nome" title="Nome do Funcionario" placeholder="Nome do Funcionario">
            @endif
          
            <button type="submit" class="btn btn-info btnPesquisar" title="Pesquisar"><i class="fas fa-search"></i></button>
    
        </form>    
    </div>
    
    <table>
        <thead>
            <th id="inicio-th"> # </th>
            <th >Nome</th>
            <th>CPF</th>
            <th>Permissao</th>
            <th id="final-th">Detalhes/Editar</th>
        </thead>
        
       @if($usuarios->total() == 0)
            <tr style="background-color: #fff;" >
                <td colspan="5" style="text-align: center;color: #810000d0; font-weight: bold" >
                   Sem Resultados
                </td>
            </tr>

        @else
        
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
        @endif
    </table>

    <div class ="container-setas">

        @if(isset($filtro))

            <ul>{{$usuarios->appends($filtro)->onEachSide(1)->links()}}</ul> 
    
        @else

            <ul>{{$usuarios->onEachSide(1)->links()}}</ul>
        
        @endif    
        
    </div>



</div>
@endsection