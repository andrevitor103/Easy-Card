<?php

	session_start();

	include '../Config.php';
	include '../Fornecedor.class.php';

	$fornecedor = new Fornecedor($pdo);

	if(isset($_GET['documento_fornecedor']) && isset($_GET['razao_social'])){
		echo $_GET['documento_fornecedor'];
		echo $_GET['razao_social'];
		$fornecedor->add($_GET['razao_social'], $_GET['documento_fornecedor'], $_SESSION['id_user']);
	}

