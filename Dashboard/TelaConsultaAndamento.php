<?php include ("../views/header.php");?>
        <h4>Pesquisa de Satisfação - Consultar Andamento da Votação</h4>
        <form method="post" action="TelaAndamentoVotacao.php">
            <div class="data">
                <p>Selecione a data da votação que deseja consultar:</p>
                <input type="date" name="data" id="data" required/>
            </div>
            <div class="voto">
            <p>Selecione o tipo de Votação que deseja consultar: </p>
              <input type="radio" name="tipo" value="Café" required>Café
              <input type="radio" name="tipo" value="Almoço" required>Almoço
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