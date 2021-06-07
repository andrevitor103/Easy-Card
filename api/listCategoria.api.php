<?php
	
	session_start();

	include '../Config.php';
	include '../Categoria.class.php';

	$categoria = new Categoria($pdo);
	if(isset($_GET['id'])){
		$categoria = $categoria->select($_GET['id'], $_SESSION['id_user']);
	}else{
		$categoria = $categoria->select(null, $_SESSION['id_user']);
	}
	$categoria = json_encode($categoria);

	echo $categoria;

	