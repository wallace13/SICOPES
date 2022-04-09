<?php
session_start();
include("../controller/conexao.php");

//Receber os dados do formulário
$data = filter_input(INPUT_POST, 'data', FILTER_SANITIZE_STRING);
$salada = filter_input(INPUT_POST, 'salada', FILTER_SANITIZE_STRING);
$complemento = filter_input(INPUT_POST, 'complemento', FILTER_SANITIZE_STRING);
$principal = filter_input(INPUT_POST, 'principal', FILTER_SANITIZE_STRING);
$sobremesa = filter_input(INPUT_POST, 'sobremesa', FILTER_SANITIZE_STRING);
$suco = filter_input(INPUT_POST, 'suco', FILTER_SANITIZE_STRING);
$nomeFuncionario = $_SESSION['nomeFuncionarioLogado'];
$idAlmoco = filter_input(INPUT_POST, 'Almoco', FILTER_SANITIZE_NUMBER_INT);

//Converte a Data Para o formato SQL
$dataNova = implode("-",array_reverse(explode("/",$data)));

//Verifica se algo já foi cadastrado nesta data.
if (isset($_POST['enviar']) or isset($_POST['editar'])) {
    $sql = "select * from almoco where Data='$dataNova'";
    $stmt =	$conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if($result['Data'] == $dataNova){
        $_SESSION['idAlmoco'] = $result['idAlmoco'];
        $_SESSION['Data']	= $result['Data'];
	    $_SESSION['salada'] = $result['salada'];
	    $_SESSION['complemento'] = $result['complemento'];
	    $_SESSION['principal']= $result['principal'];
        $_SESSION['sobremesa'] = $result['sobremesa'];
	    $_SESSION['suco']= $result['suco'];
        $_SESSION['enviar'] = 1;
        header("Location: ../../TelaDeAviso.php");
        $_SESSION['msg'] = "<p style='color:yellow; text-align:center;'>Já existe um cadastrado neste dia!
        </p><p style='text-align:center;'> O que você deseja Fazer?";
    }
}
//CADASTRARALMOCO
//Verificar se o usuário clicou no botão, clicou no botão acessa o IF e tenta cadastrar, caso contrario acessa o ELSE
if(isset($_POST['enviar'])){
    try {
        $sql = "insert into almoco (Data, salada, complemento, principal, sobremesa, suco, nome) values (:Data, :salada, :complemento, :principal, :sobremesa, :suco, :nome)";
        
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':Data', $dataNova);
        $stmt->bindParam(':salada', $salada);
        $stmt->bindParam(':complemento', $complemento);
        $stmt->bindParam(':principal', $principal);
        $stmt->bindParam(':sobremesa', $sobremesa);
        $stmt->bindParam(':suco', $suco);
        $stmt->bindParam(':nome', $nomeFuncionario);
        
        $result = $stmt->execute();
        $idAlmoco = $conn->lastInsertId();

    } catch(PDOExecption $e) {
        $conn->rollback();
        print "Error!: " . $e->getMessage() . "</br>";
    }
    
    if($result){
        $_SESSION['idAlmoco'] = $idAlmoco;
        
        if($idAlmoco != 0){
            $sql = "insert into votacaoalmoco(idAlmoco, otimo, bom, regular, ruim) values (:idAlmoco, 0, 0, 0, 0)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':idAlmoco', $idAlmoco);
            $result = $stmt->execute();    

        }
        $_SESSION['Data']	= $data;
	    $_SESSION['salada'] = $salada;
	    $_SESSION['complemento'] = $complemento;
	    $_SESSION['principal']= $principal;
        $_SESSION['sobremesa'] = $sobremesa;
	    $_SESSION['suco']= $suco;

        $_SESSION['msg'] = "<p style='color:green;text-align:center;'>Cadastro efetuado com sucesso</p>";
        header("Location: ../../telaConfirmacaoAlmoco.php#abrirModal");
    }else{
        $_SESSION['msg'] = "<p style='color:orange;text-align:center;'>Cadastro não efetuado com sucesso</p>";
        header("Location: ../../TelaDeCadastrarAlmoco.php#abrirModal");
    }    
}
//EDITARALMOCO
if(isset($_POST['editar'])){
    try {
        $sql = "update almoco set Data='$dataNova', salada='$salada',complemento='$complemento',principal='$principal',sobremesa='$sobremesa',suco='$suco' where idAlmoco='$idAlmoco'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->rowCount();
   
    } catch(PDOExecption $e) {
        $conn->rollback();
        print "Error!: " . $e->getMessage() . "</br>";
    }
    
	if($result > 0){
        $_SESSION['idAlmoco'] = $idAlmoco;
		$_SESSION['msg'] = "<p style='color:green; text-align:center;'> Almoço editado com sucesso</p>";
		header("Location: ../../telaConfirmacaoAlmoco.php#abrirModal");
	}else{
		$_SESSION['msg'] = "<p style='color:orange; text-align:center;'>Almoço não foi editado</p>";
		header("Location: ../../telaConfirmacaoAlmoco.php#abrirModal");
	}

}
//ConsultaAlmoco
if(isset($_POST['pesquisar'])){
    $sql = "select * from almoco where Data='$dataNova'";
    $stmt =	$conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if($result){
        $_SESSION['idAlmoco'] = $result['idAlmoco'];
        $_SESSION['Data'] = implode("/",array_reverse(explode("-",$result['Data'])));
        $_SESSION['salada'] = $result['salada'];
        $_SESSION['complemento'] = $result['complemento'];
        $_SESSION['principal'] = $result['principal'];
        $_SESSION['sobremesa'] = $result['sobremesa'];
        $_SESSION['suco'] = $result['suco'];
        $_SESSION['cadastradoPor'] = $result['nome'];
        header("Location: ../../TelaExibeAlmoco.php");
    }else{
        $_SESSION['msg'] = "<p style='color:orange; text-align:center;'>Nenhum dado encontrado!</p>";
        header("Location: ../../TelaConsultarAlmoco.php#abrirModal");
    }
}?>