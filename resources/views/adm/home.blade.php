@extends('components.layoutTelaAdm')
@section('contentTelaAdm')
<div class="container-home">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', { 'packages': ['corechart'] });

        function desenharPizza() {

            var tabela = new google.visualization.DataTable();

            tabela.addColumn('string', 'Linhas');
            tabela.addColumn('number', 'valores');
            tabela.addRows([
                ['Feira de Santana, BA - Salvador, BA', { v: 2000, f: 'R$ 2.000,00' }],
                ['Salvador, BA - Juazeiro, BA ', { v: 1000, f: 'R$ 1.000,00' }],
                ['Serrinha, BA - S. Gonçalo, BA', { v: 500, f: 'R$ 500,00' }],
                ['Amélia Rodrigues, BA - Camaçari, BA', { v: 800, f: 'R$ 800,00' }],
                ['Amélia Rodrigues, BA - Feira de Santana, BA', { v: 100, f: 'R$ 100,00' }]
            ]);

            const options = {

                backgroundColor : "#CAE9FF"

            }

            var grafico = new google.visualization.PieChart(document.getElementById('graficoPizza'));
            grafico.draw(tabela,options);
        }
        google.charts.setOnLoadCallback(desenharPizza);

    </script>

    <div id="graficoPizza"></div>

    <div  id="div-title">
        <div id="sub-div-title">
            <span>Linhas vendidas</span>
        </div>
    </div>
</div>

@endsection