<?php include("api/controller/conexao.php"); include ("../views/header.php");?>
<h4>Pesquisa de Satisfação - Lista de Usuários Cadastrados</h4>
<div class="tabela-funcionario">
    <table border="1" cellpadding="5" width="700">
        <thead>
            <tr>
                <th width="50" >#</th>
                <th width="150">Nome</th>
                <th width="150">Nome de Usuario</th>
                <th width="100">Cargo</th>
                <th colspan="2" width="200">Ações</th>
            </tr>
        </thead>
        <?php
            $sql = "select * from funcionario";
            $stmt =	$conn->prepare($sql);
            $stmt->execute();
            while($result = $stmt->fetch(PDO::FETCH_ASSOC)){ 
        ?>
        <tbody>
            <tr>
                <td align="center"><?php echo $result['idfuncionario']; ?></td>
                <td><?php echo $result['nome']; ?></td>
                <td><?php echo $result['usuario']; ?></td>
                <td>
                    <?php 
                    $nivel = $result['nivelPermissao']; 
                    if ($nivel == 0) {
                        echo "  Gerente";
                    } else {
                        echo "Funcionário";
                    }
                    ?>
                </td>
                <td align="center" width="100">
                    <a class="btn-small" id="editar" href='TelaDeEditarFuncionario.php?idfuncionario="<?php echo $result['idfuncionario']?>"'>Editar</a>
                </td>
                <td align="center" width="100">
                    <a class="btn-small" id="editar" href='TelaDeConfirmacao.php?idfuncionario="<?php echo $result['idfuncionario']?>"'>Excluir</a>
                </td>
            </tr>
        </tbody>
        <?php } ?>
    </table>
</div>
    <br><?php include("api/controller/exibeModal.php");?>
    <br>
    <div class="orderLabel">
        <div class="buttons">
            <a class="btn-medium" id="cadastrar" href="TelaDaGerencia.php">Voltar</a>
        </div> 	
    </div>
<?php include("../views/footer.php")?>