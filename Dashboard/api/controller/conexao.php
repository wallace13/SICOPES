<?php
define('HOST', 'localhost');
define('USUARIO', 'root');
define('SENHA', '');
define('DB', 'pesquisasatisfacao');
 
$conexao = mysqli_connect(HOST, USUARIO, SENHA, DB) or die ('Não foi possível conectar');

$username = "root";
$senha = "";
try{
    $conn = new PDO('mysql:host=localhost; dbname=pesquisasatisfacao',$username, $senha);
}catch ( PDOException $e ){
    echo 'Erro ao conectar com o MySQL: ' . $e->getMessage();
}