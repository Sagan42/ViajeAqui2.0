@extends('components.layoutTelasCadastrais')

@section('contentTelasCadastrais')
<div class="content-selecionar-passagens">
    <h1 class="titulo color-blue-three"> Passagens </h1>
    <form method="GET" action="{{route('site.verPassagens')}}" class="form-selecionar-passagens">
         <div>
            <br>
            <a href="{{route('site.home')}}" class="blue-three btnVoltar">
                <i class="bi bi-arrow-left"></i> 
                 Voltar
            </a>
        </div>
        <div class = "divOrigem">
            <label for="" class="color-blue-three">Origem</label>
            <input type="text" name="SelecionarOrigem" class="form-control " id="origem" value  = "{{$linhaPesquisada->origem}}">
            <a onclick = "trocaPesquisa()" id= "botaoTrocarPesquisa"> <i class="fas fa-exchange-alt"></i> </a>
        </div>
        <div>
            <label for="" class="color-blue-three">Destino</label>
            <input type="text"  name="SelecionarDestino" class="form-control " id="destino" value= "{{$linhaPesquisada->destino}}">
        </div>
        <div>
            <label for="" class="color-blue-three">Data de Saida</label>
            <input type="date"  name="dataSaida" class="form-control " value = "{{$linhaPesquisada->dataSaida}}">
        </div>
        <div>
            <br>
            <input type="submit" value="Buscar" class="blue-three">
        </div>
    </form>

    <table class="table">
        <thead >
            <tr class="blue-one">
                <th class="th-first">Data</th>
                <th>Saida</th>
                <th>Embarque/Desembarque</th>
                <th>Tipo de Linha</th>
                <th>Vagas</th>
                <th class="th-last">Preço</th>
            </tr>
        </thead>
        <tbody>
            <tr class="neutro"><td class="td-border_none"></td></tr>
            @foreach($linha as $l)
                @foreach($agenda as $a)
                    @if($a->id_linha == $l->id && $dia == $a->dia_semana)
                        <form method ="POST" action="{{route('site.client.formaPagamento')}}">
                        @csrf    
                            <tr>
                                <td class="border td-first"><p>{{$dataSaida}}</p></td>
                                <td class="border"><p>{{$a->hora}}</p></td>
                                <td class="td-rota border">
                                    {{$l->origem}}
                                    <br>
                                    {{$l->destino}}
                                </td>
                                <td  class="border"><p>{{$l->tipoLinha}}</p></td>
                                <td  class="border"><p>{{$l->quantidadePassagem}}</p></td>
                                <td  class="border td-last"><p>R${{$l->preco}},00</p></td>
                            </tr>
                        </form>
                    @endif
                @endforeach
            @endforeach
        </tbody>
    </table>

</div>

 <script>

    function trocaPesquisa(){

        const origem = document.getElementById('origem')
        const destino = document.getElementById('destino')
        var aux;
        
        aux = origem.value;
        origem.value = destino.value
        destino.value = aux


    }
    
    var today = new Date().toISOString().split('T')[0];
    document.getElementsByName("dataSaida")[0].setAttribute('min', today);


</script> 

@endsection
