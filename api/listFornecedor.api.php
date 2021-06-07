<?php
		
	session_start();

	include '../Config.php';
	include '../Fornecedor.class.php';

	$fornecedor = new Fornecedor($pdo);
	if(isset($_GET['id'])){
		$fornecedor = $fornecedor->select($_GET['id'], $_SESSION['id_user']);
	}else{
		$fornecedor = $fornecedor->select(null, $_SESSION['id_user']);
	}
	$fornecedor = json_encode($fornecedor);

	echo $fornecedor;

