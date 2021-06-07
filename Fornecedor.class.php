<?php

	class Fornecedor
	{
		private $pdo;
		
		function __construct($pdo = null)
		{
			$this->pdo = $pdo;
		}

		public function add($razao = null, $documento, $user){
			$sql = "INSERT INTO fornecedor() values(null, :razao, :documento, :usuario)";
			$sql = $this->pdo->prepare($sql);
			$sql->bindValue(":razao", $razao);
			$sql->bindValue(":documento", $documento);
			$sql->bindValue(":usuario", $user);
			if($sql->execute()){
				return true;
			}else{
				return false;
			}
		}

		public function update($razao = null, $documento, $id){
			$sql = "UPDATE fornecedor SET razao_social =:razao, documento = :documento  WHERE id = :id";
			$sql = $this->pdo->prepare($sql);
			$sql->bindValue(":razao", $razao);
			$sql->bindValue(":documento", $documento);
			if($sql->execute()){
				return true;
			}else{
				return false;
			}
		}

		public function delete($id){
			$sql = "DELETE FROM fornecedor WHERE id = :id";
			$sql = $this->pdo->prepare($sql);
			if($sql->execute()){
				return true;
			}else{
				return false;
			}
		}

		public function select($id = null, $user){
			if(isset($id)){
				$sql = "SELECT * FROM fornecedor WHERE id = :id AND ID_USUARIO = :usuario";
			}else{
				$sql = "SELECT * FROM fornecedor WHERE ID_USUARIO = :usuario";
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
		


	}