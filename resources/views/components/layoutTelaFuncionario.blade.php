<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://kit.fontawesome.com/3cfad52d8e.js" crossorigin="anonymous"></script> <!-- Puxando os icones-->
        <title>Funcionário</title>

        <link rel="stylesheet" href="{{asset('css/funcionario/style.css')}}">
        <link rel="stylesheet" href="{{asset('css/funcionario/home.css')}}">
        <link rel="stylesheet" href="{{asset('css/funcionario/paginaRelatorios.css')}}">
        <link rel="stylesheet" href="{{asset('css/funcionario/venderPassagens.css')}}">
        <link rel="stylesheet" href="{{asset('css/funcionario/gerenciarLinhas.css')}}">

    </head>

    <body id="body">
        <div id="menu-bar" onclick="menuOnClick()">
                <div id="bar1" class="bar"></div>
                <div id="bar2" class="bar"></div>
                <div id="bar3" class="bar"></div>
        </div>

        <header class="menu-lateral" id="menu-lateral">
            <div class="perfil">
                
                <p>Funcionário</p>
                <p>{{Session::get('usuario.nome')}}</p>
                    
                </div>
                <img class="imagem-perfil" src="https://russocorretora.com.br/images/foto-perfil-generica.jpg" alt="Foto-Perfil" id="imagem-perfil">

                <a href="/alterarFuncao">Alterar Função</a>
                <a href="#" id = "modalPerfil">Visualizar Perfil</a>
                <a href="{{route('site.logout')}}" class="sair"  onclick="verificarSair()">Sair</a>
            </div>

            <nav class="navbar-lateral">
            <ul>
                <a href="/funcionario"><li><i class="fas fa-house-user"></i>  Home</li></a>
                <a href="/funcionario/relatorios"><li><i class="fas fa-book-reader"></i>  Relatórios</li></a>
                <a href="/funcionario/venderpassagens"> <li><i class="fa fa-cart-plus" aria-hidden="true"></i>Vender Passagens</li></a>
                <a href="/funcionario/gerenciarLinhas"> <li><i class="fas fa-clipboard-list"></i>Gerenciar Linhas</li></a>
            </ul>

            </nav>

            <p class="logo-empresa">
                Viaje Aqui
            </p>

        </header>

            @yield('contentTelaFuncionario')

            <div id="caixaModal" class="container-modal">

                <div class="modal">
                    <button class="fechar">X</button>

                    <h3>Minha Conta</h3>

                    <label for="nome">Nome</label>
                    <input type="text" value="{{Session::get('usuario.nome')}}" disabled>

                    <label for="cpf">CPF</label> 
                    <input type="text" value="{{Session::get('usuario.cpf')}}" disabled>

                    <label for="senha">Senha</label>
                    <input type="password" value="{{Session::get('usuario.senha')}}" disabled>

                    <label for="celular">Celular</label>
                    <input type="text" value="{{Session::get('usuario.celular')}}" disabled>

                    <label for="email">Email</label>
                    <input type="text" value="{{Session::get('usuario.email')}}" disabled>

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
