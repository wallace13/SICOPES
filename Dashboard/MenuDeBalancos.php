<?php include ("../views/header.php") ?>
<?php include('api/controller/verifica_login.php')?>
		<h3>Pesquisa de Satisfação</h3>
        <h4>O que você deseja?</h4>
        <div class="buttons">
            <a class="btn-medium" id="cadastrar" href="TelaConsultaBalanco.php">Balanço Mensal</a>
            <a class="btn-medium" id="cadastrar" href="TelaConsultaBalancoComparativo.php">Balanço Comparativo</a>
            <a class="btn-medium" id="cadastrar" href="TelaConsultaBalancoAnual.php">Balanço Anual</a>	
        </div> 	
        <br>
        <?php include("api/controller/exibeModal.php");?>        
        </section>
    <footer class = "rodape">
        <a class="btn-x-small" href="MenuPrincipal.php">Voltar</a>
    </footer>

<?php include("../views/footer.php")?>