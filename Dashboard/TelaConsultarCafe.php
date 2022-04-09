<?php include ("../views/header.php");?>
        <h4>Pesquisa de Satisfação - Consultar Café</h4>
        <form method="post" action="api/model/CafeDAO.php">
            <div class="data">
                <p>Selecione a data do cardápio que deseja consultar:</p>
                <input type="date" name="data" id="data" required/>
            </div>
            <br> 
            <?php include("api/controller/exibeModal.php");?>
            <br> 
            <div class="buttons">
                <a class="btn-medium" id="cadastrar" href="MenuPrincipal.php">Voltar</a>
                <input  class="btn-medium"name="pesquisar" id="consultar" type="submit" value="Pesquisar">
            </div> 	
        </form>
<?php include("../views/footer.php")	?>