@extends('components.layoutTelaFuncionario')
@section('contentTelaFuncionario')

    <div class="container-home-funcionario">
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load('current', { 'packages': ['corechart'] });

            function desenharPizza() {

                var tabela = new google.visualization.DataTable();

                tabela.addColumn('string', 'Linhas');
                tabela.addColumn('number', 'valores');
                tabela.addRows([
                    ['Feira de Santana, BA - Vitória da Conquista, BA', { v: 1100, f: 'R$ 1.100,00' }],
                    ['Juazeiro, BA - Camaçari, BA', { v: 500, f: 'R$ 500,00' }],
                    ['Feira de Santana, BA - Serrinha, BA', { v: 2800, f: 'R$ 2.800,00' }]
                ]);

                const options = {
                    chartArea: {
                        left:0,
                        width:'92%',
                        height:'65%'
                    },
                    backgroundColor: "#CAE9FF",
                    pieSliceText: 'label',
                    slices: {
                        0: {offset: 0.3},
                        1: {offset: 0.3},
                    }, 
                    is3D: true,
                }

                var grafico = new google.visualization.PieChart(document.getElementById('graficoPizza'));
                grafico.draw(tabela, options);
            }
            google.charts.setOnLoadCallback(desenharPizza);

        </script>

        <div id="graficoPizza"></div>

        <div id="div-title">
            <div id="sub-div-title">
                <span>Linhas que mais vendem</span>
            </div>
        </div>
    </div>


@endsection
