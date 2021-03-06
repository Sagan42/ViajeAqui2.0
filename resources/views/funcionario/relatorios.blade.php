@extends('components.layoutTelaFuncionario')
@section('contentTelaFuncionario')
<div class="divRelatorio">
<h2>Relatórios</h2>
    <div id="boxRelatorios">
        <a>
            <div class="subBoxRelatorio relLeft">
                <div id="divRelInternal">
                    <p>{{$passagensVendidas}}</p>
                </div>
                <label style="cursor:default ;" id="titleRel">Passagens vendidas</label>
            </div>
        </a>

        <a href="relatorios/passvendidaslinha" target="_blank">
            <div class="subBoxRelatorio  relRight">
                <div id="divRelInternal">
                    <i id="iconsRelatorios" class="fa fa-road fa-5x" aria-hidden="true"></i>
                </div>
                <label id="titleRel">Passagens vendidas por linha</label>
            </div>
        </a>

        <a href="relatorios/linhasmaisvendidas" target="_blank">
            <div class="subBoxRelatorio subBoxRelatorio2 relLeft ">
                <div id="divRelInternal">
                    <i id="iconsRelatorios" class="fa fa-bar-chart fa-5x" aria-hidden="true"></i>
                </div>
                <p id="titleRel">Linhas que mais vendeu</label>
            </div>
        </a>
    </div>
</div>

@endsection
