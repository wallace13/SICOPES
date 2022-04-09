<?php
//Usado para o Balanço Mensal e o Balanço Comparativo Mês 1
if($_SESSION['Balanco'] == 1 or $_SESSION['Balanco'] == 2){
    if ($_POST['mes']) {
        $mes = $_POST['mes'];
        $ano = $_POST['ano'];

        $sql = "select sum(votacaocafe.otimo),sum(votacaocafe.bom),sum(votacaocafe.regular),sum(votacaocafe.ruim) from cafe, votacaocafe where cafe.idcafe=votacaocafe.idcafe and month(data)='$mes' and year(data) = '$ano'";    
        $stmt =	$conn->prepare($sql);
        $stmt->execute();
        $resultCafe = $stmt->fetch(PDO::FETCH_ASSOC);  

        if($resultCafe){
            $resultCafe['sum(votacaocafe.otimo)'];
            $resultCafe['sum(votacaocafe.bom)'];
            $resultCafe['sum(votacaocafe.regular)'];
            $resultCafe['sum(votacaocafe.ruim)'];
        }

        $sql = "select sum(votacaoalmoco.otimo),sum(votacaoalmoco.bom),sum(votacaoalmoco.regular),sum(votacaoalmoco.ruim) from almoco, votacaoalmoco where almoco.idalmoco=votacaoalmoco.idalmoco and month(data)='$mes' and year(data) = '$ano'";
        $stmt =	$conn->prepare($sql);
        $stmt->execute();
        $resultAlmoco = $stmt->fetch(PDO::FETCH_ASSOC);
            
        if($resultAlmoco){
            $resultAlmoco['sum(votacaoalmoco.otimo)'];
            $resultAlmoco['sum(votacaoalmoco.bom)'];
            $resultAlmoco['sum(votacaoalmoco.regular)'];
            $resultAlmoco['sum(votacaoalmoco.ruim)'];
        }

        if ($_POST['tipo'] == "Café") {  
            $otimo =  $resultCafe['sum(votacaocafe.otimo)'];
            $bom = $resultCafe['sum(votacaocafe.bom)'];
            $regular = $resultCafe['sum(votacaocafe.regular)'];
            $ruim =  $resultCafe['sum(votacaocafe.ruim)'];

            $total = ($otimo+$bom+$ruim+$regular);

        }else if ($_POST['tipo'] == "Almoço"){
            $otimo = $resultAlmoco['sum(votacaoalmoco.otimo)'];
            $bom = $resultAlmoco['sum(votacaoalmoco.bom)'];
            $regular = $resultAlmoco['sum(votacaoalmoco.regular)'];
            $ruim =  $resultAlmoco['sum(votacaoalmoco.ruim)'];

            $total = ($otimo+$bom+$ruim+$regular);
        }else if ($_POST['tipo'] == "Global"){
            $otimo =  $resultCafe['sum(votacaocafe.otimo)']+$resultAlmoco['sum(votacaoalmoco.otimo)'];
            $bom = $resultCafe['sum(votacaocafe.bom)']+$resultAlmoco['sum(votacaoalmoco.bom)'];
            $regular = $resultCafe['sum(votacaocafe.regular)']+$resultAlmoco['sum(votacaoalmoco.regular)'];
            $ruim =  $resultCafe['sum(votacaocafe.ruim)']+$resultAlmoco['sum(votacaoalmoco.ruim)'];

            $total = ($otimo+$bom+$ruim+$regular);
        }
    }
}
//Mês 2 do Grafico Comparativo
if($_SESSION['Balanco'] == 2){

    if ($_POST['mes2']) {
        $mes2 = $_POST['mes2'];
        $ano = $_POST['ano'];
        
        $sql = "select sum(votacaocafe.otimo),sum(votacaocafe.bom),sum(votacaocafe.regular),sum(votacaocafe.ruim) from cafe, votacaocafe where cafe.idcafe=votacaocafe.idcafe and month(data)='$mes2' and year(data) = '$ano'";    
        $stmt =	$conn->prepare($sql);
        $stmt->execute();
        $resultCafe = $stmt->fetch(PDO::FETCH_ASSOC);  

        if($resultCafe){
            $resultCafe['sum(votacaocafe.otimo)'];
            $resultCafe['sum(votacaocafe.bom)'];
            $resultCafe['sum(votacaocafe.regular)'];
            $resultCafe['sum(votacaocafe.ruim)'];
        }

        $sql = "select sum(votacaoalmoco.otimo),sum(votacaoalmoco.bom),sum(votacaoalmoco.regular),sum(votacaoalmoco.ruim) from almoco, votacaoalmoco where almoco.idalmoco=votacaoalmoco.idalmoco and month(data)='$mes2' and year(data) = '$ano'";
        $stmt =	$conn->prepare($sql);
        $stmt->execute();
        $resultAlmoco = $stmt->fetch(PDO::FETCH_ASSOC);
            
        if($resultAlmoco){
            $resultAlmoco['sum(votacaoalmoco.otimo)'];
            $resultAlmoco['sum(votacaoalmoco.bom)'];
            $resultAlmoco['sum(votacaoalmoco.regular)'];
            $resultAlmoco['sum(votacaoalmoco.ruim)'];
        }

        if ($_POST['tipo'] == "Café") {  
            $otimo2 =  $resultCafe['sum(votacaocafe.otimo)'];
            $bom2 = $resultCafe['sum(votacaocafe.bom)'];
            $regular2 = $resultCafe['sum(votacaocafe.regular)'];
            $ruim2 =  $resultCafe['sum(votacaocafe.ruim)'];

            $total2 = ($otimo2+$bom2+$regular2+$ruim2);

        }else if ($_POST['tipo'] == "Almoço"){
            $otimo2 = $resultAlmoco['sum(votacaoalmoco.otimo)'];
            $bom2 = $resultAlmoco['sum(votacaoalmoco.bom)'];
            $regular2 = $resultAlmoco['sum(votacaoalmoco.regular)'];
            $ruim2 =  $resultAlmoco['sum(votacaoalmoco.ruim)'];

            $total2 = ($otimo2+$bom2+$regular2+$ruim2);

        }else if ($_POST['tipo'] == "Global"){
            $otimo2 =  $resultCafe['sum(votacaocafe.otimo)']+$resultAlmoco['sum(votacaoalmoco.otimo)'];
            $bom2 = $resultCafe['sum(votacaocafe.bom)']+$resultAlmoco['sum(votacaoalmoco.bom)'];
            $regular2 = $resultCafe['sum(votacaocafe.regular)']+$resultAlmoco['sum(votacaoalmoco.regular)'];
            $ruim2 =  $resultCafe['sum(votacaocafe.ruim)']+$resultAlmoco['sum(votacaoalmoco.ruim)'];

            $total2 = ($otimo2+$bom2+$regular2+$ruim2);
        }
    }
}
//Usado para o Balanço Anual
if($_SESSION['Balanco'] == 3){
    if ($_POST['ano']) {
        $ano = $_POST['ano'];

        $sql = "select sum(votacaocafe.otimo),sum(votacaocafe.bom),sum(votacaocafe.regular),sum(votacaocafe.ruim) from cafe, votacaocafe where cafe.idcafe=votacaocafe.idcafe and year(data) = '$ano'";    
        $stmt =	$conn->prepare($sql);
        $stmt->execute();
        $resultCafe = $stmt->fetch(PDO::FETCH_ASSOC);  

        if($resultCafe){
            $resultCafe['sum(votacaocafe.otimo)'];
            $resultCafe['sum(votacaocafe.bom)'];
            $resultCafe['sum(votacaocafe.regular)'];
            $resultCafe['sum(votacaocafe.ruim)'];
        }

        $sql = "select sum(votacaoalmoco.otimo),sum(votacaoalmoco.bom),sum(votacaoalmoco.regular),sum(votacaoalmoco.ruim) from almoco, votacaoalmoco where almoco.idalmoco=votacaoalmoco.idalmoco and year(data) = '$ano'";
        $stmt =	$conn->prepare($sql);
        $stmt->execute();
        $resultAlmoco = $stmt->fetch(PDO::FETCH_ASSOC);
            
        if($resultAlmoco){
            $resultAlmoco['sum(votacaoalmoco.otimo)'];
            $resultAlmoco['sum(votacaoalmoco.bom)'];
            $resultAlmoco['sum(votacaoalmoco.regular)'];
            $resultAlmoco['sum(votacaoalmoco.ruim)'];
        }

        if ($_POST['tipo'] == "Café") {  
            $otimo =  $resultCafe['sum(votacaocafe.otimo)'];
            $bom = $resultCafe['sum(votacaocafe.bom)'];
            $regular = $resultCafe['sum(votacaocafe.regular)'];
            $ruim =  $resultCafe['sum(votacaocafe.ruim)'];

            $total = ($otimo+$bom+$ruim+$regular);

        }else if ($_POST['tipo'] == "Almoço"){
            $otimo = $resultAlmoco['sum(votacaoalmoco.otimo)'];
            $bom = $resultAlmoco['sum(votacaoalmoco.bom)'];
            $regular = $resultAlmoco['sum(votacaoalmoco.regular)'];
            $ruim =  $resultAlmoco['sum(votacaoalmoco.ruim)'];

            $total = ($otimo+$bom+$ruim+$regular);
        }else if ($_POST['tipo'] == "Global"){
            $otimo =  $resultCafe['sum(votacaocafe.otimo)']+$resultAlmoco['sum(votacaoalmoco.otimo)'];
            $bom = $resultCafe['sum(votacaocafe.bom)']+$resultAlmoco['sum(votacaoalmoco.bom)'];
            $regular = $resultCafe['sum(votacaocafe.regular)']+$resultAlmoco['sum(votacaoalmoco.regular)'];
            $ruim =  $resultCafe['sum(votacaocafe.ruim)']+$resultAlmoco['sum(votacaoalmoco.ruim)'];

            $total = ($otimo+$bom+$ruim+$regular);
        }
    }
}