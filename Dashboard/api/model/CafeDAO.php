<?php
session_start();
include("../controller/conexao.php");

//Receber os dados do formulário
$data = filter_input(INPUT_POST, 'data', FILTER_SANITIZE_STRING);
$principal = filter_input(INPUT_POST, 'principal', FILTER_SANITIZE_STRING);
$opcao = filter_input(INPUT_POST, 'opcao', FILTER_SANITIZE_STRING);
$nomeDoFuncionario = $_SESSION['nomeFuncionarioLogado'];
$idCafe = filter_input(INPUT_POST, 'cafe', FILTER_SANITIZE_NUMBER_INT);

//Converte a Data Para o formato SQL
$dataNova = implode("-",array_reverse(explode("/",$data)));

//Verifica se algo já foi cadastrado nesta data.
if (isset($_POST['enviar']) or isset($_POST['editar'])) {
    $sql = "select * from cafe where Data='$dataNova'";
    $stmt =	$conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if($result['Data'] == $dataNova){
        $_SESSION['idCafe'] = $result['idCafe'];
        $_SESSION['Data']	= $result['Data'];
	    $_SESSION['principal']= $result['principal'];
        $_SESSION['opcao'] = $result['opcao'];
        $_SESSION['enviar'] = 2;
        header("Location: ../../TelaDeAviso.php");
        $_SESSION['msg'] = "<p style='color:yellow; text-align:center;'>Já existe um cadastrado neste dia!
        </p><p style='text-align:center;'> O que você deseja Fazer?";
    }
}
//CadastrarCafe
//Verificar se o usuário clicou no botão, clicou no botão acessa o IF e tenta cadastrar, caso contrario acessa o ELSE
if(isset($_POST['enviar'])){
    try {
        $sql = "insert into cafe (Data, principal, opcao, nome) values (:Data, :principal, :opcao, :nome)";
        
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':Data', $dataNova);
        $stmt->bindParam(':principal', $principal);
        $stmt->bindParam(':opcao', $opcao);
        $stmt->bindParam(':nome', $nomeDoFuncionario);
        
        $result = $stmt->execute();
        $idCafe = $conn->lastInsertId();
    
    } catch(PDOExecption $e) {
        $conn->rollback();
        print "Error!: " . $e->getMessage() . "</br>";
    }
    
    if($result){
        $_SESSION['idCafe'] = $idCafe;

        if($idCafe != 0){
            $sql = "insert into votacaocafe(idCafe, otimo, bom, regular, ruim) values (:idCafe, 0, 0, 0, 0)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':idCafe', $idCafe);
            $result = $stmt->execute();    
        }
        
        $_SESSION['Data']	= $data;
	    $_SESSION['principal']= $principal;
        $_SESSION['opcao'] = $opcao;

        $_SESSION['msg'] = "<p style='color:green;text-align:center;'>Cadastro efetuado com sucesso</p>";
        header("Location: ../../telaConfirmacaoCafe.php#abrirModal");
    }else{
        $_SESSION['msg'] = "<p style='color:orange;text-align:center;'>Cadastro não efetuado com sucesso, erro</p>";
        header("Location: ../../TelaDeCadastrarCafe.php#abrirModal");
    }    
}

//EditaCafé
if(isset($_POST['editar'])){
    try {
        $sql = "update cafe set Data='$dataNova', principal='$principal',opcao='$opcao' where idCafe='$idCafe'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->rowCount();
    } catch(PDOExecption $e) {
        $conn->rollback();
        print "Error!: " . $e->getMessage() . "</br>";
    }	
	if($result > 0){
        $_SESSION['idCafe'] = $idCafe;
		$_SESSION['msg'] = "<p style='color:green;text-align:center;'> Café editado com sucesso</p>";
		header("Location: ../../telaConfirmacaoCafe.php#abrirModal");
	}else{
		$_SESSION['msg'] = "<p style='color:orange;text-align:center;'>Café não foi editado com sucesso</p>";
		header("Location: ../../telaConfirmacaoCafe.php#abrirModal");
	}
}

//ConsultaCafe
if(isset($_POST['pesquisar'])){
    $sql = "select * from cafe where Data='$dataNova'";
    $stmt =	$conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if($result){
        $_SESSION['idCafe'] = $result['idCafe'];
        $_SESSION['Data'] = implode("/",array_reverse(explode("-",$result['Data'])));
        $_SESSION['principal'] = $result['principal'];
        $_SESSION['opcao'] = $result['opcao'];
        $_SESSION['cadastradoPor'] = $result['nome'];
        header("Location: ../../TelaExibeCafe.php");
    }else{
        $_SESSION['msg'] = "<p style='color:orange; text-align:center;'>Nenhum dado encontrado!</p>";
        header("Location: ../../TelaConsultarCafe.php#abrirModal");
    }
}?>