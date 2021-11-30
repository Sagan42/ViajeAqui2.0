<?php date_default_timezone_set('America/Bahia')?>
@extends('components.layoutTelasCliente')

@section('contentTelasCliente')
<section class="areaPassagem">
    <form method="GET" action="{{route('site.client.selecionarPassagens')}}" class="areaPesquisa">
        <p class="titlePesquisa">Compre aqui sua Passagem</p>
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
            <input type="date" name="dataSaida" value = "<?php echo date('Y-m-d'); ?>">
        </div>
        <div class="botaoPesquisar">
            <button type="submit">Buscar Passagem</button>
        </div> 
    </form>
    <p class="slogan">Viaje Com a gente</p>
</section>
    <div class="separador">
    </div>
    <footer class="fundoCinza">
        <p>Destinos Mais Procurados</p>
        <div class="destinos">
            <div class="locais">
                <img src="https://www.transportal.com.br/noticias/wp-content/uploads/2019/10/Ponte-para-praia-do-Forte-Bahia.jpg" alt="">
                <div class="valor">
                        <p class="cidade">Salvador x Feira <span style= "display:block">Valor de XXX</span></p>
                        <button>CONFIRA</button>
                </div>
            </div>
            <div class="locais">
                <img src="http://s204818.gridserver.com/wp-content/uploads/2018/01/Porto-Seguro-BA.jpg" alt="">
                <div class="valor">
                        <p class="cidade">Salvador x Feira <span style= "display:block">Valor de XXX</span></p>
                        <button>CONFIRA</button>
                </div>
            </div>
            <div class="locais">
                <img src="https://media.istockphoto.com/photos/table-mountains-lencois-chapada-diamantina-national-park-bahia-brazil-picture-id181095403?b=1&k=20&m=181095403&s=170667a&w=0&h=3cwRfqyMcXEOjar4i37e4NA4kueIvHAAQg4FzR1-7iQ=" alt="">
                <div class="valor">
                        <p class="cidade">Salvador x Feira <span style= "display:block">Valor de XXX</span></p>
                        <button>CONFIRA</button>
                </div>
            </div>
        </div>
    </footer>
@endsection