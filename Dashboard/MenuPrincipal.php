<?php include ("../views/header.php") ?>
<?php include('api/controller/verifica_login.php')?>
		<h3>Pesquisa de Satisfação</h3>
		<h4>Olá, <?php echo $_SESSION['nomeFuncionarioLogado'];?> - O que você deseja?</h4>
        <div class="buttons">
            <a class="btn-medium" id="cadastrar" href="TelaDeCadastrarCafe.php">Cadastrar Café</a>
            <a class="btn-medium" id="cadastrar" href="TelaConsultarCafe.php">Consultar Café</a>
            <a class="btn-medium" id="cadastrar" href="MenuDeBalancos.php">Consultar Balanços</a>	
        </div> 	
        <br>
        <div class="buttons">
            <a class="btn-medium" id="cadastrar" href="TelaDeCadastrarAlmoco.php">Cadastrar Almoço</a>
            <a class="btn-medium" id="cadastrar" href="TelaConsultarAlmoco.php">Consultar Almoço</a>	
            <a class="btn-medium" id="cadastrar" href="TelaConsultaRelatorio.php">Consultar Relatórios</a>		
        </div> 	
        <br>
        <div class="buttons">
            <a class="btn-large" id="cadastrar" href="TelaConsultaAndamento.php">Ver Andamento da Votação</a>
        </div> 	
        <?php include("api/controller/exibeModal.php");?>        
        </section>
<footer class = "rodape">
    <a class="btn-x-small" href="api/controller/logout.php">Logout</a>
    <?php if($_SESSION['nivelPermissaoLogado'] == 0){ ?>
        <a class="btn-x-small" href="TelaDaGerencia.php">Gerência</a>
    <?php }else{ ?>
        <a class="btn-x-small" href="TelaAlterarSenha.php">Alterar Senha</a>
    <?php } ?>
</footer>

<?php include("../views/footer.php")?>