@extends('components.layoutTelasCadastrais')

@section('contentTelasCadastrais')

<div class="container-cadastro blue-three color-white cadastro">
    <h1>Cadastro</h1>

   
    <form name= "cadastro-usuario" action="" method="post">
        @csrf
        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" maxlength="50" name="cadNome" class="form-control @error('cadNome')is-invalid @endif"  value="{{old('cadNome')}}">

            @error('cadNome')
            <div class="invalid-feedback">

                {{$message}}
            
            </div>

            @enderror

        <div class="mb-3">
            <label class="form-label" >Senha</label>
            <input type="password" maxlength="25" name="cadSenha" class="form-control  @error('cadSenha')is-invalid @endif" value="{{old('cadSenha')}}">


            @error('cadSenha')

                <div class="invalid-feedback">

                     {{$message}}
            
                </div>
                
            @enderror

        </div>

        <div class="mb-3">
            <label class="form-label">Confirmar Senha</label>
            <input type="password" maxlength="25" name="cadConfSenha" class="form-control  @error('cadConfSenha')is-invalid @endif" value="{{old('cadConfSenha')}}">


             @error('cadConfSenha')

                <div class="invalid-feedback">

                     {{$message}}
            
                </div>
                
            @enderror

        </div>

        <div class="mb-3">
            <label class="form-label" >CPF</label>
            <input type="text" maxlength="11" name="cadCPF" class="form-control  @error('cadCPF')is-invalid @endif" value="{{old('cadCPF')}}">

            @error('cadCPF')

                <div class="invalid-feedback">

                    {{$message}}

                </div>

            @enderror

        </div>

        <div class="mb-3">
            <label class="form-label">Celular</label>
            <input type="text" maxlength="11" name="cadCelular" class="form-control  @error('cadCelular')is-invalid @endif"  value="{{old('cadCelular')}}" >


            @error('cadCelular')

                <div class="invalid-feedback">

                    {{$message}}

                </div>

            @enderror

        </div>
        <div class="mb-3">
            <label class="form-label" >Email</label>
            <input type="email" maxlength="50" name="cadEmail" class="form-control  @error('cadEmail')is-invalid @endif"  value="{{old('cadEmail')}}" >


            @error('cadEmail')

                <div class="invalid-feedback">

                    {{$message}}

                </div>

            @enderror

        </div>

        <div class="mb-3">
            <label class="form-label" >Confirmar Email</label>
            <input type="email" maxlength="50" name="cadConfEmail" class="form-control  @error('cadConfEmail')is-invalid @endif"  value="{{old('cadConfEmail')}}">


            @error('cadConfEmail')

                <div class="invalid-feedback">

                    {{$message}}

                </div>

            @enderror

        </div>

        <input type="submit" value="Cadastrar" class="btn blue-one">
    </form>
</div>

@endsection
