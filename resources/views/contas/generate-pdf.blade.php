<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body style="font-size:  12px; margin:  0; padding:  0; background-color: #f8f9fa;">
    <h2 style="text-align: center; margin:  20px  0; font-size:  24px; font-weight:  500; line-height:  1.2;">Contas</h2>

    <table style="border-collapse: collapse; width:  100%; margin:  20px auto; border:  1px solid #dee2e6;">
        <thead>
            <tr style="background-color: #adb5bd; color: #fff;">
                <th style="border:  1px solid #dee2e6; padding:  8px; text-align: left;">Nome</th>
                <th style="border:  1px solid #dee2e6; padding:  8px; text-align: left;">Vencimento</th>
                <th style="border:  1px solid #dee2e6; padding:  8px; text-align: left;">Valor</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($contas as $conta)
            <tr>
                <td style="border:  1px solid #dee2e6; padding:  8px; text-align: left;">{{ $conta->name}}</td>
                <td style="border:  1px solid #dee2e6; padding:  8px; text-align: left;">{{ \Carbon\Carbon::parse($conta->expiration)->tz('America/Sao_Paulo')->format('d/m/Y')}}</td>
                <td style="border:  1px solid #dee2e6; padding:  8px; text-align: left;">{{ 'R$' . number_format($conta->value,  2, ',', '.')}}</td>
            </tr>
            @empty
            <tr>
                <td colspan="3" style="border:  1px solid #dee2e6; padding:  8px; text-align: center; color: #6c757d;">Nenhuma conta encontrada!</td>
            </tr>
            @endforelse
            <tr>
                <td colspan="2" style="border:  1px solid #dee2e6; padding:  8px; text-align: left;">Total</td>
                <td style="border:  1px solid #dee2e6; padding:  8px; text-align: left;">{{ 'R$' . number_format($totalValor, 2, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>
</body>

</html>