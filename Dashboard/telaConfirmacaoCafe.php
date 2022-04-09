<?php  include ("../views/header.php"); include("api/controller/conexao.php"); 
$idCafe = $_SESSION['idCafe'];
$sql = "select * from cafe where idCafe='$idCafe'";
$stmt =	$conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
?>
    <h4>Pesquisa de Satisfação - Café</h4>
    <p>Confira os Dados:</p>
    <div class="orderLabel">
            <?php $result['idCafe'];?>
        </div> 
    <div class="orderLabel">
        <label>Data:</label>
        <?php echo $result['Data'];?>
    </div> 	
    <div class="orderLabel">
        <label for="principal">Principal:</label>
        <?php echo $result['principal'];?>
    </div> 	
    <div class="orderLabel">
        <label for="opcao">Opcões:</label>
        <?php echo $result['opcao'];?>
    </div> 	
    <br>
    <?php include("api/controller/exibeModal.php");?>
    <br>  
    <div class="buttons">
        <a class="btn-medium" name="editar" id="editar" href="TelaDeEditarCafe.php">Editar</a>
        <a class="btn-medium" id="cadastrar" href="MenuPrincipal.php">Confirmar</a>
    </div> 	

<?php include("../views/footer.php")?>
