
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="{{asset('css/adm/style.css')}}">
      
       <!-- <link rel="stylesheet" href="style.css">-->

        <title>ADM</title>
    </head>
    <body>
        <div class="menu">
            <label id="funcao">Administrador</label>
            <div class="photo"></div>

            <a class="links perfil" href="?">Visualizar Perfil</a>
            <a class="links logout" href="?">Sair</a>

                <a class="container" href="https://github.com/">
                    <img src="https://i.pinimg.com/originals/46/01/f7/4601f773e41c094849e10288a7aec5e8.png"  height="50px" width="50px" alt="" >
                    <label class="options">Relatórios</label>
                </a>

                <a class="container" href="https://github.com/">
                    <img src="https://i.pinimg.com/originals/46/01/f7/4601f773e41c094849e10288a7aec5e8.png"  height="50px" width="50px"  alt="">
                    <label class="options">Funcionários</label>
                </a>

                <a class="container" href="https://github.com/">
                    <img src="https://i.pinimg.com/originals/46/01/f7/4601f773e41c094849e10288a7aec5e8.png"  height="50px" width="50px" alt="" >
                    <label class="options">Clientes</label>
                </a>

                <a class="container" href="https://github.com/">
                    <img src="https://i.pinimg.com/originals/46/01/f7/4601f773e41c094849e10288a7aec5e8.png"  height="50px" width="50px" alt="" >
                    <label class="options">Linhas</label>
                </a>
                
        <!--    

            <table class="table">
                <tr>
                    <td>
                        <a class="links fuc" href="link1.htm">Relatórios</a>
                    </td>
                    <td>
                        <a class="links fuc" href="link1.htm">Relatórios</a>
                    </td>
                </tr>
                <tr>
                    <td>
                <a class="links fuc" href="link2.htm">Funcionários</a>
                    </td>
                    <td>
                    <a class="links fuc" href="link2.htm">Funcionários</a>
                    </td>
                </tr>
                <tr>
                    <td>
                    <img src="https://i.pinimg.com/originals/46/01/f7/4601f773e41c094849e10288a7aec5e8.png"  height="50px" width="50px" alt="" >
                    </td>
                    <td>
                    <a class="links fuc" href="link3.htm">Clientes</a>
                    </td>
                </tr>
                <tr>
                    <td>
                    <a class="links fuc" href="link4.htm">Linhas</a>
                    </td>
                    <td>
                    <a class="links fuc" href="link4.htm">Linhas</a>
                    </td>
                </tr>
                    
            </table>
                
            

		    <div class="menu fuctions">
		        <a class="f" href="link2.htm">Funcionários</a>
            </div>

            <div class="menu fuctions">
		        <a class="f" href="link3.htm">Clientes</a>
            </div>

            <div class="menu fuctions">
		        <a class="f" href="link4.htm">Linhas</a>
            </div>
	        -->
            <div class="rodape">
                <div class="logo"></div>
                <label class="nameSite">Viaje aqui!</label>
            </div>
            
        </div>

        <main>
            @yield('contentTelasAdm')
        </main>
    </body>
</html>

-->