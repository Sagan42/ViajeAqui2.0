<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Funcionario</th>
                <th>-</th>
                <th>Passagens Vendidas no dia {{$data}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($funcionario_passagensVendidas as $Key => $funcionario)
                <tr>
                    <td><h3>{{$Key}}</h3></td>
                    <td>-</td>
                    <td><h3>{{$funcionario}}</h3></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
