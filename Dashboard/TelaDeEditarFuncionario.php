<?php
include("api/controller/conexao.php");
$idBusca = filter_input(INPUT_GET, 'idfuncionario', FILTER_SANITIZE_NUMBER_INT);
$sql = "select * from funcionario where idfuncionario='$idBusca'";
$stmt =	$conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<?php include ("../views/header.php") ?>
		<h4>Pesquisa de Satisfação - Editar Funcionário</h4>
        <form method="post" action="api/model/FuncionarioDAO.php">
			<input type="hidden" name="idfuncionario" value="<?php echo $result['idfuncionario']; ?>"/>
            <div class="orderLabel">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="text" value="<?php echo $result['nome'];  ?>" required/>
            </div>
            <div class="orderLabel">
                <label for="usuario">Usuário:</label>
                <input type="text" name="usuario" id="text" value="<?php echo $result['usuario'];?>" required/>
            </div> 	
            <div class="orderLabel" >
                <label for="nivelPermissao">Cargo:</label>
                <select name="nivelPermissao" style='width: 455px; ' required>
                    <?php 
                        $nivel = $result['nivelPermissao'];
                        if ($nivel == 0) {
                            echo "  <option value='Gerente'>Gerente</option>
                                    <option value='Funcionario'>Funcionário</option>";
                        } else {
                            echo "  <option value='Funcionario'>Funcionário</option>
                                    <option value='Gerente'>Gerente</option>>";
                        }
                    ?>
                    
                </select>   
            </div> 	
            <br><br>  
            <div class="buttons">
                <a class="btn-medium" id="editar" href="TelaDaGerencia.php">Cancelar</a>
                <button class="btn-medium" name="editar" id="cadastrar">Confirmar</button>
            </div> 	
        </form>
       
<?php include("../views/footer.php")	?>