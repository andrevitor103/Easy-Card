<?php

	session_start();

	include '../Config.php';
	include '../Despesa.class.php';

	// echo $_SESSION['id_user'];

	$despesa = new Despesa($pdo);
	if(isset($_GET['id'])){
		$despesa = $despesa->delete($_GET['id']);
	}
	echo $despesa;

	