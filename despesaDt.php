<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" type="text/css" href="css/mainPage.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<title>Main Page</title>
</head>


<body>
	
		<div class="close-modal-criar" name="btnFecharModal"></div>
	<div class="panel_dt dt_view">
		<div class="dt_info">
			<label>CONTA</label>
			<p name="dt_conta"></p>
		</div>
		<div class="dt_info">
			<label>FORNECEDOR</label>
			<p name="dt_fornecedor"></p>
		</div>
		<div class="dt_info">
			<label>VALOR PARCELA</label>
			<p name="dt_valorParcela"></p>
		</div>
		<div class="dt_info">
			<label>Nº PARCELA</label>
			<p name="dt_numeroParcela"></p>
		</div>
		<div class="dt_info">
			<label>DT VENCIMENTO</label>
			<p name="dt_dataVencimento"></p>
		</div>
		<div class="dt_info">
			<label>JUROS</label>
			<p name="dt_juros" class="dt_juros"></p>
		</div>
		<div class="dt_info">
			<label>DESCONTO</label>
			<p name="dt_desconto" class="dt_desconto"></p>
		</div>
		<div class="dt_info">
			<label>DT PAGAMENTO</label>
			<p name="dt_dataPagamento"></p>
		</div>
		<div class="dt_info">
			<label>STATUS</label>
			<p name="dt_status"></p>
		</div>
		<div class="dt_info_btn">
			<button class="dt_btn_view">Editar</button>
		</div>
	</div>

	<div class="panel_dt dt_edit hidden">
		<div class="dt_info">
			<label>CONTA</label>
			<select name="dt_conta_edit">
			</select>
		</div>
		<div class="dt_info">
			<label>FORNECEDOR</label>
			<select name="dt_fornecedor_edit">
			</select>
		</div>
		<div class="dt_info">
			<label>VALOR PARCELA</label>
			<input type="number" name="dt_valorParcela_edit">
		</div>
		<div class="dt_info">
			<label>Nº PARCELA</label>
			<p name="dt_numeroParcela_edit"></p>
		</div>
		<div class="dt_info">
			<label>DT VENCIMENTO</label>
			<input type="date" name="dt_dataVencimento_edit">
		</div>
		<div class="dt_info">
			<label>JUROS</label>
			<input type="number" data-type="currency" name="dt_juros_edit">
		</div>
		<div class="dt_info">
			<label>DESCONTO</label>
			<input type="number" data-type="currency" name="dt_desconto_edit">
		</div>
		<div class="dt_info">
			<label>DT PAGAMENTO</label>
			<input type="date" name="dt_dataPagamento_edit">
		</div>
		<div class="dt_info">
			<label>STATUS</label>
			<p name="dt_status_edit">PAGO</p>
		</div>
		<div class="dt_info_btn">
			<button class="dt_btn_edit">SALVAR</button>
		</div>
	</div>

</body>
<!-- <script type="text/javascript" src="js/easy-control-AccountDt.js"></script> -->
