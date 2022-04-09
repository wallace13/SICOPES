<?php
include("api/controller/conexao.php");
$idBusca = $_SESSION['idCafe'];
$sql = "select * from cafe where idCafe='$idBusca'";
$stmt =	$conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<?php include ("../views/header.php") ?>
		<h4>Pesquisa de Satisfação - Editar Café</h4>
        <form method="post" action="api/model/CafeDAO.php">
			<input type="hidden" name="cafe" value="<?php echo $result['idCafe']; ?>"/>
            <div class="orderLabel">
                <label for="data">Data:</label>
                <input type="date" name="data" id="data" value="<?php echo $result['Data'];  ?>" required/>
            </div>
            <div class="orderLabel">
                <label for="principal">Principal:</label>
                <input type="text" name="principal" id="text" value="<?php echo $result['principal'];?>" required/>
            </div> 	
            <div class="orderLabel">
                <label for="opcao">Opções:</label>
                <input type="text" name="opcao" id="text" value="<?php echo $result['opcao']; ?>" required/>
            </div> 	
            <br><br>  
            <div class="buttons">
                <a class="btn-medium" id="editar" href="MenuPrincipal.php">Cancelar</a>
                <button class="btn-medium" name="editar" id="cadastrar">Confirmar</button>
            </div> 	
        </form>
       
<?php include("../views/footer.php")	?>