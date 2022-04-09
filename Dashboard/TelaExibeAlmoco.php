
<?php include ("../views/header.php");?>
        <h4>Pesquisa de Satisfação - Almoço</h4>
		<div class="orderLabel">
            <?php $_SESSION['idAlmoco'];?>
        </div> 	
        <div class="orderLabel">
            <label>Data:</label>
            <?php echo $_SESSION['Data'];?>
        </div> 	
        <div class="orderLabel">
            <label for="salada">Salada:</label>
            <?php echo $_SESSION['salada'];?>
        </div> 	
        <div class="orderLabel">
            <label for="acompanhamento">Complemento:</label>
            <?php echo $_SESSION['complemento'];?>
        </div> 	
        <div class="orderLabel">
            <label for="principal">Principal:</label>
            <?php echo $_SESSION['principal'];?>
        </div> 	
        <div class="orderLabel">
            <label for="sobremessa">Sobremesa:</label>
            <?php echo $_SESSION['sobremesa'];?>
        </div> 	
        <div class="orderLabel">  
            <label for="suco">Suco:</label>
            <?php echo $_SESSION['suco'];?>
        </div> 
        <div class="orderLabel">  
            <label for="suco">Cardápio cadastrado por:</label>
            <?php echo $_SESSION['cadastradoPor'];?>
        </div> 
        <br><br>  
        <div class="buttons">
            <a class="btn-medium" id="cadastrar" href="TelaConsultarAlmoco.php">Voltar</a>
            <a class="btn-medium" id="editar" href="TelaDeEditarAlmoco.php">Editar</a>
        </div> 	

<?php include("../views/footer.php")	?>