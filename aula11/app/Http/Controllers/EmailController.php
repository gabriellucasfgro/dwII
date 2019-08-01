<?php

namespace App\Http\Controllers;

use Request;
use App\Mail;
use App\Socio;
use App\Mail\EnviarEmail;

class EmailController extends Controller {

    public function enviar() {

        echo "<h2>enviar e-mail!</h2>";
    }

    public function concluir() {

        // Arquivo Selecionado
        $arquivo = Request::file('arq');
        // Nenhum Arquivo Selecionado
        if (empty($arquivo)) {
            $msg = "Selecione o ARQUIVO!";

            return view('messagebox')->with('tipo', 'alert alert-danger')
                    ->with('titulo', 'ENTRADA DE DADOS INVÁLIDA')
                    ->with('msg', $msg)
                    ->with('acao', "/");
        }
        // Efetua o Upload do Arquivo
        $path = $arquivo->store('uploads');

        // Efetua a Leitura do Arquivo
        $fp = fopen("../storage/app/".$path, "r");

        if ($fp != false) {
            // Array que receberá os dados do Arquivo
            $dados = array();
            
            $saldo_inicial = 0;
            $saldo_final = 0;
            $despesas = 0;
            $receita = 0;

            while(!feof($fp)) {

                $linha = utf8_decode(fgets($fp));

                if(!empty($linha)) {

                    $dados = explode("#", $linha);

                    if($dados[0] == 'S') {
                        $saldo_inicial =  $dados[1];
                        $saldo_final = $dados[1];
                    }
                    elseif($dados[0] == 'D') {
                        $saldo_final -= $dados[1];
                        $despesas += $dados[1];
                    }
                    elseif($dados[0] == 'R') {
                        $saldo_final += $dados[1];
                        $receita += $dados[1];
                    }
                }
            }
            // Envia e-mail com a senha para os gênios importados do .txt
            $dados_mail = array();
            $dados_mail['saldo_inicial'] = $saldo_inicial;
            $dados_mail['despesas'] = $despesas;
            $dados_mail['receita'] = $receita;
            $dados_mail['saldo_final'] = $saldo_final;

            $socios = Socio::all();

            foreach($socios as $objSocio) {
                if(isset($_POST["ck_$objSocio->id"])) {
                    $email = mb_strtolower($objSocio->email, 'UTF-8');
                    \Mail::to($email)->send( new EnviarEmail("mailImportar", $dados_mail, "SRF - Relatório Mensal Financeiro") );
                    sleep(1);
                }
            }
        }

        // Importação Finalizada com Sucesso
        $msg = "O E-mail contendo os dados financeiros foram enviados aos sócios marcados!";

        return view('messagebox')->with('tipo', 'alert alert-success')
                ->with('titulo', 'IMPORTAÇÃO DE DADOS')
                ->with('msg', $msg)
                ->with('acao', "/");
    }
}
