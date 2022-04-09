<?php
session_start();
include("../controller/conexao.php");
$idCafe = $_SESSION['Cafe'];
$sql = "select * from votacaocafe where idCafe='$idCafe'";
    $stmt =	$conn->prepare($sql);
    $stmt->execute();
    $resultBusca = $stmt->fetch(PDO::FETCH_ASSOC);

    if(!empty($resultBusca)){
        $votosotimos = $resultBusca['otimo'];
        $votosBons = $resultBusca['bom'];
        $votosRegulares = $resultBusca['regular'];
        $votosRuins = $resultBusca['ruim'];
    
if(isset($_POST['otimo'])){
    
    $otimo = $votosotimos + 1;
    $sql = "update  votacaocafe set otimo='$otimo' where idCafe='$idCafe'";
	$stmt = $conn->prepare($sql);
	$stmt->execute();

    $result = $stmt->rowCount();
}
if(isset($_POST['bom'])){
    $bom = $votosBons + 1;
    $sql = "update  votacaocafe set bom='$bom' where idCafe='$idCafe'";
	$stmt = $conn->prepare($sql);
	$stmt->execute();

    $result = $stmt->rowCount();
}
if(isset($_POST['regular'])){
    $regular = $votosRegulares + 1;
    $sql = "update  votacaocafe set regular='$regular' where idCafe='$idCafe'";
	$stmt = $conn->prepare($sql);
	$stmt->execute();

    $result = $stmt->rowCount();
}
if(isset($_POST['ruim'])){
    $ruim = $votosRuins + 1;
    $sql = "update  votacaocafe set ruim='$ruim' where idCafe='$idCafe'";
	$stmt = $conn->prepare($sql);
	$stmt->execute();

    $result = $stmt->rowCount();
}
if($result > 0){
    $_SESSION['msg'] = "  
    <p class='avisoModal'>Voto computado com sucesso. Redirecionando</p>
    <img class='loading' src = '../public/img/loading.gif' alt = 'projeto'>
    <?php include('api/controller/exibeModal.php');?>
    <META HTTP-EQUIV='REFRESH' CONTENT='3; URL= .././index.php'>
    ";
    header("Location: ../../votacaoCafe.php#abrirModal");
    exit();
}
}else{
    $_SESSION['msg'] = "<p class='avisoModal'>Voto não computado com sucesso</p>";
    header("Location: ../../votacaoCafe.php#abrirModal");
}
