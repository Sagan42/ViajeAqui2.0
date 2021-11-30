@extends('components.layoutTelasCadastrais')

@section('contentTelasCadastrais')

<div class="container-cadastro blue-three color-white">
    <h1>Login</h1>
    <form name="login-usuario" action="" method="post">
        @csrf
        <div class="mb-3">
            <label class="form-label">CPF</label>
            <input type="text" maxlength="11" name="loginCPF" class="form-control ">
        </div>
        <div class="mb-3">
            <label class="form-label" >Senha</label>
            <input type="password" maxlength="30" name="loginSenha" class="form-control ">
        </div>
        <input type="submit" value="Acessar" class="btn blue-one">
    </form>
    <a class="color-white" href="{{route('site.recuperar')}}">Esqueci a senha</a>
</div>

@endsection
