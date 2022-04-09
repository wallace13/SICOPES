<?php include ("../views/header.php") ?>
		<h4>Pesquisa de Satisfação - Cadastrar Café</h4>
    <form method="post" action="api/model/CafeDAO.php">
        <div class="data">
            <label for="data">Data:</label>
            <input type="date" name="data" id="data" required/>
        </div>
        <div class="orderLabel">
            <label for="principal">Principal:</label>
			<input type="text" name="principal" id="text" required/>
        </div> 	
        <div class="orderLabel">
            <label for="opcao">Opção:</label>
			<input type="text" name="opcao" id="text" required/>
        </div> 	
        <br><br>
        <div class="buttons">
            <a class="btn-medium" id="editar" href="MenuPrincipal.php">Cancelar</a>
            <button class="btn-medium" name="enviar" id="cadastrar">Cadastrar</button>
        </div> 	
    </form>
<?php include("../views/footer.php")	?>
