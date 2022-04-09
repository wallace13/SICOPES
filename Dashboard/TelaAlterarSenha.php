<?php include ("../views/header.php") ?>

<h4>Pesquisa de Satisfação - Alterar Senha</h4>
    <form method="post" action="api/model/FuncionarioDAO.php">
        <div class="orderLabel">
            <label for="senha" id="textSenha">Informe a senha atual:</label>
			<input type="password" id="senhaAtual" name="senha" placeholder="Senha" required/>
        </div> 	
        <div class="orderLabel">
            <label for="senha" id="textSenha">Informe a nova Senha:</label>
			<input type="password" id="senhaFuncionario" name="senhanova" placeholder="Senha" required/>
        </div>
        <div class="orderLabel">
            <label for="senha" id="textSenha">Confirme a nova Senha:</label>
			<input type="password" id="rep_senha" name="rep_senha" placeholder="Confirmar Senha" onkeyup="validarSenha()" required/>
        </div> 
        <table>
            <tr>
                <td><input style='margin-left: 190px; ' type="checkbox" onclick="mostrarSenha()">Mostrar senha</td>
            </tr>
            <tr>
                <td><div style='color:crimson; margin-left: 190px;' id="impSenha"></div> </td>
            </tr>
        </table>
        <br>
        <?php include("api/controller/exibeModal.php");?>        
        <br>
        <div class="buttons">
            <?php if ($_SESSION['nivelPermissaoLogado'] == 0) {?>
                <a class="btn-medium" id="editar" href="TelaDaGerencia.php">Cancelar</a>
            <?php } else {?>
                <a class="btn-medium" id="editar" href="MenuPrincipal.php">Cancelar</a>
            <?php }?>
            <button class="btn-medium" name="alterar" id="cadastrar" onclick="return validar()">Confirmar</button>
        </div> 	
    </form>
    <?php include("../views/footer.php")?>