<?php

	class formaPagamento
	{

		private $pdo;	

		function __construct($pdo = null)
		{
			$this->pdo = $pdo;
		}

		public function add($descricao = null, $saldoLimite = null, $data_cobranca = null, $data_atualizacao = null, $descricao_atualizacao = null, $user){
			$sql = "INSERT INTO formas_pagamento() values(null, :descricao, :saldoLimite, :data_cobranca, :data_atualizacao, :descricao_atualizacao, :usuario)";
			$sql = $this->pdo->prepare($sql);
			$sql->bindValue(":descricao", $descricao);
			$sql->bindValue(":saldoLimite", $saldoLimite);
			$sql->bindValue(":data_cobranca", $data_cobranca);
			$sql->bindValue(":data_atualizacao", $data_atualizacao);
			$sql->bindValue(":descricao_atualizacao", $descricao_atualizacao);
			$sql->bindValue(":usuario", $user);
			if($sql->execute()){
				return true;
			}else{
				return false;
			}
		}

		public function update($descricao = null, $saldoLimite = null, $data_cobranca = null, $data_atualizacao = null, $descricao_atualizacao = null){
			$sql = "UPDATE formas_pagamento SET descricao = :descricao, saldoLimite = :saldoLimite, data_cobranca = :data_cobranca, data_atualizacao = :data_atualizacao";
			$sql = $this->pdo->prepare($sql);
			$sql->bindValue(":descricao", $descricao);
			$sql->bindValue(":saldoLimite", $saldoLimite);
			$sql->bindValue(":data_cobranca", $data_cobranca);
			$sql->bindValue(":data_atualizacao", $data_atualizacao);
			$sql->bindValue(":descricao_atualizacao", $descricao_atualizacao);
			if($sql->execute()){
				return true;
			}else{
				return false;
			}
		}

		public function delete($id){
			$sql = "DELETE FROM formas_pagamento WHERE id = :id";
			$sql = $this->pdo->prepare($sql);
			if($sql->execute()){
				return true;
			}else{
				return false;
			}
		}

		public function select($id = null, $user){
			if(isset($id)){
				$sql = "SELECT * FROM formas_pagamento WHERE id = :id AND id_usuario = :usuario";
			}else{
				$sql = "SELECT * FROM formas_pagamento WHERE id_usuario = :usuario";
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

		public function ultimoCartao(){
			$sql = "SELECT id FROM formas_pagamento ORDER BY id DESC LIMIT 1";
			$sql = $this->pdo->query($sql);

			if($sql->rowCount() > 0){
				return $sql->fetch();
			}else{
				return array();
			}
		}

		public function addLimite($cartao, $saldo, $dataLimite){
			$sql = "INSERT INTO `limite_cartao` (`id`, `id_cartao`, `saldo`, `data_limite`) VALUES (null, :cartao, :saldo, :dataLimite);";
			$sql = $this->pdo->prepare($sql);
			$sql->bindValue(':cartao', $cartao);
			$sql->bindValue(':saldo', $saldo);
			$sql->bindValue(':dataLimite', $dataLimite);
			if($sql->execute()){
				return true;
			}else{
				return false;
			}
		}



	}

	