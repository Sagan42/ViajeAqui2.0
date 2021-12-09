<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Relatório</title>

    <link rel="icon" type="imagem/png" href="{{asset('img/bus.png')}}" />
</head>
<body>
    <h1 style="text-align: center">Relatorio Referente ao dia {{$data}}</h1>
    @if ($tipoRelatorio == 0)
        <h2 style="text-align: center">Passagens Vendidas por Funcionario</h2>
    @else
        <h2 style="text-align: center">Passagens Vendidas por Linha</h2>
    @endif
    <br>
    <table style="text-align: center;border-collapse: separate;border-spacing: 0px;width:90%;margin: 0 auto;">
        @if ($tipoRelatorio == 0)
            <thead>
                <tr>
                    <th><h3>Funcionario</h3></th>
                    <th><h3>Passagens Vendidas</h3></th>
                </tr>
            </thead>
            <tbody>
                @foreach($funcionario_passagensVendidas as $funcionario => $qtd)
                    <tr>
                        <td><h4>{{$funcionario}}</h4></td>
                        <td><h4>{{$qtd}}</h4></td>
                    </tr>
                @endforeach
            </tbody>

        @else
            <thead>
                <tr>
                    <th><h3>Linha</h3></th>
                    <th><h3>Tipo de Linha</h3></th>
                    <th><h3>Passagens Vendidas</h3></th>
                </tr>
            </thead>
            <tbody>
                @foreach($linha_passagensVendidas as $linha => $qtd)
                    <tr>
                        <td><h4>{{explode('-', $linha)[0]. '-'. explode('-', $linha)[1]}}</h4></td>
                        <td><h4>{{explode('-', $linha)[2]}}</h4></td>
                        <td><h4>{{$qtd}}</h4></td>
                    </tr>
                @endforeach
            </tbody>

        @endif
    </table>
</body>
</html>
