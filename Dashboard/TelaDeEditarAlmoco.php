<?php
include("api/controller/conexao.php");
$idBusca = $_SESSION['idAlmoco'];
$sql = "select * from almoco where idAlmoco='$idBusca'";
$stmt =	$conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<?php include ("../views/header.php") ?>
		<h4>Pesquisa de Satisfação - Editar Almoço</h4>
        <form method="post" action="api/model/AlmocoDAO.php">
			<input type="hidden" name="Almoco" value="<?php echo $result['idAlmoco']; ?>"/>
            <div class="orderLabel">
                <label for="data">Data:</label>
                <input type="date" name="data" id="data" value="<?php echo $result['Data'];  ?>" required/>
            </div>
            <div class="orderLabel">
                <label for="salada">Salada:</label>
                <input type="text" name="salada" id="text" value="<?php echo $result['salada']; ?>" required/>
            </div> 	
            <div class="orderLabel">
                <label for="acompanhamento">Complemento:</label>
                <input type="text" name="complemento" id="text" value="<?php echo $result['complemento']; ?>" required/>
            </div> 	
            <div class="orderLabel">
                <label for="principal">Principal:</label>
                <input type="text" name="principal" id="text" value="<?php echo $result['principal'];?>" required/>
            </div> 	
            <div class="orderLabel">
                <label for="sobremessa">Sobremesa:</label>
                <input type="text" name="sobremesa" id="text" value="<?php echo $result['sobremesa']; ?>" required/>
            </div> 	
            <div class="orderLabel">  
                <label for="suco">Suco:</label>
                <input type="text"  name="suco" id="text" value="<?php echo $result['suco'];?>" required/>
            </div> 
            <br><br>  
            <div class="buttons">
                <a class="btn-medium" id="editar" href="MenuPrincipal.php">Cancelar</a>
                <button class="btn-medium" name="editar" id="cadastrar">Confirmar</button>
            </div> 	
        </form>
       
<?php include("../views/footer.php")	?>