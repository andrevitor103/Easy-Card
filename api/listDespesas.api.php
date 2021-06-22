<?php

	session_start();

	include '../Config.php';
	include '../Despesa.class.php';


	// echo 'aqui';

	// echo $_SESSION['id_user'];

	$despesa = new Despesa($pdo);


	if(isset($_GET['id'])){
		$despesa = $despesa->selectDt($_GET['id'], $_SESSION['id_user']);
	}else if(isset($_GET['filters'])){
		$despesa = $despesa->selectDtFilter($_GET['filters'], $_SESSION['id_user']);
	}else{
		$despesa = $despesa->selectDt(null, $_SESSION['id_user']);
	
	}
	
	$despesa = json_encode($despesa);

	echo $despesa;

