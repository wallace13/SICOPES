<?php
session_start();

include("../controller/conexao.php");

//Verifica se usuario e senha, não estão em branco
if(empty($_POST['usuario']) || empty($_POST['senha'])){
    header('Location: login.php');
    exit();
}
//Recebe os dados do usuario e da senha
$usuario = mysqli_real_escape_string($conexao, $_POST['usuario']);
$senha = mysqli_real_escape_string($conexao, $_POST['senha']);

//Verifica se usuario e senha estão cadastrados no banco
$query = "select * from funcionario where usuario = '{$usuario}' and senha = '{$senha}'";

$result = mysqli_query($conexao, $query);
$arrayResultado = mysqli_fetch_assoc($result);
$row = mysqli_num_rows($result);

//Verifica se usuario e senha foram encontrados, se sim manda usuario para o menu principal
//se não informa ao usuario que dados não foram encontrados
if($row > 0) {
	$_SESSION['idfuncionarioLogado']	= $arrayResultado['idfuncionario'];
	$_SESSION['nomeFuncionarioLogado'] = $arrayResultado['nome'];
	$_SESSION['usuarioLogado'] = $usuario;
	$_SESSION['senha']=$senha;
	$_SESSION['nivelPermissaoLogado']=$arrayResultado['nivelPermissao'];
	header('Location: ../../MenuPrincipal.php');
	exit();
} else {
	$_SESSION['msg'] = "<p style='color:orange; text-align:center;'>ERRO: Usuário ou senha inválidos!</p>";
	header('Location: ../../TelaDeLogin.php#abrirModal');
	exit();
} 


