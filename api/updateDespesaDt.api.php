<?php

	include '../Config.php';
	include '../Despesa.class.php';
	
	date_default_timezone_set('America/Sao_Paulo');


	$despesa = new Despesa($pdo);

	if(isset($_GET['pagarDespesa'])){

	$resultado = $despesa->verificarStatusDespesa($_GET['id']);	

	foreach ($resultado as $key => $value) {
		if($key == "DATA_PAGAMENTO"){
			echo $key.$value;
			if($value != ""){
				$despesa->ativarDespesa($_GET['id']);
			}else{
				$despesa->pagarDespesa($_GET['id']);
			}
		}
	}
}else{

		echo $_GET['dataPagamento'];
		echo '<br>';
		echo $_GET['conta'].$_GET['fornecedor'].$_GET['id'];
		echo '<br>';
		$despesa->updateDt($_GET['conta'], $_GET['fornecedor'], $_GET['idDespesa']);
		echo '<br>';
		$despesa->updateDtInfo($_GET['valorParcela'], $_GET['dataVencimento'], $_GET['dataPagamento'] ? $_GET['dataPagamento']  : null,
		$_GET['juros'],$_GET['desconto'],$_GET['id']);

}

	