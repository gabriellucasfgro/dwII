<?php

	include_once '../global.php';
	include_once '../recursos/fpdf/fpdf.php';

	// Instancia o objeto
	$pdf = new FPDF("P", "mm", "A4");
	// Abre o documento
	$pdf->Open();

	$alunos_id = modeloEventoAluno::getAlunos($_GET['id']);

	while($vinculo = $alunos_id->fetchObject()) {

		$aluno = modeloAluno::findAluno($vinculo->id_aluno);

		// Adiciona uma página
		$pdf->AddPage();
		// Adiciona uma imagem na posição e tamanho especificados
		$pdf->Image('../recursos/img/topo_certificado.jpeg', 0, 0, 200, 20);
		// Define a espessura e desenha duas linha
		$pdf->SetLineWidth(0.4);
		$pdf->Line(5, 28, 204, 28);
		// Define a fonte do texto, a posição 'x' e 'y' da célula que será escrita
		$pdf->SetFont("Arial","B", 34);
		$pdf->SetY(10); $pdf->SetX(10);
		// Adiciona a célula/texto ao documento - alinhamento centralizado
		$pdf->Cell(188, 75, "Certificado", 0, 0, 'C');
		// Define a fonte do texto, a posição 'x' e 'y' da célula que será escrita
		$pdf->SetFont("Arial","B", 12);
		$pdf->SetY(90); $pdf->SetX(10);
		// Define o texto da célula - utilliza função iconv() para obter corretmente os acentos do texto
		$texto = iconv("utf-8", "iso-8859-1", $_GET['nome']);
		// Adiciona a célula/texto ao documento - alinhamento centralizado
		$pdf->Cell(188, 0, $texto, 0, 0, 'C');
		// Define fonte / Insere um texto de maneira direta, sem utilizar célula
		$pdf->SetFont("Arial","B", 12);
		$pdf->Text(52, 120, iconv("utf-8","iso-8859-1", $aluno->nome));
		$pdf->Text(52, 140, iconv("utf-8","iso-8859-1", $aluno->curso));
		$pdf->Text(52, 160, iconv("utf-8","iso-8859-1", $aluno->turma));

	}

	$pdf->Output("../recursos/certificados/evento_".$id.".pdf", 'I');
?>
