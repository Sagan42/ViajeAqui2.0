@extends('components.layoutTelasCliente')

@section('contentTelasCliente')
<div class="content-selecionar-passagens">
    <h1 class="titulo color-blue-three"> Passagens Compradas </h1>
    @if ($comprado == 1)
        <div class="msgBloqueio" id="msgConfirmacao">
            <i class="fas fa-times-circle fa-3x"></i>
            <p>Você ja comprou passagem para está viajem!</p>
        </div>
    @endif   
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
            @foreach ($viajens as $v)
                @if($v->dataViajem >= date('Y-m-d'))
                    @if($p->id_viajem == $v->id && $p->id_cliente == $usuario->id )   
                        <tr class="neutro"><td class="td-border_none"></td></tr>
                        <tr>
                            <td class="border td-first"><p>{{$v->dataViajem}}</p></td>
                            <td class="border"><p>{{$v->horaViajem}}</p></td>
                            <td class="td-rota border">
                                {{$p->origem}}
                                <br>
                                {{$p->destino}}
                            </td>
                            <td  class="border"><p>{{$p->tipoLinha}}</p></td>
                            <td  class="border td-last"><p>R${{$p->preco}},00</p></td>
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
                <th  class="th-last">Preço</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($passagens as $p)
                @foreach ($viajens as $v)
                    @if($v->dataViajem < date('Y-m-d'))
                        @if($p->id_viajem == $v->id && $p->id_cliente == $usuario->id)   
                            <tr class="neutro"><td class="td-border_none"></td></tr>
                            <tr>
                                <td class="border td-first"><p>{{$v->dataViajem}}</p></td>
                                <td class="border"><p>{{$v->horaViajem}}</p></td>
                                <td class="td-rota border">
                                    {{$p->origem}}
                                    <br>
                                    {{$p->destino}}
                                </td>
                                <td  class="border"><p>{{$p->tipoLinha}}</p></td>
                                <td  class="border td-last"><p>R${{$p->preco}},00</p></td>
                            </tr>
                        @endif
                    @endif     
                @endforeach  
            @endforeach
        </tbody>
    </table>
     
</div>
<script>
    const t = document.getElementById('msgConfirmacao')

    setTimeout("bloqueioPassagem()", 4000);         
    t.style.display = 'block'
    t.classList.toggle('mostrar')

    function bloqueioPassagem() {
        t.style.display = "none";
    }

</script>
@endsection

