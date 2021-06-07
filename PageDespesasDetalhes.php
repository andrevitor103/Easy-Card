<?php
	
	session_start();

	include 'pages/header.php';

	include 'Config.php';
	include 'Despesa.class.php';
	$despesas = new Despesa($pdo);
	$despesas = $despesas->select(null, $_SESSION['id_user']);

	if(!isset($_SESSION['id_user'])){
		header('location: EClogin.php');
	}
?>


<div class="contas_dt_main_table">
				<table class="table table-hover">
					<thead class="table-dark">
						<tr>
							<th>CÓDIGO</th>
							<th>VALOR DESPESA</th>
							<th>TOTAL PARCELAS</th>
							<th>FORNECEDOR</th>
							<th>CARTÃO</th>
							<th>AÇÕES</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($despesas as $despesa): ?>
						<tr>
							<td><?php echo $despesa['ID']?></td>
							<td>R$ <?php echo $despesa['VALOR_DESPESA'] ?></td>
							<td><?php echo $despesa['TOTAL_PARCELAS'] ?></td>
							<td><?php echo $despesa['FORNECEDOR'] ?></td>
							<td><?php echo $despesa['CARTAO'] ?></td>
							<td><button class="btn_action" name="despesa_deletar" id_conta="<?php echo $despesa['ID'] ?>"><i class="fas fa-trash-alt"></i></button></td>
						</tr>
						<?php endForeach; ?>
					</tbody>
				</table>
				<div class="pagination">
					<div class="pagination_left"><i class="fas fa-hand-point-right"></i></div>
					<div class="pagination_rigth"><i class="fas fa-hand-point-left"></i></div>
				</div>			
			</div>
</div>

</body>
<script type="text/javascript" src="js/easy-control-detalhes.js"></script>
