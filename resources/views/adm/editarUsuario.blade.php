@extends('components.layoutTelaAdm')
    <h2 class = "tituloPagina">Editar Usuario</h2>
    
    <div class = "container-editar-usuario">
        <h2>Dados Cadastrais</h2>  
        <form action="" method="post" class="form-editar-usuario">
          @csrf
        
           @foreach ($funcionarios as $fun)
           @if($fun->id == $id)
              <div>
                <label for="" >Nome   </label>
                <input type="text" name="editNome" value ="{{$fun->nome}}" class = "input-editar-usuario"> 
              </div>
              
              <div>
                <label for="">Senha</label>
                <input type="password" value ="{{$fun->senha}}" name="editSenha" class = "input-editar-usuario"> 
              </div>

             <div>
                <label for="">CPF</label>
                <input type="text" value ="{{$fun->cpf}}" name="editCPF" class = "input-editar-usuario"> 
             </div>

              <div>
                <label for="">Celular</label>
                <input type="text" value ="{{$fun->celular}}" name = "editCelular"class = "input-editar-usuario"> 
              </div>
              
              <div>
                <label for="">Email</label>
                <input type="text" value ="{{$fun->email}}" name="editEmail" class = "input-editar-usuario"> 
              </div>
              
              <div class="div-permissao">
                <label for="">Nivel/Permissao</label>
                
                <select name="tipoUsuario" id="select-tipo-usuario">

                @if($fun->tipoUsuario == 1)
                    <option value="1" selected>Funcionario</option>
                    <option value="2" >Adminstrador</option>
                 @elseif($fun->tipoUsuario == 2)   
                     <option value="1" >Funcionario</option>
                    <option value="2" selected>Adminstrador</option>
                 @endif   
                </select>
                
              </div>
              
              @endif
              @endforeach

            <div class="container-botao-editar-usuario"> 
            <button>
                Cancelar
            </button>

            <button type="submit">
                Confirmar
            </button>


        </div>
   
        </form>
        


    </div>

  



@section('contentTelaAdm')

@endsection