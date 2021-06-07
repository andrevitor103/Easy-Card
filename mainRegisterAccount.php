<?php
	session_start();

	include 'pages/header.php';

	if(!isset($_SESSION['id_user'])){
		header('location: EClogin.php');
	}
?>

	<div class="modalRegister">
		<div class="close-modal-register"></div>
		<div id="divModal"></div>
	</div>

	<div class="registerAccount">
		<form method="GET" action="api/RegisterAccount.api.php">
		<div class="registerAccountFild">
			 <label>TIPO PAGAMENTO</label>
			 <select name="conta_tipo_pagamento">
			 	<option value=""></option>
			 </select>
			 <span><i class="fa fa-plus-square fas-small" id="btnRegisterAccount" opt="tipo_pagamento"></i></span>
		</div>
		<div class="registerAccountFild">
			 <label>FORNECEDOR</label>
			<select name="conta_fornecedor">
			 	<option value=""></option>
			 </select>
			<span><i class="fa fa-plus-square fas-small" id="btnRegisterAccount" opt="fornecedor"></i></span>
		</div>
		<div class="registerAccountFild">
			 <label>VALOR</label>
			 <input type="number" name="conta_valor">
		</div>
		<div class="registerAccountFild">
			 <label>DESCONTO</label>
			 <input type="number" name="conta_desconto">
		</div>
		<div class="registerAccountFild">
			 <label>JUROS P/MÊS</label>
			 <input type="number" name="conta_juros">
		</div>
		<div class="registerAccountFild">
			 <label>CATEGORIA</label>
			 <select name="conta_categoria">
			 	<option value=""></option>
			 </select>
			 <span><i class="fa fa-plus-square fas-small" id="btnRegisterAccount" opt="categoria"></i></span>
		</div>
		<div class="registerAccountFild">
			 <label>TOTAL PARCELAS</label>
			 <input type="number" name="conta_total_parcela">
		</div>
		<div class="registerAccountFild">
			 <label>DT COMPRA</label>
			 <input type="date" name="conta_data">
		</div>
		<div class="registerAccountFild">
			<input type="submit" name="submit_register" value="Cadastrar">
		</div>
		</form>
	</div>
	<!-- <footer>
		<div class="footer_info">
			<div class="footer_info_dados">
				<p><span class="info_line">Developed by André Vitor</span></p>
			</div> 
		</div>
	</footer> -->
</body>
	<script type="text/javascript" src="js/easy-control-RegisterAccount.js"></script>
	<script type="text/javascript" src="js/easy-control.js"></script>
</html>
