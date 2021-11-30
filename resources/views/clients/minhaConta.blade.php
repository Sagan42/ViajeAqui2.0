@extends('components.layoutTelasCliente')

@section('contentTelasCliente')

<h1 class="color-blue-three titulo">Minha Conta</h1>
@if(!empty($error))
    <h4 id="error" style="text-align:center; color:red">Preencha os dados corretamente</h4>
@endif
<div class="container-cadastro blue-three color-white cadastro cad-minha-conta">
    <form action="" method="post">
        @csrf

        <div>
            <div class="mb-3">
                <label class="form-label">Nome</label>
                <input type="text" maxlength="40" name="editNome" class="form-control blue-two" value="{{$usuario->nome}}">
            </div>

            <div class="mb-3">
                <label class="form-label" >CPF</label>
                <input type="text" maxlength="11" name="editCPF" class="form-control blue-two" value="{{$usuario->cpf}}" readonly>
            </div>

            <div class="mb-3">
                <label class="form-label">Celular</label>
                <input type="text" maxlength="11" name="editCelular" class="form-control blue-two" value="{{$usuario->celular}}">
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="text" name="" class="form-control blue-two" value="{{$usuario->email}}">
            </div>

            <div class="mb-3">
                <label class="form-label">Mudar Email</label>
                <input type="text"  name="editEmailNovo" class="form-control blue-two">
            </div>

            <div class="mb-3">
                <label class="form-label">Confirmar Email</label>
                <input type="text"  name="editEmailNovoConfirm" class="form-control blue-two">
            </div>

        </div>

        <div>
            <div class="mb-3">
                <label class="form-label" >Nova Senha</label>
                <input type="password" maxlength="25" name="editSenhaNova" class="form-control blue-two">
            </div>

            <div class="mb-3">
                <label class="form-label" >Confirmar Senha</label>
                <input type="password" maxlength="25" name="editSenhaNovaConfirm" class="form-control blue-two">
            </div>

            <div class="mb-3">
                <label class="form-label">Senha Atual</label>
                <input type="password" maxlength="25" name="editSenhaAtual" class="form-control blue-two" required>
            </div>

            <input type="submit" value="Confirmar" class="btn blue-one mb-3">
            <input type="submit" value="Voltar" class="btn blue-one mb-3" onClick="window.location.href='/cliente'">

        </div>

    </form>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
    setTimeout(function() {
    $('#error').fadeOut('fast');
}, 2000);
</script>
@endsection
