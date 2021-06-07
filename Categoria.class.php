<?php

	class Categoria
	{
		
		function __construct($pdo = null)
		{
			$this->pdo = $pdo;
		}

		public function add($categoria, $user){
			$sql = "INSERT INTO categoria() values(null, :categoria, :usuario)";
			$sql = $this->pdo->prepare($sql);
			$sql->bindValue(":categoria", $categoria);
			$sql->bindValue(":usuario", $user);
			if($sql->execute()){
				return true;
			}else{
				return false;
			}
		}

		public function update($categoria){
			$sql = "UPDATE categoria SET categoria = :categoria";
			$sql = $this->pdo->prepare($sql);
			$sql->bindValue(":categoria", $categoria);
			if($sql->execute()){
				return true;
			}else{
				return false;
			}
		}

		public function delete($id){
			$sql = "DELETE FROM categoria WHERE id = :id";
			$sql = $this->pdo->prepare($sql);
			if($sql->execute()){
				return true;
			}else{
				return false;
			}
		}

		public function select($id = null, $user){
			if(isset($id)){
				$sql = "SELECT * FROM categoria WHERE id = :id AND id_usuario = :usuario";
			}else{
				$sql = "SELECT * FROM categoria WHERE id_usuario = :usuario";
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

	