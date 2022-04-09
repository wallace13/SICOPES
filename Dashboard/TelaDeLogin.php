<?php include ("../views/header.php") ?>
		
		<h3>Pesquisa de Satisfação</h3>
		<h4>Login</h4>
		<form method="post" action="api/model/user.php">
			<input name="usuario" class="inputText" type="text" placeholder="Usuário" required>
			<br><br>
			<input name="senha" class="inputText" type="password" id="senha" placeholder="Senha" required>
			<br>
			<input type="checkbox" onclick="exibirSenha()">Mostrar senha
			<br> 
            <?php include("api/controller/exibeModal.php");?>
            <br> 
			<button name='logar' class="buttonEnviar" >Entrar</button>	  
		</form> 
		</section>
    <footer class = "rodape">
        <a class="btn-x-small" href="../index.php">Voltar</a>
    </footer>
<?php include("../views/footer.php")	?>
