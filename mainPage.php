<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name='viewport' content='width=device-width, initial-scale=1'>
	<title>Main Page EC</title>
	<link rel="stylesheet" type="text/css" href="css/easy-control.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	 <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script> -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

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



	<div class="containers">
			<div class="logo"></div>
		<div class="contas_dt_main">
			<div class="contas_dt_main_table">
				<div class="addNewDespesa">
					<span><i class="fa fa-plus-square fas-medium" data-toggle="modal" data-target="#exampleModal" id="btnRegister"></i></span>
				</div>
				<table class="table table-hover">
					<thead class="table-dark">
						<tr>
							<th>CONTA</th>
							<th>FORNECEDOR</th>
							<th>VALOR PARCELA</th>
							<th>Nº PARCELA</th>
							<th>DT VENCIMENTO</th>
							<th>JUROS</th>
							<th>DESCONTO</th>
							<th>DT PAGAMENTO</th>
							<th>STATUS</th>
							<th>AÇÕES</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
				<div class="pagination">
					<div class="pagination_left"><i class="fas fa-hand-point-right"></i></div>
					<div class="pagination_rigth"><i class="fas fa-hand-point-left"></i></div>
				</div>			
			</div>
			<div class="filter_actionShow"><span class="fas" name="btn_filterHidden">&#xf039;</span></div>
		<div class="filter_contas_dt_main hidden">
			<div class="filter_action"><span class="fas" name="btn_filterShow">&#xf039;</span></div>
			<div class="filter_main">
				<h2>FILTROS</h2>
				<div class="filter_main_single">
					<label>FORNECEDOR</label>
					<select name="FORNECEDOR">
						<option></option>
						<option>HAVAN</option>
					</select>
				</div>
				<div class="filter_main_single">
					<label>CARTÃO</label>
					<select name="CONTA">
						<option></option>
						<option>NUBAK</option>
						<option>TRIGG</option>
					</select>
				</div>
				<div class="filter_main_single">
					<label>DT VENCIMENTO</label>
					<input type="date" name="DT VENCIMENTO">
				</div>
				<div class="filter_main_single">
					<label>DT PAGAMENTO</label>
					<input type="date" name="DT PAGAMENTO">
				</div>
				<div class="filter_main_single">
					<label>STATUS</label>
					<select name="STATUS">
						<option></option>
						<option>PAGA</option>
						<option>EM ABERTO</option>
					</select>
				</div>
				<div class="filter_main_single">
					<input type="submit" name="filter_search" value="Filtrar">
				</div>
			</div>
		</div>
		</div>

	</div>

	<footer>
		<div class="footer_info">
			<div class="footer_info_dados">
				<p><span class="info_line">Developed by André Vitor</span></p>
			</div> 
		</div>
	</footer>
</body>
	<script type="text/javascript" src="js/easy-control.js"></script>
</html>

