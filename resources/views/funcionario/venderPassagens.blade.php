@extends('components.layoutTelaFuncionario')


@section('contentTelaFuncionario')


<div class="content-geral">

    <h2>Vender passagens</h2>
    

    <div class="conteudo">
        <form method="GET" action="{{route('site.funcionario.selecionarPassagens')}}" class="form-selecionar-passagens">
            <div class="divOrigem">
                <label for="" class="color-blue-three" >Origem</label>
                <input type="text" maxlength="25" id="origem" name="SelecionarOrigem" class="form-control" title="Origem" 
                @if (isset($linhaPesquisada))
                value="{{$linhaPesquisada->origem}}"
                @else
                value=""
                @endif
                >
                
            </div>
            <div id="trocaPesquisa">
                <br>
                <a onclick = "trocaPesquisa()" id= "botaoTrocarPesquisa"> <i class="fas fa-exchange-alt"></i> </a>
            </div>
            <div>
                <label for="" class="color-blue-three">Destino</label>
                <input type="text" maxlength="25" id="destino" name="SelecionarDestino" class="form-control"  title="Destino"
                @if (isset($linhaPesquisada))
                value="{{$linhaPesquisada->destino}}"
                @else
                value=""
                @endif
                >
                
     
            </div>
            <div>
                <label for="" class="color-blue-three">Data de Saida</label>
                <input type="date"  name="dataSaida" class="form-control" value="<?php echo date('Y-m-d'); ?>">
            </div>
            <div>
                <br>
                <input type="submit" value="Buscar" class="blue-three">
            </div>
        </form>

        <table  class="tabelaPassagens"> 
            <thead >
                <tr class="cabecalho">
                    <th class="th-first">Data</th>
                    <th>Saida</th>
                    <th>Origem/Destino</th>
                    <th>Tipo de Linha</th>
                    <th>Vagas</th>
                    <th class="th-last">Preço</th>
                </tr>
            </thead>

            <tbody>
                <tr class="neutro"><td class="td-border_none"></td></tr>
                @if(isset($linha))
                @foreach($linha as $l)
                    @foreach($agenda as $a)
                        @if($a->id_linha == $l->id && $dia == $a->dia_semana)
                            <form method ="POST" action="{{route('site.client.formaPagamento')}}">
                            @csrf    
                                <tr>
                                    <input type="hidden" name="num_linha" value={{$l->num_linha}}>
                                    <input type="hidden" name="origemLinha" value={{$l->origem}}>
                                    <input type="hidden" name="destinoLinha" value={{$l->destino}}>
                                    <input type="hidden" name="tipoL" value={{$l->tipoLinha}}>
                                    <input type="hidden" name="precoLinha" value={{$l->preco}}>
                                    <td class=" td-first"><p>{{$dataSaida}}</p><input type="hidden" name="dataPesq" value={{$dataSaida}}></td>
                                    <td class="border"><p>{{$a->hora}}</p><input type="hidden" name="horaPesq" value={{$a->hora}}></td>
                                    <td class="td-rota border">
                                        {{$l->origem}} <span>/</span>
                                        <br>
                                        {{$l->destino}}
                                    </td>
                                    <td  class="border"><p>{{$l->tipoLinha}}</p></td>
                                    <td  class="border"><p>{{$l->quantidadePassagem}}</p></td>
                                    <td  ><p>R${{$l->preco}},00</p></td>
                                    
                                </tr>
                            </form>
                        @endif
                    @endforeach
                @endforeach
                @endif
            </tbody>


        </table>
        
        <div class="venderPassagemParaCPF">
            <div>
                <label for="" class="color-blue-three" >Vender passagem para o CPF:</label>
                <input type="text" maxlength="25" id="destino" name="SelecionarDestino" class="form-control" value="XXX.XXX.XXX-XX">
            </div>
            <div>
                <br>
                <input type="submit" value="Vender" class="blue-three">
            </div>
        </div>
    </div>
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


<script>

</script>
@endsection
