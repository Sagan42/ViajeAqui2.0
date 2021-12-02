@extends('components.layoutTelasCliente')

@section('contentTelasCliente')
<div class="content-selecionar-passagens">
    <h1 class="titulo color-blue-three"> Selecionar Passagens </h1>
    <form method="GET" action="{{route('site.client.selecionarPassagens')}}" class="form-selecionar-passagens">
        <div>
            <br>
            <a href="{{route('site.client.home')}}" class="blue-three btnVoltar">
                <i class="bi bi-arrow-left"></i>
                 Voltar
            </a>
        </div>
        <div class="divOrigem">
            <label for="" class="color-blue-three" >Origem</label>
            <input type="text" maxlength="25" id="origem" name="SelecionarOrigem" class="form-control" value="{{$linhaPesquisada->origem}}">
            <a onclick = "trocaPesquisa()" id= "botaoTrocarPesquisa"> <i class="fas fa-exchange-alt"></i> </a>
        </div>
        <div>
            <label for="" class="color-blue-three"  >Destino</label>
            <input type="text" maxlength="25" id="destino" name="SelecionarDestino" class="form-control" value="{{$linhaPesquisada->destino}}">
        </div>
        <div>
            <label for="" class="color-blue-three">Data de Saida</label>
            <input type="date"  name="dataSaida" class="form-control" value="{{$linhaPesquisada->dataSaida}}">
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
                <th>Preço</th>
                <th class="th-last">Ação</th>
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
                                <td  class="border"><p>R${{$l->preco}},00</p></td>
                                <td  class="border td-last"><Button name="selecionado" value="{{$l->id}}" class="btn blue-three color-white">Comprar</Button></td>
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

</script> 

@endsection
