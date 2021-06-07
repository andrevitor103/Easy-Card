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
		<form method="GET" action="api/addCartao.php">
		<div class="registerAccountFild">
			 <label>DESCRIÇÃO</label>
			 <input type="text" name="cartao_descricao">
		</div>
		<div class="registerAccountFild">
			 <label>LIMITE</label>
			 <input type="text" name="cartao_limite">
		</div>
		<div class="registerAccountFild">
			 <label>DT VENCIMENTO</label>
			 <input type="date" name="data_vencimento">
		</div>
		<div class="registerAccountFild">
			<input type="submit" name="cartao_acao" value="Cadastrar">
		</div>
		</form>
	</div>
</body>

<script type="text/javascript" src="js/easy-control-RegisterAccount.js"></script>