<?php

	class Usuarios
	{
		private $pdo;

		function __construct($pdo = null)
		{
			$this->pdo = $pdo;
		}

		function add($username, $password){
			$sql = "INSERT INTO usuarios() values(null, :username, :password)";
			$sql = $this->pdo->prepare($sql);

			$username = strtoupper($username);
			$password = strtoupper($password);
			
			$sql->bindValue(':username', $username);
			$sql->bindValue(':password', $password);
			if($sql->execute()){
				return true;
			}else{
				return false;
			}
		}

		function edit($id, $username, $password){
			$sql = "UPDATE usuario SET username = :username, user_password = :password WHERE id = :id";
			$sql = $this->pdo->prepare($sql);
			
			$username = strtoupper($username);
			$password = strtoupper($password);
			
			$sql->bindValue(':id', $id);
			$sql->bindValue(':username', $username);
			$sql->bindValue(':password', $password);
			if($sql->execute()){
				return true;
			}else{
				return false;
			}
		}

		function select($id){
			$sql = "SELECT * FROM usuario WHERE id = :id";
			$sql = $this->pdo->prepare($sql);
			$sql->bindValue(':id', $id);
			$sql->execute();
			if($sql->rowCount() > 0){
				return $sql->fetchAll();
			}else{
				return array();
			}
		}

		function selectUnique($username, $password){
			$sql = "SELECT * FROM usuario WHERE username = :username AND user_password = :password";
			$sql = $this->pdo->prepare($sql);
			
			$username = strtoupper($username);
			$password = strtoupper($password);

			$sql->bindValue(':username', $username);
			$sql->bindValue(':password', $password);
			$sql->execute();
			if($sql->rowCount() > 0){
				return $sql->fetch();
			}else{
				return array();
			}
		}


}
