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
		<form method="GET" action="api/RegisterFornecedor.api.php">
		<div class="registerAccountFild">
			 <label>DOCUMENTO</label>
			 <input type="text" name="documento_fornecedor">
		</div>
		<div class="registerAccountFild">
			 <label>RAZÃO SOCIAL</label>
			 <input type="text" name="razao_social">
		</div>
		<div class="registerAccountFild">
			<input type="submit" name="fornecedor_acao" value="Cadastrar">
		</div>
		</form>
	</div>
</body>
<script type="text/javascript" src="js/easy-control-RegisterFornecedor.js"></script>
<script type="text/javascript" src="js/easy-control-RegisterAccount.js"></script>

