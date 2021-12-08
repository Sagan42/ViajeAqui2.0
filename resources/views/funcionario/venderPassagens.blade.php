@extends('components.layoutTelaFuncionario')
@section('contentTelaFuncionario')
<div class="content-geral">

    <h2>Vender passagens</h2>
    
    
    <div>
        <form method="GET" action="{{route('site.client.selecionarPassagens')}}" class="form-selecionar-passagens">
            <div class="divOrigem">
                <label for="" class="color-blue-three" >Origem</label>
                <input type="text" maxlength="25" id="origem" name="SelecionarOrigem" class="form-control" value="">
                
            </div>
            <div id="trocaPesquisa">
                <br>
                <a onclick = "trocaPesquisa()" id= "botaoTrocarPesquisa"> <i class="fas fa-exchange-alt"></i> </a>
            </div>
            <div>
                <label for="" class="color-blue-three"  >Destino</label>
                <input type="text" maxlength="25" id="destino" name="SelecionarDestino" class="form-control" value="">
            </div>
            <div>
                <label for="" class="color-blue-three">Data de Saida</label>
                <input type="date"  name="dataSaida" class="form-control" value="">
            </div>
            <div>
                <br>
                <input type="submit" value="Buscar" class="blue-three">
            </div>
        </form>
        <div class="venderPassagemParaCPF">
            <div>
                <label for="" class="color-blue-three"  >Vender passagem para o CPF:</label>
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

@endsection
