<?php
	
	session_start();	

	include '../Config.php';
	include '../Pagamento.class.php';

	$tipoPagamento = new formaPagamento($pdo);

	echo $_GET['cartao_descricao'];
	echo $_GET['cartao_limite'];
	echo $_GET['data_vencimento'];

	if(isset($_GET['cartao_descricao']) && isset($_GET['cartao_limite'])){
		$tipoPagamento->add($_GET['cartao_descricao'], $_GET['cartao_limite'], $_GET['data_vencimento'], NULL, NULL, $_SESSION['id_user']);
		$ultimoId = $tipoPagamento->ultimoCartao()[0];
		echo $ultimoId;
		$tipoPagamento->addLimite($ultimoId,$_GET['cartao_limite'], $_GET['data_vencimento']);
	}

