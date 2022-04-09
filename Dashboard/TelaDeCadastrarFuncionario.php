<?php include ("../views/header.php")?>
<h4>Pesquisa de Satisfação - Cadastrar Funcionário</h4>
    <form method="post" action="api/model/FuncionarioDAO.php">
        <div class="orderLabel">
            <label for="nome">Nome:</label>
			<input type="text" name="nome" id="text" placeholder="Nome e sobrenome"required/>
        </div> 	
        <div class="orderLabel">
            <label for="usuario">Usuário:</label>
			<input type="text" name="usuario" id="text" placeholder="Nome do usuário"required/>
        </div> 	
        <div class="orderLabel">
            <label for="senha" id="textSenha">Senha:</label>
			<input type="password" id="senhaFuncionario" name="senha" placeholder="Senha" required/>
			<input type="password" id="rep_senha" name="rep_senha" placeholder="Confirmar Senha" onkeyup="validarSenha()" required/>
        </div> 
        <table>
            <tr>
                <td><input style='margin-left: 110px; ' type="checkbox" onclick="mostrarSenha()">Mostrar senha</td>
                <td><div style='color:crimson; margin-left: 120px;' id="impSenha"></div> </td>
            </tr>
        </table>
        <div class="orderLabel" >
            <label for="nivelPermissao">Cargo:</label>
			<select name="nivelPermissao" style='width: 455px; ' required>
                <option></option>
                <option value="Gerente">Gerente</option>
                <option value="Funcionario">Funcionário</option>    
            </select>   
        </div> 	
        <br>
        <div class="buttons">
            <a class="btn-medium" id="editar" href="TelaDaGerencia.php">Cancelar</a>
            <button class="btn-medium" name="enviar" id="cadastrar" onclick="return validar()">Cadastrar</button>
        </div> 	
    </form>
<?php include("../views/footer.php")	?>
