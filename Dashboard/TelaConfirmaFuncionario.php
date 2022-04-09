<?php include ("../views/header.php");?>
        <h4>Pesquisa de Satisfação - Funcionário</h4>
        <p>Confira os Dados:</p>
		<div class="orderLabel">
            <?php $idfuncionario = $_SESSION['idFuncionario'];?>
        </div> 	
        <div class="orderLabel">
            <label>Nome:</label>
            <?php echo $_SESSION['nome'];?>
        </div> 	
        <div class="orderLabel">
            <label>Usuário:</label>
            <?php echo $_SESSION['usuario'];?>
        </div> 	
        <div class="orderLabel">
            <label>Senha:</label>
            <?php echo $_SESSION['senha'];?>
        </div> 	
        <div class="orderLabel">
            <label>Nível de Permissão:</label>
            <?php 
            $nivel = $_SESSION['nivelPermissao'];
            if ($nivel == 0) {
                echo "  Gerente";
            } else {
                echo "Funcionário";
            }
            ?>
        </div> 	
        <br>
        <?php include("api/controller/exibeModal.php");?>
        <br>  
        <div class="buttons">
        <a class="btn-medium" name="editar" id="editar" href='TelaDeEditarFuncionario.php?idfuncionario="<?php echo $idfuncionario?>"'>Editar</a>
        <a class="btn-medium" id="cadastrar" href="TelaDaGerencia.php">Confirmar</a>
        </div> 	

<?php include("../views/footer.php")	?>

