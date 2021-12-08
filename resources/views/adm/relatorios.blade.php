@extends('components.layoutTelaAdm')
@section('contentTelaAdm')
<div class="divRelatorio">
<h2>Relatórios</h2>
<input type="date" name="dataAcessoClientes" id="input-acesso-clientes" value = "{{$newData}}" onchange="mudarLinkRelatorio2()">

<div id="boxRelatorios">
    <a onclick="mudarLinkRelatorio1()" href="#" class="link">
        <div class="subBoxRelatorio relLeft">
            <div id="divRelInternal">
                <i id="iconsRelatorios" class="fa fa-users fa-5x" aria-hidden="true"></i>
            </div>
            <p id="titleRel">Passagens vendidas individuais por funcionários</label>
        </div>
    </a>

    <a>
        <div class="subBoxRelatorio relRight">
            <div id="divRelInternal">
                <p>{{$passagensVendidas}}</p>
            </div>
            <label id="titleRel">Passagens vendidas no dia</label>
        </div>
    </a>

    <a href="#" onclick="mudarLinkRelatorio3()">
        <div class="subBoxRelatorio relLeft">
            <div id="divRelInternal">
                <i id="iconsRelatorios" class="fa fa-road fa-5x" aria-hidden="true"></i>
            </div>
            <label id="titleRel">Passagens vendidas no dia por linha</label>
        </div>
    </a>

    <a href="#">
        <div class="subBoxRelatorio relRight">
            <div id="divRelInternal">
                <p>{{$acessos}}</p>
            </div>
            <label id="titleRel">Acesso de clientes por dia</label>
        </div>
    </a>

</div>
</div>
<script>
    function mudarLinkRelatorio1(){
        data = document.querySelector("input[type='date']").value;
        var guia = window.open(`/adm/relatorios/passvendidasfunc?data=${data}`, '_blank');
        guia.focus();
    }

    function mudarLinkRelatorio2(){
        data = document.querySelector("input[type='date']").value;
        window.open(`/adm/relatorios?data=${data}`);
        window.close();
    }

    function mudarLinkRelatorio3(){
        data = document.querySelector("input[type='date']").value;
        var guia = window.open(`/adm/relatorios/passvendidaslinha?data=${data}`, '_blank');
        guia.focus();
    }
</script>

@endsection
