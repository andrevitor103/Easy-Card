<?php

	class Despesa
	{

		private $pdo;	

		function __construct($pdo = null)
		{
			$this->pdo = $pdo;
		}

		public function add($valor_despesa = 0, $total_parcelas = 1, $data_compra, $fornecedor, $categoria = null, $condicaoPagamento = null, $juros = 0, $desconto = 0, $user){
			$sql = "INSERT INTO despesas() values(null, :valor_despesa, :total_parcelas, :data_compra, :fornecedor, :categoria, null, :juros, :desconto, :formaPagamento, :usuario)";
			$sql = $this->pdo->prepare($sql);
			$sql->bindValue(":valor_despesa", $valor_despesa);
			$sql->bindValue(":total_parcelas", $total_parcelas);
			$sql->bindValue(":data_compra", $data_compra);
			$sql->bindValue(":fornecedor", $fornecedor);
			$sql->bindValue(":categoria", $categoria);
			$sql->bindValue(":formaPagamento", $condicaoPagamento);
			$sql->bindValue(":juros", $juros);
			$sql->bindValue(":desconto", $desconto);
			$sql->bindValue(":usuario", $user);
			return $sql->execute();
			if($sql->execute()){
				return true;
			}else{
				return false;
			}
		}

		public function update($valor_despesa, $total_parcelas = null, $data_compra, $fornecedor, $categoria = null, $condicaoPagamento = null, $juros = null, $desconto = null){
			$sql = "UPDATE despesas SET valor_despesa = :valor_despesa, total_parcelas = :total_parcelas, data_compra = :data_compra, id_fornecedor = :fornecedor, id_categoria = :categoria, id_condicaoPagamento = :condicaoPagamento, juros_atraso = :juros, desconto = :desconto";
			$sql = $this->pdo->prepare($sql);
			$sql->bindValue(":valor_despesa", $valor_despesa);
			$sql->bindValue(":total_parcelas", $total_parcelas);
			$sql->bindValue(":data_compra", $data_compra);
			$sql->bindValue(":fornecedor", $fornecedor);
			$sql->bindValue(":categoria", $categoria);
			$sql->bindValue(":condicaoPagamento", $condicaoPagamento);
			$sql->bindValue(":juros", $juros);
			$sql->bindValue(":desconto", $desconto);
			if($sql->execute()){
				return true;
			}else{
				return false;
			}
		}

		public function delete($id){
			$sql = "DELETE FROM despesas WHERE id = :id";
			$sql = $this->pdo->prepare($sql);
			$sql->bindValue(':id', $id);
			if($sql->execute()){
				return true;
			}else{
				return false;
			}
		}

		public function select($id = null, $user){
			if(isset($id)){
				$sql = "SELECT *,
				(SELECT razao_social FROM fornecedor WHERE fornecedor.id = despesas.ID_FORNECEDOR) AS `FORNECEDOR`,
				(SELECT DESCRICAO FROM formas_pagamento WHERE formas_pagamento.id = despesas.ID_FORMA_PAGAMENTO) AS `CARTAO`,
				(SELECT DESCRICAO FROM categoria WHERE categoria.id = despesas.id_categoria) AS `CATEGORIA`
				FROM despesas WHERE id = :id AND id_usuario = :usuario";
			}else{
				$sql = "SELECT *,
				(SELECT razao_social FROM fornecedor WHERE fornecedor.id = despesas.ID_FORNECEDOR) AS `FORNECEDOR`,
				(SELECT DESCRICAO FROM formas_pagamento WHERE formas_pagamento.id = despesas.ID_FORMA_PAGAMENTO) AS `CARTAO`,
				(SELECT DESCRICAO FROM categoria WHERE categoria.id = despesas.id_categoria) AS `CATEGORIA`
				FROM despesas WHERE id_usuario = :usuario";
			}

			$sql = $this->pdo->prepare($sql);
			if(isset($id)){
				$sql->bindValue(':id', $id);
			}
			$sql->bindValue(':usuario', $user);
			$sql->execute();
			if($sql->rowCount() > 0){
				return $sql->fetchAll();
			}else{
				return Array();
			}
		}

			public function selectDt($id = null, $user){
			if(isset($id)){
				$sql = "SELECT * FROM despesasdt WHERE id = :id AND id_usuario = :usuario";
			}else{
				$sql = "SELECT * FROM despesasdt WHERE id_usuario = :usuario ORDER BY `DT VENCIMENTO` ASC";
			}

			$sql = $this->pdo->prepare($sql);
			if(isset($id)){
				$sql->bindValue(':id', $id);
			}
			$sql->bindValue(':usuario', $user);
			$sql->execute();
			if($sql->rowCount() > 0){
				return $sql->fetchAll();
			}else{
				return Array();
			}
		}

		public function selectDtFilter($filter = null, $user){
			if(isset($filter)){
				$sql = "SELECT * FROM despesasdt WHERE 1=1 AND ID_USUARIO = :usuario AND ".$filter;
			}else{
				$sql = "SELECT A.ID AS `ID CONTA`,
						(SELECT formas_pagamento.DESCRICAO FROM formas_pagamento WHERE formas_pagamento.ID = A.ID_FORMA_PAGAMENTO) AS `CONTA`, 
						(SELECT fornecedor.RAZAO_SOCIAL FROM fornecedor WHERE fornecedor.ID = A.ID_FORNECEDOR) AS `FORNECEDOR`, 
						DT.VALOR_PARCELA AS `VALOR PARCELA`, DT.NUMERO_PARCELA AS `Nª PARCELA`, A.TOTAL_PARCELAS AS `TOTAL PARCELA`,
						DT.DATA_VENCIMENTO AS `DT VENCIMENTO`, DT.JUROS, DT.DESCONTO, DT.DATA_PAGAMENTO AS `DT PAGAMENTO`
						FROM despesas AS A
						LEFT OUTER JOIN despesas_detalhes AS DT ON DT.ID_DESPESA = A.ID
						WHERE ID_USUARIO = :usuario
						;";
			}

			$sql = $this->pdo->prepare($sql);
		
			$sql->bindValue(':usuario', $user);

			$sql->execute();
			if($sql->rowCount() > 0){
				return $sql->fetchAll();
			}else{
				return Array();
			}
		}


		function ultimoId(){
			$sql = "SELECT id FROM despesas ORDER BY id DESC LIMIT 1";
			$sql = $this->pdo->query($sql);

			if($sql->rowCount() > 0){
				return $sql->fetch();
			}else{
				return array();
			}
		}


		public function addDt($valor_parcela = 0, $data_vencimento, $data_pagamento = null, $juros = 0, $desconto = 0, $ID_DESPESA, $total_parcelas = 0){
			$parcela = 1;
			$add = 0;
			while($parcela <= $total_parcelas){

			$sql = "INSERT INTO despesas_detalhes() values(null, :valor_parcela, :data_vencimento, :data_pagamento, :juros, :desconto, :ID_DESPESA, :NUMERO_PARCELA)";
			$sql = $this->pdo->prepare($sql);
			$data_vencimento = date('Y-m-d',strtotime('+30 days', strtotime($data_vencimento)));
			$sql->bindValue(":valor_parcela", ($valor_parcela/$total_parcelas));
			$sql->bindValue(":data_vencimento", $data_vencimento);
			$sql->bindValue(":data_pagamento", $data_pagamento);
			$sql->bindValue(":juros", $juros);
			$sql->bindValue(":desconto", $desconto);
			$sql->bindValue(":ID_DESPESA", $ID_DESPESA);
			$sql->bindValue(":NUMERO_PARCELA", $parcela);
			
			if($sql->execute()){
				$add++;
			}else{
			}
			$parcela++;
		}
		if($add == $total_parcelas){
			return true;
		}else{
			return false;
		}
	}


	public function verificarStatusDespesa($id){
		$sql = "SELECT * FROM despesas_detalhes WHERE ID = :id";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(':id', $id);
		$sql->execute();
		if($sql->rowCount() > 0){
			return $sql->fetch();
		}else{
			return array();
		}
	}


	public function pagarDespesa($id){
		$sql = "UPDATE despesas_detalhes set DATA_PAGAMENTO = '".date('Y-m-d')."' WHERE id = :id ";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(':id', $id);
		if($sql->execute()){
			return true;
		}else{
			echo 'Ixi';
			return false;
		}
	}

	public function ativarDespesa($id){
		$sql = "UPDATE despesas_detalhes set DATA_PAGAMENTO = null WHERE id = :id ";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(':id', $id);
		if($sql->execute()){
			return true;
		}else{
			return false;
		}
	}

	public function updateDt($id_forma_pagamento, $id_fornecedor, $id){
		echo $sql = "UPDATE despesas set ID_FORMA_PAGAMENTO = :id_forma_pagamento, ID_FORNECEDOR = :id_fornecedor WHERE ID = :id";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(':id_forma_pagamento', $id_forma_pagamento);
		$sql->bindValue(':id_fornecedor', $id_fornecedor);
		$sql->bindValue(':id', $id);
		if($sql->execute()){
			echo 'ok';
			return true;
		}else{
			return false;
		}
	}

	public function updateDtInfo($valor_parcela, $data_vencimento, $data_pagamento, $juros, $desconto, $id){
		$sql = "UPDATE despesas_detalhes set VALOR_PARCELA = :valor_parcela, DATA_VENCIMENTO = :data_vencimento,
		 DATA_PAGAMENTO = :data_pagamento, JUROS = :juros, DESCONTO = :desconto WHERE ID = :id";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(':valor_parcela', $valor_parcela);
		$sql->bindValue(':data_vencimento', $data_vencimento);
		$sql->bindValue(':data_pagamento', $data_pagamento);
		$sql->bindValue(':juros', $juros);
		$sql->bindValue(':desconto', $desconto);
		$sql->bindValue(':id', $id);
		if($sql->execute()){
			echo 'ok';
			return true;
		}else{
			return false;
		}
	}


public function selectDataDashboardConta($filter = null, $user){
			if(isset($filter)){
				$sql = "SELECT CONTA, id_forma_pagamento, limite.saldo AS `SALDO LIMITE`, (limite.saldo - SUM(`VALOR PARCELA`)) AS `SALDO DISPONIVEL`,  `DT VENCIMENTO`, SUM(`VALOR PARCELA`) AS `TOTAL COMPRA`, 
					MONTH(`DT VENCIMENTO`) AS `MES`,YEAR(`DT VENCIMENTO`) AS `ANO` 
					FROM despesasdt
					INNER JOIN limite_cartao AS limite ON limite.id_cartao = despesasdt.id_forma_pagamento WHERE id_usuario = :usuario AND ".$filter." GROUP BY id_forma_pagamento";
			}else{
				$sql = "SELECT CONTA, id_forma_pagamento, limite.saldo AS `SALDO LIMITE`, (limite.saldo - SUM(`VALOR PARCELA`)) AS `SALDO DISPONIVEL`,  `DT VENCIMENTO`, SUM(`VALOR PARCELA`) AS `TOTAL COMPRA`, 
					MONTH(`DT VENCIMENTO`) AS `MES`,YEAR(`DT VENCIMENTO`) AS `ANO` 
					FROM despesasdt
					INNER JOIN limite_cartao AS limite ON limite.id_cartao = despesasdt.id_forma_pagamento
					WHERE id_usuario = :usuario
					GROUP BY id_forma_pagamento";
			}

			$sql = $this->pdo->prepare($sql);
			
			if(isset($filter)){
				// $sql->bindValue('filter', $filter);
			}

			$sql->bindValue(':usuario', $user);
			$sql->execute();
			if($sql->rowCount() > 0){
				return $sql->fetchAll();
			}else{
				return Array();
			}
		}

	public function selectDataDashboardCategoria($filter = null, $user){
			if(isset($filter)){
				$sql = "SELECT CONTA, id_forma_pagamento, CATEGORIAS, limite.saldo AS `SALDO LIMITE`, (limite.saldo - SUM(`VALOR PARCELA`)) AS `SALDO DISPONIVEL`,  `DT VENCIMENTO`, SUM(`VALOR PARCELA`) AS `TOTAL COMPRA`, 
					MONTH(`DT VENCIMENTO`) AS `MES`,YEAR(`DT VENCIMENTO`) AS `ANO` 
					FROM despesasdt
					INNER JOIN limite_cartao AS limite ON limite.id_cartao = despesasdt.id_forma_pagamento WHERE 
					1=1 AND NOT ISNULL(CATEGORIAS) AND id_usuario = :usuario AND ".$filter." GROUP BY CATEGORIAS";
			}else{
				$sql = "SELECT CONTA, id_forma_pagamento, CATEGORIAS, limite.saldo AS `SALDO LIMITE`, (limite.saldo - SUM(`VALOR PARCELA`)) AS `SALDO DISPONIVEL`,  `DT VENCIMENTO`, SUM(`VALOR PARCELA`) AS `TOTAL COMPRA`, 
					MONTH(`DT VENCIMENTO`) AS `MES`,YEAR(`DT VENCIMENTO`) AS `ANO` 
					FROM despesasdt
					INNER JOIN limite_cartao AS limite ON limite.id_cartao = despesasdt.id_forma_pagamento
					WHERE 1=1 AND NOT ISNULL(CATEGORIAS) AND id_usuario = :usuario
					GROUP BY CATEGORIAS";
			}

			$sql = $this->pdo->prepare($sql);
			
			if(isset($filter)){
				// $sql->bindValue('filter', $filter);
			}

			$sql->bindValue(':usuario', $user);
			$sql->execute();
			if($sql->rowCount() > 0){
				return $sql->fetchAll();
			}else{
				return Array();
			}
		}

	}

