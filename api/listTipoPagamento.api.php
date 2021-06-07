<?php
	
	session_start();
	
	include '../Config.php';
	include '../Pagamento.class.php';

	$pagamento = new formaPagamento($pdo);
	if(isset($_GET['id'])){
		$pagamento = $pagamento->select($_GET['id'], $_SESSION['id_user']);
	}else{
		$pagamento = $pagamento->select(null, $_SESSION['id_user']);
	}
	$pagamento = json_encode($pagamento);

	echo $pagamento;

	