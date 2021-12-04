@extends('components.layoutTelasCadastrais')

@section('contentTelasCadastrais')

<div class="container-cadastro blue-three color-white">
    <h1>Recuperar Senha</h1>
    
    @if(!empty($msg))
    <h4 id="msg" style="text-align:center; color:lime">{{$msg}}</h4>
    @endif

    <form action="{{route('site.recuperar')}}" method="post">
    @csrf
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" maxlength="50" name="Email"  class="form-control blue-two @error('Email')is-invalid @endif">

            @error('Email')
                <div class="invalid-feedback">
                     {{$message}}
                </div>
                
            @enderror

        </div>
        <input type="submit" value="Enviar" class="btn blue-one">
    </form>
</div>

@endsection
