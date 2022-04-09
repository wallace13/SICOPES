<?php include ("../views/header.php") ?>
<?php include('api/controller/verifica_login.php') ?>
		<h3>Pesquisa de Satisfação</h3>
		<h4>Olá, <?php 
        echo $_SESSION['nomeFuncionarioLogado'];?> - O que você deseja?</h4>
        <div class="buttons">
            <a class="btn-medium" id="cadastrar" href="TelaDeCadastrarFuncionario.php">Cadastrar Funcionário</a>
            <a class="btn-medium" id="cadastrar" href="TelaDeConsultarFuncionario.php">Ver Funcionários</a>
            <a class="btn-medium" id="cadastrar" href="TelaAlterarSenha.php">Alterar Senha</a>
        </div> 	
        <br><?php include("api/controller/exibeModal.php");?>  
        </section>
<footer class = "rodape">
    <a class="btn-x-small" href="api/controller/logout.php">Logout</a>
    <a class="btn-x-small" href="MenuPrincipal.php">Voltar</a>
</footer>

<?php include("../views/footer.php")?>