
<?php include ("../views/header.php");?>
    <h4>Pesquisa de Satisfação - Café</h4>
	<div class="orderLabel">
        <?php $_SESSION['idCafe'];?>
    </div> 	
    <div class="orderLabel">
        <label>Data:</label>
        <?php echo $_SESSION['Data'];?>
    </div> 	
    <div class="orderLabel">
        <label for="principal">Principal:</label>
        <?php echo $_SESSION['principal'];?>
    </div> 	
    <div class="orderLabel">
        <label for="opcao">Opcões:</label>
        <?php echo $_SESSION['opcao'];?>
    </div> 	
    <div class="orderLabel">  
        <label for="suco">Cardápio cadastrado por:</label>
        <?php echo $_SESSION['cadastradoPor'];?>
    </div> 
    <br><br>  
    <div class="buttons">
        <a class="btn-medium" id="cadastrar" href="TelaConsultarCafe.php">Voltar</a>
        <a class="btn-medium" id="editar" href="TelaDeEditarCafe.php">Editar</a>
    </div> 	

<?php include("../views/footer.php")	?>