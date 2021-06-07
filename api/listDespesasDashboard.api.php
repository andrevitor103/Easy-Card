<?php
	
	session_start();

	include '../Config.php';
	include '../Despesa.class.php';

	$despesa = new Despesa($pdo);
	if(isset($_GET['id'])){
		$despesa = $despesa->selectDt($_GET['id']);
	}else if(isset($_GET['filters'])){

		<<<HTML
		<br>
		<h4>{$_GET['filters']}<h4>
HTML;
		$despesa = $despesa->selectDataDashboardConta($_GET['filters'], $_SESSION['id_user']);
	}else{
		$despesa = $despesa->selectDataDashboardConta(null, $_SESSION['id_user']);
	}
	$despesa = json_encode($despesa);
	echo $despesa;

