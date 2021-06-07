<?php
	
	session_start();

	include '../Config.php';
	include '../Usuarios.class.php';

	$usuarios = new Usuarios($pdo);

	@$_GET['USERNAME'] = strtoupper($_GET['USERNAME']);
	@$_GET['PASSWORD'] = strtoupper($_GET['PASSWORD']);


	$usuarios = $usuarios->selectUnique(@$_GET['USERNAME'], @$_GET['PASSWORD']);

	if(isset($usuarios['id'])){
		$_SESSION['id_user'] = $usuarios['id'];
	}

	echo json_encode($usuarios);

	