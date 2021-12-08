@extends('components.layoutTelaAdm')
    <h1 class = "tituloPagina">Cadastrar Usuario</h1>
    
    <div class = "container-cadastrar-usuario">
        <h2>Dados Cadastrais</h2>  
        <form action="" method="post" class="form-cadastrar-usuario">
          @csrf

          @if($errors->any())
                <p class="mensagemErro">

                    Dados inválidos, tente novamente!
                </p>

          @endif 
    
              <div>
                <label for="" >Nome   </label>
                <input type="text" name="cadNome"  class = "input-cadastrar-usuario"  value="{{old('cadNome')}}"> 
              </div>
              
              <div>
                <label for="">Senha</label>
                <input type="password" name="cadSenha" class = "input-cadastrar-usuario"  value="{{old('cadSenha')}}"> 
              </div>

             <div>
                <label for="">CPF</label>
                <input type="text" name="cadCPF" class = "input-cadastrar-usuario"  value="{{old('cadCPF')}}"> 
             </div>

              <div>
                <label for="">Celular</label>
                <input type="text" name="cadCelular" class = "input-cadastrar-usuario"  value="{{old('cadCelular')}}"> 
              </div>
              
              <div>
                <label for="">Email</label>
                <input type="text" name="cadEmail" class = "input-cadastrar-usuario"  value="{{old('cadEmail')}}"> 
              </div>
              
              <div class="div-permissao">
                <label for="">Nivel/Permissao</label>
                <select name="tipoUsuario" id="select-tipo-usuario">
                    <option value="0">Cliente</option>
                    <option value="1">Funcionario</option>
                    <option value="2">Adminstrador</option>
                </select>

                <div class="container-botao-cadastrar-usuario"> 
                  <button type="reset">
                      Limpar
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