<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/home/home.css')}}">

    <link rel="icon" type="imagem/png" href="{{asset('img/bus.png')}}" />

    <title>Viaje Aqui</title>

</head>
<body class="blue-two">
    <header class="header">
        <nav class="navbar blue-one">
            <div class="mr-auto p-2 logo">
                <a href="{{route('site.client.home')}}">
                    <span>Viaje Aqui</span>
                </a>
            </div>
        </nav>
    </header>
       <div class="container-mudarLogin">
            <div id="mudarLogin1">
                @if (Session::get('usuario.tipoUsuario')==1)
                    <label>Funcionário</label>
                    <button> <a href="{{route('site.funcionario.home')}}"> Acessar </a> </button> 
                @else
                    <label>Administrador</label>
                    <button> <a href="{{route('site.adm.home')}}"> Acessar </a> </button>
                @endif
            </div>
            <div>
                <label>Cliente</label>
                <button><a href="{{route('site.alterarFuncao')}}"> Acessar </a></button> 
            </div>
       </div>
</body>



