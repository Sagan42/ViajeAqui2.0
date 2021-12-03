@extends('components.layoutTelasCadastrais')

@section('contentTelasCadastrais')

<div class="container-cadastro blue-three color-white">
    <h1>Login</h1>
    

    @if(session('message'))
    
        <h4 id="msg" style="text-align:center; color:Lime">{{session('message')}}</h4>

    @endif

    <form name="login-usuario" action="" method="post">
        @csrf
        <div class="mb-3">
            <label class="form-label">CPF</label>
            <input type="text" maxlength="11" name="loginCPF" class="form-control @error('loginCPF')is-invalid @endif" value="{{old('loginCPF')}}">

            @error('loginCPF')
                <div class="invalid-feedback">
                     {{$message}}
                </div>
                
            @enderror
              
        </div>
        <div class="mb-3">
            <label class="form-label" >Senha</label>
            <input type="password" maxlength="30" name="loginSenha" class="form-control @error('loginSenha')is-invalid @endif" value="{{old('loginSenha')}}">

            @error('loginSenha')
                <div class="invalid-feedback">
                     {{$message}}
                </div>
                
            @enderror

        </div>
        <input type="submit" value="Acessar" class="btn blue-one">
    </form>
    <a class="color-white" href="{{route('site.recuperar')}}">Esqueci a senha</a>
</div>

@endsection
