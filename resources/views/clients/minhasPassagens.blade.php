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
                <th  class="th-last">Preço</th>
            </tr>
        </thead>
        <tbody>

        @foreach ($passagens as $p)
            @foreach ($linha as $l)
                @foreach ($viajens as $v)
                    @if($v->id_linha == $l->id && $v->dataViajem >= date('Y-m-d'))
                        @if($p->id_viajem == $v->id && $p->id_cliente == $usuario->id )   
                            <tr class="neutro"><td class="td-border_none"></td></tr>
                            <tr>
                                <td class="border td-first"><p>{{$v->dataViajem}}</p></td>
                                <td class="border"><p>{{$v->horaViajem}}</p></td>
                                <td class="td-rota border">
                                    {{$l->origem}}
                                    <br>
                                    {{$l->destino}}
                                </td>
                                <td  class="border"><p>{{$l->tipoLinha}}</p></td>
                                <td  class="border td-last"><p>R${{$l->preco}},00</p></td>
                            </tr>
                        @endif
                    @endif     
                @endforeach     
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
                <th  class="th-last">Preço</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($passagens as $p)
            @foreach ($linha as $l)
                @foreach ($viajens as $v)
                    @if($v->id_linha == $l->id && $v->dataViajem < date('Y-m-d'))
                        @if($p->id_viajem == $v->id && $p->id_cliente == $usuario->id)   
                            <tr class="neutro"><td class="td-border_none"></td></tr>
                            <tr>
                                <td class="border td-first"><p>{{$v->dataViajem}}</p></td>
                                <td class="border"><p>{{$v->horaViajem}}</p></td>
                                <td class="td-rota border">
                                    {{$l->origem}}
                                    <br>
                                    {{$l->destino}}
                                </td>
                                <td  class="border"><p>{{$l->tipoLinha}}</p></td>
                                <td  class="border td-last"><p>R${{$l->preco}},00</p></td>
                            </tr>
                        @endif
                    @endif     
                @endforeach     
            @endforeach
        @endforeach
        </tbody>
    </table>

</div>

@endsection

