@extends('components.layoutTelaAdm')

@section('contentTelaAdm')
<h2 class = "tituloPagina">Linhas de Onibus</h2>
    <div id="pagina-linhas-de-onibus">
       
        <div class="container-Linhas">
            <a href="/adm/cadLinha">
            <div>
                <i class="fas fa-road fa-3x"></i>


            </div>
            <p>
                CADASTRAR LINHA
            </p>
            </a>

        </div>

        <div class="container-Linhas">
            <a href="/adm/listarLinhas"><div>
            <i class="fas fa-th-list fa-3x"></i>
            </div>

            <p>
                LISTAGEM DE LINHAS
            </p>

            </a>

        </div>
        </div>

        

@endsection