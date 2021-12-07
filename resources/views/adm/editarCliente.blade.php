@extends('components.layoutTelaAdm')
    <h2 class = "tituloPagina">Editar Usuario</h2>
    
    <div class = "container-editar-usuario">
        <h2>Dados Cadastrais</h2>  
        <form action="" method="post" class="form-editar-usuario">
          @csrf
            <div>
                <label for="" >Nome   </label>
                <input type="text" name="editNome" value ="{{$usuario->nome}}" class = "input-editar-usuario"> 
                </div>
              
                <div>
                    <label for="">Senha</label>
                    <input type="password" value ="{{$usuario->senha}}" name="editSenha" class = "input-editar-usuario"> 
                </div>

                <div>
                    <label for="">CPF</label>
                    <input type="text" value ="{{$usuario->cpf}}" name="editCPF" class = "input-editar-usuario"> 
                </div>

                <div>
                    <label for="">Celular</label>
                    <input type="text" value ="{{$usuario->celular}}" name = "editCelular"class = "input-editar-usuario"> 
                </div>
              
                <div>
                    <label for="">Email</label>
                    <input type="text" value ="{{$usuario->email}}" name="editEmail" class = "input-editar-usuario"> 
                </div>
              
                <div class="div-permissao fix">

                <div class="container-botao-editar-usuario">
                    <button>
                        Cancelar
                    </button>
        
                    <button type="submit">
                        Confirmar
                    </button>
                </div>
            </div>   
        </form>
    </div>
@section('contentTelaAdm')

@endsection