<?php
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
//Usado Para o Balanço Mensal
if($_SESSION['Balanco'] == 1){

$mes = $_POST['mes'];
$dateObj   = DateTime::createFromFormat('m', $mes);
$monthName = $dateObj->format('F');
$_SESSION['mes'] = ucwords(strftime('%B', strtotime($monthName)));

//Usado Para o Balanço Comparativo
}else if($_SESSION['Balanco'] == 2){

$mes = $_POST['mes'];
$dateObj   = DateTime::createFromFormat('m', $mes);
$monthName = $dateObj->format('F');
$_SESSION['mes'] = ucwords(strftime('%B', strtotime($monthName)));

$mes2 = $_POST['mes2'];
$dateObj   = DateTime::createFromFormat('m', $mes2);
$monthName = $dateObj->format('F');
$_SESSION['mes2'] = ucwords(strftime('%B', strtotime($monthName)));
}
?>