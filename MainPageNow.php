<?php
	
	session_start();

	include 'pages/header.php';
	
	if(!isset($_SESSION['id_user'])){
		header('location: EClogin.php');
	}
?>

<div class="containers">
	<div class="modalCriarConta">
      		<div className="close-modal-criar"></div>
      		<div id="despesaDetalhes">
      		</div>      	
     </div>


	<div class="filters hidden">
		<div class="filter_group">
			<div class="filter_fild">
				<label>FORNECEDOR</label>
				<select name="filterFornecedor">
					<option value=""></option>
				</select>
			</div>
			<div class="filter_fild">
				<label>FORMA PAGAMENTO</label>
				<select name="filterFormaPagamento">
					<option value=""></option>
				</select>
			</div>
			<div class="filter_fild">
				<label>STATUS</label>
				<select name="filterStatus">
					<option></option>
					<option value="0">PAGA</option>
					<option value="1">EM ABERTO</option>
				</select>
			</div>
			<div class="filter_fild">
				<label class="labelInline">PERÍODO VENCIMENTO</label>
				<input type="date" name="dataInicioVencimento"> até <input type="date" name="dataFinalVencimento">
			</div>
			<div class="filter_fild">
				<label class="labelInline">PERÍODO PAGAMENTO</label>
				<input type="date" name="dataInicioPagamento"> até <input type="date" name="dataFinalPagamento">
			</div>
			<div class="filter_fild">
				<input type="submit" name="filtrar" value="Filtrar">
			</div>
		</div>
	</div>
		<div class="options_actions">
		
		<div class="options_actions_single"><i class="fas fa-external-link-alt fas-medium" id="btnFilter"></i></div>

		<div class="options_actions_single"><i class="fas fa-plus-square fas-medium" data-toggle="modal" data-target="#exampleModal" id="btnRegister"></i></div>

		<div class="options_actions_single"><i class="fas fa-sync fas-medium" id="btnRefresh"></i></div>

		
		</div>
		<div class="contas_dt_main_table">
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
</div>

<!-- <footer>
	
</footer> -->

</body>

<script type="text/javascript" src="js/easy-control-new.js"></script>
<script type="text/javascript" src="js/easy-control-RegisterAccount.js"></script>

</html>


