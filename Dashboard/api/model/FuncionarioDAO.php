<?php
session_start();
include("../controller/conexao.php");

//Receber os dados do formulário
$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
$usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING);
$senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);
if ($_POST['nivelPermissao'] == "Gerente") { 
    //Gerente   
    $nivelPermissao = 0;
}else{
    //funcionario
    $nivelPermissao = 1;
}

//CADASTRARALMOCO
//Verificar se o usuário clicou no botão, clicou no botão acessa o IF e tenta cadastrar, caso contrario acessa o ELSE
if(isset($_POST['enviar'])){
    try {
        $sql = "insert into funcionario (nome, usuario, senha, nivelPermissao) values (:nome, :usuario, :senha, :nivelPermissao)";
        
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':usuario', $usuario);
        $stmt->bindParam(':senha', $senha);
        $stmt->bindParam(':nivelPermissao', $nivelPermissao);
        $result = $stmt->execute();
        $idFuncionario= $conn->lastInsertId();

    } catch(PDOExecption $e) {
        $conn->rollback();
        print "Error!: " . $e->getMessage() . "</br>";
    }
    
    if($result){
        $_SESSION['idFuncionario'] = $idFuncionario;
        $_SESSION['nome']	= $nome;
	    $_SESSION['usuario'] = $usuario;
	    $_SESSION['senha'] = "*********";
	    $_SESSION['nivelPermissao']= $nivelPermissao;

        $_SESSION['msg'] = "<p style='color:green;text-align:center;'>Cadastro efetuado com sucesso</p>";
        header("Location: ../../TelaConfirmaFuncionario.php#abrirModal");
    }else{
        $_SESSION['msg'] = "<p style='color:orange;text-align:center;'>Cadastro não efetuado com sucesso</p>";
        header("Location: ../../TelaDeCadastrarFuncionario.php#abrirModal");
    }    
}
//EditaCafé
if(isset($_POST['editar'])){
    try {
        $id = filter_input(INPUT_POST, 'idfuncionario', FILTER_SANITIZE_NUMBER_INT);
        $sql = "update funcionario set nome='$nome', usuario='$usuario',nivelPermissao='$nivelPermissao' where idfuncionario='$id'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->rowCount();
    } catch(PDOExecption $e) {
        $conn->rollback();
        print "Error!: " . $e->getMessage() . "</br>";
    }	
	if($result > 0){
        $_SESSION['idFuncionario'] = $id;
        $_SESSION['nome']	= $nome;
	    $_SESSION['usuario'] = $usuario;
	    $_SESSION['senha'] = "*********";
	    $_SESSION['nivelPermissao']= $nivelPermissao;
		$_SESSION['msg'] = "<p style='color:green;text-align:center;'> Funcionario editado com sucesso</p>";
		header("Location: ../../TelaConfirmaFuncionario.php#abrirModal");
	}else{
		$_SESSION['msg'] = "<p style='color:orange;text-align:center;'>Funcionario não foi editado com sucesso</p>";
		header("Location: ../../TelaConfirmaFuncionario.php#abrirModal");
	}
}
//AlterarSenha
if(isset($_POST['alterar'])){
    $idusuario = $_SESSION['idfuncionarioLogado'];
    $senhanova = filter_input(INPUT_POST, 'senhanova', FILTER_SANITIZE_STRING);
    $rep_senha = filter_input(INPUT_POST, 'rep_senha', FILTER_SANITIZE_STRING);

    $sql = "select senha from funcionario where idfuncionario='$idusuario'";
    $stmt =	$conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $senha_banco = $result['senha'];
    if(($senha != $senha_banco) || ($senhanova != $rep_senha)){
        $_SESSION['msg'] = "<p style='color:red; text-align:center;'>As senhas não conhecidem. Tente Novamente!</p>";
        header("Location: ../../TelaAlterarSenha.php#abrirModal");
    }else{
        $sql = "update funcionario set senha='$senhanova' where idfuncionario='$idusuario'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->rowCount();

        if($result > 0){
            $_SESSION['msg'] = "<p style='color:green;text-align:center;'> Senha Alterada com sucesso</p>";
            if($_SESSION['nivelPermissaoLogado'] == 0){
                header("Location: ../../TelaDaGerencia.php#abrirModal");
            }else{
                header("Location: ../../MenuPrincipal.php#abrirModal");
            }
            
        }else{
            $_SESSION['msg'] = "<p style='color:red;text-align:center;'>Senha não alterada com sucesso</p>";
            if($_SESSION['nivelPermissaoLogado'] == 0){
                header("Location: ../../TelaDaGerencia.php#abrirModal");
            }else{
                header("Location: ../../MenuPrincipal.php#abrirModal");
            }
        }
    }
}
//Arquivar Usuario-Apagar Usuario
if(isset($_POST['excluir'])){
    try {
        $id = filter_input(INPUT_POST, 'idfuncionario', FILTER_SANITIZE_NUMBER_INT);
        $sql = "insert into funcionarioMorto select idfuncionario, nome, usuario, senha, nivelPermissao from funcionario where idfuncionario ='$id'";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->rowCount();

    } catch(PDOExecption $e) {
        $conn->rollback();
        print "Error!: " . $e->getMessage() . "</br>";
    }    
    if($result > 0){
        $sql = "delete from funcionario where idfuncionario='$id'";
        $stmt =	$conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION['msg'] = "<p style='color:green;text-align:center;'>Usuário apagado com sucesso</p>";
        header("Location: ../../TelaDeConsultarFuncionario.php#abrirModal");
    }else{
        $_SESSION['msg'] = "<p style='color:red;text-align:center;'>Erro o usuário não foi apagado com sucesso</p>";
		header("Location: ../../TelaDeConsultarFuncionario.php#abrirModal");
    }    
}