<?php
	
	session_start();

	include '../Config.php';
	include '../Categoria.class.php';

	$categoria = new Categoria($pdo);

	$_GET['categoria_descricao'] ? $categoria->add($_GET['categoria_descricao'], $_SESSION['id_user']): 'Sem dados';

	