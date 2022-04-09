<?php
include("api/controller/conexao.php");
$idBusca = filter_input(INPUT_GET, 'idfuncionario', FILTER_SANITIZE_NUMBER_INT);
$sql = "select * from funcionario where idfuncionario='$idBusca'";
$stmt =	$conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<?php include ("../views/header.php") ?>
		<h4>Pesquisa de Satisfação</h4>
        <p>Tem certeza que deseja excluir o funcionario listado abaixo?
        <form method="post" action="api/model/FuncionarioDAO.php">
			<input type="hidden" name="idfuncionario" value="<?php echo $result['idfuncionario']; ?>"/>
            <div class="orderLabel">
                <label>Nome:</label>
                <?php echo $result['nome'];?>
            </div> 	
            <div class="orderLabel">
                <label>Usuário:</label>
                <?php echo $result['usuario'];?>
            </div> 	
            <div class="orderLabel">
                <label>Senha:</label>
                <?php echo "*********";?>
            </div> 	
            <div class="orderLabel">
                <label>Nível de Permissão:</label>
                <?php 
                $nivel = $result['nivelPermissao'];
                if ($nivel == 0) {
                    echo "  Gerente";
                } else {
                    echo "Funcionário";
                }
                ?>
            </div>             
            <br><br>  
            <div class="buttons">
                <a class="btn-medium" id="editar" href="javascript:history.back();">Cancelar</a>
                <button class="btn-medium" name="excluir" id="cadastrar">Confirmar</button>
            </div> 	
        </form>
       
<?php include("../views/footer.php")	?>