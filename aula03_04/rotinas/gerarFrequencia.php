<?php

	include_once '../global.php';
	include_once '../recursos/fpdf/fpdf.php';

	// Instancia o objeto
	$pdf = new FPDF("P", "mm", "A4");
	// Abre o documento
	$pdf->Open();

	$alunos = modeloAluno::getAlunos();

    while($objAluno = $alunos->fetchObject()) {

        $aulas = modeloAula::getAulas();
        $total = 0;
        $faltas = 0;

        // Adiciona uma página
		$pdf->AddPage();
		// Adiciona uma imagem na posição e tamanho especificados
		$pdf->Image('../recursos/img/topo_certificado.jpeg', 0, 0, 200, 27);
		// Define a espessura e desenha duas linha
		$pdf->SetLineWidth(0.4);
		$pdf->Line(5, 28, 204, 28);
		// Define a fonte do texto, a posição 'x' e 'y' da célula que será escrita
		$pdf->SetFont("Arial","B", 24);
		$pdf->SetY(10); $pdf->SetX(10);
		// Adiciona a célula/texto ao documento - alinhamento centralizado
		$pdf->Cell(188, 60, "Relatorio Frequencia", 0, 0, 'C');
		$pdf->SetFont("Arial","B", 16);
		$pdf->Text(60, 65, iconv("utf-8","iso-8859-1", $objAluno->nome));
        $pdf->SetFont("Arial","B", 14);
        $pdf->Text(70, 115, iconv("utf-8","iso-8859-1", "DESCRIÇÃO DA FREQUÊNCIA"));
		$pdf->Text(22, 130, iconv("utf-8","iso-8859-1", "CONTEÚDO DA AULA"));
		$pdf->Text(176, 130, iconv("utf-8","iso-8859-1", "FALTAS"));

		$faltas = 0;
		$linha = 140;
        $total = 0;

		$pdf->SetFont("Arial","IU", 10);

        while($objAula = $aulas->fetchObject()) {
            $frequencia = modeloFrequencia::verificaAlunoFrequencia($objAula->id, $objAluno->id);
             
            if($frequencia) {
            	$pdf->Text(22, $linha, iconv("utf-8","iso-8859-1", $objAula->conteudo));
            	$pdf->Text(180, $linha, iconv("utf-8","iso-8859-1", $frequencia->faltas));
                $faltas += $frequencia->faltas;
                $linha += 7;
                $total += 4;
            }
            else {
            	$pdf->Text(22, $linha, iconv("utf-8","iso-8859-1", $objAula->conteudo));
            	$pdf->Text(180, $linha, iconv("utf-8","iso-8859-1", '0'));
            	$linha += 7;
            	$total += 4;
            }
        }

        // Define fonte / Insere um texto de maneira direta, sem utilizar célula
		$pdf->Text(180, $linha, iconv("utf-8","iso-8859-1", $faltas));
        $freq = (100*($total-$faltas))/$total;
        // Define a fonte do texto, a posição 'x' e 'y' da célula que será escrita
        $pdf->SetFont("Arial","", 16);
		$pdf->SetY(90); $pdf->SetX(30);
        // Define o texto da célula - utilliza função iconv() para obter corretmente os acentos do texto
        if($freq >= 75) {
        	$pdf->SetTextColor(0,0,255);
        }
        else {
        	$pdf->SetTextColor(255,0,0);
        }
		$texto = iconv("utf-8", "iso-8859-1", 'Frequência total: '.$freq.'%');
		// Adiciona a célula/texto ao documento - alinhamento centralizado
		$pdf->Cell(150, -13, $texto, 0, 0, 'C');

        $pdf->SetTextColor(0,0,0);
	}

	$pdf->Output("../recursos/certificados/evento_".$id.".pdf", 'I');
?>
