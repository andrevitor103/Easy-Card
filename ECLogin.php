<?php

	session_start();

	session_destroy();

?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/easy-control.css">
	<link rel="stylesheet" type="text/css" href="css/easy-control-login.css">
	<title>EC LOGIN</title>
</head>
<body>
	<div class="conteinerss">
		<div class="container_login">
			<div class="login_access">
				<div class="login_access_title">
						<div class="logo"></div>
						<h4>Seja bem vindo ao EC</h4>
				</div>
				<div class="login_access_single">
					<input type="text" name="login_user" placeholder="Digite seu usuário...">
				</div>
				<div class="login_access_single">
					<input type="password" name="login_password" placeholder="Digite sua senha...">
				</div>
				<div class="login_access_single">
					<input type="submit" name="login_acao" value="Acessar">
				</div>
			</div>
		</div>
	</div>
</body>
<!-- <script type="text/javascript" src="js/easy-control.js"></script> -->
<script type="text/javascript" src="js/User.js"></script>
</html>

