<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name='viewport' content='width=device-width, initial-scale=1'>
	<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
	<title>Main Page EC</title>
	<link rel="stylesheet" type="text/css" href="css/easy-control.css">
	<link rel="stylesheet" type="text/css" href="css/easy-control-registers.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

</head>

<body>
	<div class="registerAccount">
		<form method="GET" action="api/addCategory.php">
		<div class="registerAccountFild">
			 <label>CATEGORIA</label>
			 <input type="text" name="categoria_descricao">
		</div>
		<div class="registerAccountFild">
			<input type="submit" name="categoria_acao" value="Cadastrar">
		</div>
		</form>
	</div>
</body>
<script type="text/javascript" src="js/easy-control-RegisterAccount.js"></script>
