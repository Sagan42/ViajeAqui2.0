@extends('components.layoutTelasCadastrais')

@section('contentTelasCadastrais')
<section class="areaPassagem">
    <form method="GET" action="{{route('site.verPassagens')}}" class="areaPesquisa">
        <p>Compre aqui sua Passagem</p>
        
        <div class="origem">
            <p>Origem</p>
            <input type="text" maxlength="25" name="SelecionarOrigem" id="" placeholder="Feira de Santana">
        </div>  
        
        <div class="destino">
            <p>Destino</p>
            <input type="text" maxlength="25" name="SelecionarDestino" id="" placeholder="Salvador">   

        </div>

        <div class="dataTexto">
            <p>Data de saida</p>
        </div>

        <div class="IdaVolta">
            
            <input type="date" name="dataSaida"  value = "<?php echo date('Y-m-d'); ?>" />
        </div>

        <div class="botaoPesquisar">
            <button type="submit">Buscar Passagem</button>
        </div>
    
    </form>
    <p class="slogan">Viaje Com a gente</p>
</section>

<div class="separador" style="height: 400px; margin-bottom: 50px;" >
    <p class="slogan2" style="margin-top: 50px; text-align: center;">Destinos Mais Procurados</p>
    <div class="destinos" >

        <div class="locais">
            <img src="https://www.transportal.com.br/noticias/wp-content/uploads/2019/10/Ponte-para-praia-do-Forte-Bahia.jpg" alt="">
            <div class="valor">
                    <p class="cidade">Salvador<span style= "display:block">A partir de R$30,00</span></p>
                    <button>CONFIRA</button>
            </div>
        </div>
        <div class="locais">
            <img src="http://s204818.gridserver.com/wp-content/uploads/2018/01/Porto-Seguro-BA.jpg" alt="">
            <div class="valor">
                    <p class="cidade">Cabuçu<span style= "display:block">A partir de R$24,00</span></p>
                    <button>CONFIRA</button>
            </div>
        </div>
        <div class="locais">
            <img src="https://media.istockphoto.com/photos/table-mountains-lencois-chapada-diamantina-national-park-bahia-brazil-picture-id181095403?b=1&k=20&m=181095403&s=170667a&w=0&h=3cwRfqyMcXEOjar4i37e4NA4kueIvHAAQg4FzR1-7iQ=" alt="">
            <div class="valor">
                    <p class="cidade">Paulo Afonso<span style= "display:block">A partir de R$40,00</span></p>
                    <button>CONFIRA</button>
            </div>
        </div>

    </div>
</div>

<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="row">
                    <div class="col-6">
                        <ul class="list-unstyled">
                            <li><a href="">Product</a></li>
                            <li><a href="">Benefits</a></li>
                            <li><a href="">Partners</a></li>
                            <li><a href="">Team</a></li>
                        </ul>
                    </div>
                    <div class="col-6">
                        <ul class="list-unstyled">
                            <li><a href="">Documentation</a></li>
                            <li><a href="">Support</a></li>
                            <li><a href="">Legal Terms</a></li>
                            <li><a href="">About</a></li>
                        </ul>
                    </div>
                </div>
                <ul class="nav">
                    <li class="nav-item"><a href="" class="nav-link pl-0"><i class="fa fa-facebook fa-lg"></i></a></li>
                    <li class="nav-item"><a href="" class="nav-link"><i class="fa fa-twitter fa-lg"></i></a></li>
                    <li class="nav-item"><a href="" class="nav-link"><i class="fa fa-github fa-lg"></i></a></li>
                    <li class="nav-item"><a href="" class="nav-link"><i class="fa fa-instagram fa-lg"></i></a></li>
                </ul>
                <br>
            </div>
            
            <div class="col-md-2">
                <h5 class="text-md-right"></h5>
                <hr>
            </div>
            <div class="col-md-5 item text">
                <h5><i class="fa fa-bus"></i> ViajeAqui LTDA.</h5>
                <p>A ViajeAqui é uma plataforma que intermedeia viagens entre as pessoas que querem viajar e as empresas de fretamento executivo oferecendo uma alternativa mais barata, melhor e mais segura. As viagens chegam a custar menos do que a metade do preço da rodoviária e contam com seguro, motoristas treinados, veículos inspecionados e monitorados por GPS, câmera, além de outros itens de segurança.</p>
            </div>
            <p class="text-center">Copyright @2021 | Designed With by <a href="#">Horizon Inc.</a></p>
        </div>
    </div>
</footer>

<script>
    var today = new Date().toISOString().split('T')[0];
    document.getElementsByName("dataSaida")[0].setAttribute('min', today);
</script>

@endsection
