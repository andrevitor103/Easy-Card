<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name='viewport' content='width=device-width, initial-scale=1'>
	<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	 <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script> -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<title>Main Page EC</title>
	<link rel="stylesheet" type="text/css" href="css/easy-control.css">
	<link rel="stylesheet" type="text/css" href="css/easy-control-registers.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

</head>

<body>

		<!-- Modal -->

<div class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ADD ACCOUNT</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<div id="divModal"></div>
      </div>
    </div>
  </div>
</div>

	<!-- Fim modal -->

	<div class="registerAccount">
		<div class="registerAccountFild">
			 <label>TIPO PAGAMENTO</label>
			 <input type="text" name="conta_tipo_pagamento">
		</div>
		<div class="registerAccountFild">
			 <label>FORNECEDOR</label>
			 <input type="text" name="conta_fornecedor">
		</div>
		<div class="registerAccountFild">
			 <label>VALOR</label>
			 <input type="text" name="conta_valor">
		</div>
		<div class="registerAccountFild">
			 <label>DESCONTO</label>
			 <input type="text" name="conta_desconto">
		</div>
		<div class="registerAccountFild">
			 <label>JUROS P/MÊS</label>
			 <input type="text" name="conta_juros">
		</div>
		<div class="registerAccountFild">
			 <label>CATEGORIA</label>
			 <input type="text" name="conta_categoria">
		</div>
		<div class="registerAccountFild">
			 <label>TOTAL PARCELAS</label>
			 <input type="text" name="conta_total_parcela">
		</div>
		<div class="registerAccountFild">
			 <label>DT COMPRA</label>
			 <input type="text" name="conta_data">
		</div>
		<div class="registerAccountFild">
			<input type="submit" name="conta_acao" value="Cadastrar">
		</div>
	</div>
</body>
	<script type="text/javascript" src="js/easy-control.js"></script>

</html>


