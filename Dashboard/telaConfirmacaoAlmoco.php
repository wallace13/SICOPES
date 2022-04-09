<?php include ("../views/header.php"); include("api/controller/conexao.php"); 
$idAlmoco = $_SESSION['idAlmoco'];
$sql = "select * from almoco where idAlmoco='$idAlmoco'";
$stmt =	$conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
?>
        <h4>Pesquisa de Satisfação - Almoço</h4>
        <p>Confira os Dados:</p>
		<div class="orderLabel">
            <?php $result['idAlmoco'];?>
        </div> 	
        <div class="orderLabel">
            <label>Data:</label>
            <?php echo $result['Data'];?>
        </div> 	
        <div class="orderLabel">
            <label for="salada">Salada:</label>
            <?php echo $result['salada'];?>
        </div> 	
        <div class="orderLabel">
            <label for="acompanhamento">Complemento:</label>
            <?php echo $result['complemento'];?>
        </div> 	
        <div class="orderLabel">
            <label for="principal">Principal:</label>
            <?php echo $result['principal'];?>
        </div> 	
        <div class="orderLabel">
            <label for="sobremessa">Sobremesa:</label>
            <?php echo $result['sobremesa'];?>
        </div> 	
        <div class="orderLabel">  
            <label for="suco">Suco:</label>
            <?php echo $result['suco'];?>
        </div> 
        <br>
        <?php include("api/controller/exibeModal.php");?>
        <br>  
        <div class="buttons">
        <a class="btn-medium" name="editar" id="editar" href="TelaDeEditarAlmoco.php">Editar</a>
        <a class="btn-medium" id="cadastrar" href="MenuPrincipal.php">Confirmar</a>
        </div> 	

<?php include("../views/footer.php")	?>

