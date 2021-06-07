<?php
	
	session_start();

	include '../Config.php';
	include '../Despesa.class.php';

	$despesa = new Despesa($pdo);
	
	$ok = 0;

	$_GET['conta_juros'] = $_GET['conta_juros'] ? $_GET['conta_juros'] : '0';
	$_GET['conta_desconto'] = $_GET['conta_desconto'] ? $_GET['conta_desconto'] : '0';
	$_GET['conta_categoria'] = $_GET['conta_categoria'] ? $_GET['conta_categoria'] : null;
	$_GET['conta_data'] = $_GET['conta_data'] ? $_GET['conta_data'] : date('Y-m-d');
	$_GET['conta_total_parcela'] = $_GET['conta_total_parcela'] ? $_GET['conta_total_parcela']: 1;


	if($despesa->add(
		@$_GET['conta_valor'] ?? 0,@$_GET['conta_total_parcela'], $_GET['conta_data'],@$_GET['conta_fornecedor'],
		@$_GET['conta_categoria'],@$_GET['conta_tipo_pagamento'],$_GET['conta_juros'],$_GET['conta_desconto'], $_SESSION['id_user']
	) == 1){
		$ok++;
	}

	$idDespesa = $despesa->ultimoId()[0];

	@$_GET['conta_valor'] = @$_GET['conta_valor']- $_GET['conta_desconto'];

	// echo $_GET['conta_valor'].','.@$_GET['conta_data'].','.$idDespesa.','.$_GET['conta_total_parcela'];
	// echo '<br>';
	
	if($despesa->addDt(@$_GET['conta_valor'], @$_GET['conta_data'], null, 0, 0, $idDespesa, $_GET['conta_total_parcela']) == 1){
		$ok++;
	}
	
	if($ok == 2){
		$ok = "ok";
		echo json_encode($ok);
	}else{
		$ok = "erro";
		echo json_encode($ok);
	}