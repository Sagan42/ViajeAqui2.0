<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/home/cadastro.css')}}">
    <link rel="stylesheet" href="{{asset('css/home/home.css')}}">
    <link rel="stylesheet" href="{{asset('css/clients/style.css')}}">

    <link rel="icon" type="imagem/png" href="{{asset('img/bus.png')}}" />

    <title>Viaje Aqui</title>

</head>
<body class="blue-two">
    <header class="header">
        <nav class="navbar blue-one">
            <div class="mr-auto p-2 logo">
                <a href="{{route('site.home')}}">
                    <span>Viaje Aqui</span>
                </a>
            </div>
            <aside class="links">
                <a class="btn blue-three " href="{{route('site.login')}}">Login</a>
                <a class="btn blue-three " href="{{route('site.cadastro')}}">Cadastrar</a>
            </aside>
        </nav>
    </header>

    <main>
        @yield('contentTelasCadastrais')
        
    </main>

    <footer>

    </footer>
</body>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<?php date_default_timezone_set('America/Bahia')?>

<script src="https://kit.fontawesome.com/3cfad52d8e.js" crossorigin="anonymous"></script>

</html>

