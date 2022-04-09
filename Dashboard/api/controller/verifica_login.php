<?php
if(!$_SESSION['usuarioLogado']) {
	header('Location: ./TelaDeLogin.php');
	exit();
}
