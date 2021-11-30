@extends('components.layoutTelaFuncionario')
@section('contentTelaFuncionario')
<div class="content-geral">

    <h1>Vender para</h1>

    <div class="informaçoes">
        <br>
        <div class="info">
            <h3>Saida/chegada</h3>
            <p>06:00 - 07:40</p>
        </div>

        <div class="info">
            <h3>Embarque/Desembarque</h3>
            <p>Salvador, BA - Feira de Santana, BA</p>
        </div>

        <div class="info">
            <h3>Tipo de Linha</h3>
            <p>Direta</p>
        </div>

        <div class="info">
            <h3>Duração</h3>
            <p>1h 40m</p>
        </div>

        <div class="info info-last">
            <h3>Preço</h3>
            <p>R$ 40,00</p>
        </div>

        <form action="" class="form-venderPassagens">
            <br>
            <label for="">Informe o CPF</label>
            <input type="text" placeholder="000.000.000-00">
            <br>
            <input class="button" type="submit" value="Vender">
        </form>
    </div>

</div>
@endsection
