<?php
session_start();
include("../controller/conexao.php");
$idAlmoco = $_SESSION['Almoco'];
$sql = "select * from votacaoalmoco where idAlmoco='$idAlmoco'";
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
    $sql = "update  votacaoAlmoco set otimo='$otimo' where idAlmoco='$idAlmoco'";
	$stmt = $conn->prepare($sql);
	$stmt->execute();

    $result = $stmt->rowCount();
}
if(isset($_POST['bom'])){
    $bom = $votosBons + 1;
    $sql = "update  votacaoAlmoco set bom='$bom' where idAlmoco='$idAlmoco'";
	$stmt = $conn->prepare($sql);
	$stmt->execute();

    $result = $stmt->rowCount();
}
if(isset($_POST['regular'])){
    $regular = $votosRegulares + 1;
    $sql = "update  votacaoAlmoco set regular='$regular' where idAlmoco='$idAlmoco'";
	$stmt = $conn->prepare($sql);
	$stmt->execute();

    $result = $stmt->rowCount();
}
if(isset($_POST['ruim'])){
    $ruim = $votosRuins + 1;
    $sql = "update  votacaoAlmoco set ruim='$ruim' where idAlmoco='$idAlmoco'";
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
    header("Location: ../../votacaoAlmoco.php#abrirModal");
    exit();
}
}else{
    $_SESSION['msg'] = "<p class='avisoModal'>Voto não computado com sucesso</p>";
    header("Location: ../../votacaoAlmoco.php#abrirModal");
}
