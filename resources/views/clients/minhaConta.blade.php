@extends('components.layoutTelasCliente')

@section('contentTelasCliente')

<h1 class="color-blue-three titulo">Minha Conta</h1>
@if(!empty($msg))
    <h4 id="msg" style="text-align:center; color:lime">{{$msg}}</h4>
@endif
<div class="container-cadastro blue-three color-white cadastro cad-minha-conta">
    <form action="" method="post">
        @csrf

        <div>
            <div class="mb-3">
                <label class="form-label">Nome</label>
                <input type="text" maxlength="40" name="editNome" class="form-control @error('editNome')is-invalid @endif" value="{{$usuario->nome}}">


                @error('editNome')
                    <div class="invalid-feedback">

                        {{$message}}
                    
                    </div>

                    @enderror
                    
            </div>

            <div class="mb-3">
                <label class="form-label" >CPF</label>
                <input type="text" maxlength="11" name="editCPF" class="form-control" value="{{$usuario->cpf}}" readonly>
            </div>

            <div class="mb-3">
                <label class="form-label">Celular</label>
                <input type="text" maxlength="11" name="editCelular" class="form-control @error('editCelular')is-invalid @endif" value="{{$usuario->celular}}">

                @error('editCelular')
                    <div class="invalid-feedback">

                        {{$message}}
                    
                    </div>

                    @enderror

            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="text" name="" class="form-control" value="{{$usuario->email}}" readonly>
            </div>

            <div class="mb-3">
                <label class="form-label">Novo Email</label>
                <input type="email"  name="editEmailNovo" class="form-control @error('editEmailNovo')is-invalid @endif" value="{{old('editEmailNovo')}}">
            
                
                    @error('editEmailNovo')
                    <div class="invalid-feedback">

                        {{$message}}
                    
                    </div>

                    @enderror

            </div>

            <div class="mb-3">
                <label class="form-label">Confirmar Email</label>
                <input type="email"  name="editEmailNovoConfirm" class="form-control @error('editEmailNovoConfirm')is-invalid @endif" value="{{old('editEmailNovoConfirm')}}">
                
                @error('editEmailNovoConfirm')
                    <div class="invalid-feedback">

                        {{$message}}
                    
                    </div>

                    @enderror
            </div>

        </div>

        <div>
            <div class="mb-3">
                <label class="form-label" >Nova Senha</label>
                <input type="password" maxlength="25" name="editSenhaNova" class="form-control @error('editSenhaNova')is-invalid @endif" value="{{old('editSenhaNova')}}">


                @error('editSenhaNova')
                    <div class="invalid-feedback">

                        {{$message}}
                    
                    </div>

                    @enderror
            </div>

            <div class="mb-3">
                <label class="form-label" >Confirmar Senha</label>
                <input type="password" maxlength="25" name="editSenhaNovaConfirm" class="form-control @error('editSenhaNovaConfirm')is-invalid @endif"value="{{old('editSenhaNovaConfirm')}}">


                @error('editSenhaNovaConfirm')
                    <div class="invalid-feedback">

                        {{$message}}
                    
                    </div>

                    @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Senha Atual</label>
                <input type="password" maxlength="25" name="editSenhaAtual" class="form-control @error('editSenhaAtual')is-invalid @endif" value="{{old('editSenhaAtual')}}">


                @error('editSenhaAtual')
                    <div class="invalid-feedback">

                        {{$message}}
                    
                    </div>

                    @enderror
            </div>

            <input type="submit" value="Confirmar" class="btn blue-one mb-3">
            <input type="submit" value="Voltar" class="btn blue-one mb-3" onClick="window.location.href='/cliente'">

        </div>

    </form>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
    setTimeout(function() {
    $('#msg').fadeOut('fast');
}, 3000);
</script>
@endsection
