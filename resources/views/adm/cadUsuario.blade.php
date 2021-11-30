@extends('components.layoutTelaAdm')
    <h2 class = "tituloPagina">Cadastrar Usuario</h2>
    
    <div class = "container-editar-usuario">
        <h2>Dados Cadastrais</h2>  
        <form action="" method="post" class="form-editar-usuario">
          @csrf
        
              <div>
                <label for="" >Nome   </label>
                <input type="text" name="cadNome"  class = "input-editar-usuario"> 
              </div>
              
              <div>
                <label for="">Senha</label>
                <input type="password" name="cadSenha" class = "input-editar-usuario"> 
              </div>

             <div>
                <label for="">CPF</label>
                <input type="text" name="cadCPF" class = "input-editar-usuario"> 
             </div>

              <div>
                <label for="">Celular</label>
                <input type="text" name="cadCelular" class = "input-editar-usuario"> 
              </div>
              
              <div>
                <label for="">Email</label>
                <input type="text" name="cadEmail" class = "input-editar-usuario"> 
              </div>
              
              <div class="div-permissao">
                <label for="">Nivel/Permissao</label>
                <select name="tipoUsuario" id="select-tipo-usuario">
                    <option value="1">Funcionario</option>
                    <option value="2">Adminstrador</option>
                </select>
              
              </div>


            <div class="container-botao-editar-usuario"> 
            <button type="reset">
                Limpar
            </button>

            <button type="submit">
                Confirmar
            </button>


        </div>
   
        </form>
        


    </div>

  



@section('contentTelaAdm')

@endsection