<?php

	include_once 'fpdf/fpdf.php';

	$pdf = new FPDF("P", "mm", "A4");
	$pdf->Open();
	$pdf->AddPage();



	// $evento_alunos = modeloEventoAluno::findEventoAluno($id_evento);
	// $data = formataData(modeloCertificado::getDataHora("DATA"));
	// $hora = modeloCertificado::getDataHora("HORA");

	//while($objEventoAlunos = $evento_alunos->fetchObject()) {
		// $pdf->AddPage();
	// }

	$pdf->Output("certificados/x.pdf", 'I');

	echo "OK";
?>
