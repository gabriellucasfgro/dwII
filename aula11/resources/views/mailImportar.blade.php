<!DOCTYPE html>
<html>
    <head>
        <title>SRF - Sistema de Relatório Financeiro</title>
    </head>
    <body>
        <h3>Prezado Sócio,</h3>
        <br>
        <b>Segue o relatório financeiro mensal: </b>
        <br>
        <h4>Saldo Inicial: {{ $dados['saldo_inicial'] }}</h4>
        <h4>Receitas: {{ $dados['receita'] }}</h4>
        <h4>Despesas: {{ $dados['despesas'] }}</h4>
        <h4>Saldo Final: {{ $dados['saldo_final'] }}</h4>
        <br>
        <b>Atenciosamente,</b>
        <b>SRF - Sistema de Relatório Financeiro.</b>
    </body>
</html>
