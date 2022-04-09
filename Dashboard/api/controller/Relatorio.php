<?php	

	//referenciar o DomPDF com namespace
	use Dompdf\Dompdf;

	// include autoloader
	require_once("../public/dompdf/autoload.inc.php");

	//Criando a Instancia
	$dompdf = new DOMPDF();

	// Carrega seu HTML
	$dompdf->load_html('');
    ob_start();
    require "Relatoriopdf.php";
    $dompdf->load_html($pdf = ob_get_clean());

	//Renderizar o html
    //$dompdf->setPaper('A4', 'landscape'); //paisagem
	$dompdf->setPaper('A4', 'portrait'); //Retrato
	$dompdf->render();

	//Exibibir a página
	$dompdf->stream(
		"Relatorio.pdf", 
		array(
			"Attachment" => true //Para não realizar o download somente alterar para false
		)
	);
?>