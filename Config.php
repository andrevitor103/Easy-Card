<?php

	$dados = parse_ini_file("env.in");

	try {
		$pdo = new PDO("mysql:dbname=".$dados["database"].";host=".$dados["host"], $dados["username"], $dados["password"]);
	}catch(PDOException $e){
		die(`Erro: {$e->getMessage()}`);
	}


