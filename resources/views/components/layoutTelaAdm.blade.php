<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/3cfad52d8e.js" crossorigin="anonymous"></script> <!-- Puxando os icones-->
    <title>Administrador</title>

    <link rel="stylesheet" href="{{asset('css/adm/cadLinha.css')}}">
    <link rel="stylesheet" href="{{asset('css/adm/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/adm/listaClientes.css')}}">
    <link rel="stylesheet" href="{{asset('css/adm/paginaLinhas.css')}}">
    <link rel="stylesheet" href="{{asset('css/adm/listarLinhas.css')}}">
    <link rel="stylesheet" href="{{asset('css/adm/listarFuncionarios.css')}}">
    <link rel="stylesheet" href="{{asset('css/adm/paginaRelatorios.css')}}">
    <link rel="stylesheet" href="{{asset('css/adm/home.css')}}">
    <link rel="stylesheet" href="{{asset('css/adm/editarUsuario.css')}}">
    <link rel="stylesheet" href="{{asset('css/adm/cadUsuario.css')}}">



</head>
<body id="body">

        <div id="menu-bar" onclick="menuOnClick()">
                <div id="bar1" class="bar"></div>
                <div id="bar2" class="bar"></div>
                <div id="bar3" class="bar"></div>
        </div>

    <header class="menu-lateral" id="menu-lateral">

        <div class="perfil">


           <p>Administrador</p>

           <img class="imagem-perfil" src="https://russocorretora.com.br/images/foto-perfil-generica.jpg" alt="Foto-Perfil" id="imagem-perfil">


            <a href="#" id = "modalPerfil">Visualizar Perfil</a>
            <a href="{{route('site.logout')}}" class='sair' onclick="verificarSair()">Sair</a>
        </div>

        <nav class="navbar-lateral">
        <ul>
            <a href="/adm"><li><i class="fas fa-house-user"></i>  Home</li></a>
           <a href="/adm/relatorios"><li><i class="fas fa-book-reader"></i>  Relatórios</li></a>
           <a href="/adm/funcionarios"> <li><i class="fas fa-users"></i> Funcionários</li></a>
           <a href="/adm/listaClientes"> <li><i class="fas fa-id-card-alt"></i>  Clientes</li></a>
           <a href="/adm/paginaLinhas"><li><i class="fas fa-clipboard-list"></i> Linhas de Ônibus</li></a>
           <a href="/adm/cadUsuario"><li><i class="fas fa-user-plus"></i> Cadastrar Usuario</li></a>
        </ul>

        </nav>

        <p class="logo-empresa">
            Viaje Aqui
        </p>

    </header>


        @yield('contentTelaAdm')


        <div id="caixaModal" class="container-modal">

            <div class="modal">
                <button class="fechar">X</button>

                <img class="imagem-perfil" src="https://russocorretora.com.br/images/foto-perfil-generica.jpg" alt="Foto-Perfil" id="imagem-perfil">
                <input type="file" name="foto" id="input-foto" accept = "image/png image/jpg" onchange = "alterarFoto(id)" >

                <label for="nome">Nome</label>
                <input type="text">

                <label for="cpf">CPF</label>
                <input type="text">

                <label for="senha">Senha</label>
                <input type="password">

                <label for="celular">Celular</label>
                <input type="text">

                <label for="email">Email</label>
                <input type="text">

                <input type="submit" value="Confirmar">


            </div>

        </div>



</body>

<script>

    const body = document.getElementById("body");

    function menuOnClick() {

       const menulateral = document.getElementById("menu-lateral")

        menulateral.classList.toggle('change-navbar')

        document.getElementById("menu-bar").classList.toggle("change-bar");


        // Comparação para ajustar o conteudo ao centro
        if(body.className == "semNavbar"){
        document.getElementById("body").classList.remove("semNavbar");
        }else if(body.className != 'semNavbar'){
            document.getElementById("body").classList.add("semNavbar");
        }
    }


    const perfil = document.getElementById("modalPerfil");
    perfil.addEventListener('click', ()=> iniciaModal('caixaModal'));

    function iniciaModal(modalID){

        const modal = document.getElementById(modalID);
        modal.style.display = "flex"
      //  modal.classList.add('mostrar-modal')

        modal.addEventListener('click', (e) => {

            if(e.target.id === modalID || e.target.className === "fechar" || e.target.value === "Confirmar"){
                //modal.classList.remove('mostrar-modal')
               modal.style.display = "none"
            }

        })
    }

    // Verificação para botão de Sair
    function verificarSair(){
        const confimacao = confirm("Tem Certeza que Deseja Sair?")
        if(confimacao == false){
            btnSair = document.querySelector(".sair")
            btnSair.setAttribute("href",'')
        }
    }

</script>

</html>
