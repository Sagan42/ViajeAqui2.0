@extends('components.layoutTelaFuncionario')
@section('contentTelaFuncionario')
<div class="divRelatorio">
<h2>Relatórios</h2>
    <div id="boxRelatorios">
        <a href="#">
            <div class="subBoxRelatorio relLeft ">
                <div id="divRelInternal">
                    <i id="iconsRelatorios" class="fa fa-line-chart fa-5x" aria-hidden="true"></i>
                </div>
                <label id="titleRel">Passagens vendidas</label>
            </div>
        </a>

        <a href="#">
            <div class="subBoxRelatorio  relRight">
                <div id="divRelInternal">
                    <i id="iconsRelatorios" class="fa fa-road fa-5x" aria-hidden="true"></i>
                </div>
                <label id="titleRel">Passagens vendidas por linha</label>
            </div>
        </a>

        <a href="#">
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
