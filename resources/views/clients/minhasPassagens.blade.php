@extends('components.layoutTelasCliente')

@section('contentTelasCliente')
<div class="content-selecionar-passagens">
    <h1 class="titulo color-blue-three"> Passagens Compradas </h1>

    <table class="table">
        <thead >
            <tr class="blue-one">
                <th class="th-first">Data</th>
                <th>Saida</th>
                <th>Embarque/Desembarque</th>
                <th>Tipo de Linha</th>
                <th>Vagas</th>
                <th  class="th-last">Preço</th>
            </tr>
        </thead>
        <tbody>

        @foreach ($passagens as $p)
            @foreach ($linha as $l) 
            @if($l->dataSaida > date('Y-m-d'))
                @if($p->id_linha == $l->id && $p->ativo == 1 && $p->id_cliente == $usuario->id)   
                    <tr class="neutro"><td class="td-border_none"></td></tr>
                    <tr>
                        <td class="border td-first"><p>{{$l->dataSaida}}</p></td>
                        <td class="border"><p>{{$l->horario}}</p></td>
                        <td class="td-rota border">
                            {{$l->origem}}
                            <br>
                            {{$l->destino}}
                        </td>
                        <td  class="border"><p>{{$l->tipoLinha}}</p></td>
                        <td  class="border"><p>{{$l->quantidadePassagem}}</p></td>
                        <td  class="border td-last"><p>{{$l->preco}}</p></td>
                    </tr>
                @endif
              @endif      
            @endforeach
        @endforeach
            
        </tbody>
    </table>

    <h2 class="titulo2 color-blue-three"> Historico </h2>

    <table class="table table2">
        <thead >
            <tr class="blue-one">
                <th class="th-first">Data</th>
                <th>Saida</th>
                <th>Embarque/Desembarque</th>
                <th>Tipo de Linha</th>
                <th>Vagas</th>
                <th  class="th-last">Preço</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($passagens as $p)
                @foreach ($linha as $l) 
                    @if($l->dataSaida < date('Y-m-d'))
                    @if($p->id_linha == $l->id && $p->ativo == 1 &&$p->id_cliente == $usuario->id)   
                        <tr class="neutro"><td class="td-border_none"></td></tr>
                        <tr>
                            <td class="border td-first"><p>{{$l->dataSaida}}</p></td>
                            <td class="border"><p>{{$l->horario}}</p></td>
                            <td class="td-rota border">
                                {{$l->origem}}
                                <br>
                                {{$l->destino}}
                            </td>
                            <td  class="border"><p>{{$l->tipoLinha}}</p></td>
                            <td  class="border"><p>{{$l->quantidadePassagem}}</p></td>
                            <td  class="border td-last"><p>{{$l->preco}}</p></td>
                        </tr>
                    @endif
                  @endif      
                @endforeach
            @endforeach
        </tbody>
    </table>

</div>

@endsection

