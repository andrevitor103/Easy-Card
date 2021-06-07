window.onload = filterTable();

	document.querySelector('#btnFilter').addEventListener('click',()=>{
		document.querySelector('.filters').classList.toggle('hidden');
	});

	document.querySelector('#btnRegister').addEventListener('click',()=>{
		$("#informations_register").load("mainRegisterAccountModal.php");	
	});

	document.querySelector('[name=filtrar]').addEventListener('click',()=>{
		filterTable();
		document.querySelector('.filters').classList.toggle('hidden');
	});


function filterTable(){
	if(document.querySelector('tbody')){
	document.querySelector('tbody').innerHTML = '';
	let filters = [];
	let filds = [
	{ 
		'campo': 'filterFornecedor',
		'campoBD': 'ID_FORNECEDOR',
		'operacao': '='
	},
	{
		'campo': 'filterFormaPagamento',
		'campoBD': 'ID_FORMA_PAGAMENTO',
		'operacao': '='
	},
	{
		'campo': 'dataInicioVencimento',
		'campoBD': '`DT VENCIMENTO`',
		'operacao': '>='
	},
	{
		'campo': 'dataFinalVencimento',
		'campoBD': '`DT VENCIMENTO`',
		'operacao': '<='
	},
	{
		'campo': 'dataInicioPagamento',
		'campoBD': '`DT PAGAMENTO`',
		'operacao': '>='
	},
	{
		'campo': 'dataFinalPagamento',
		'campoBD': '`DT PAGAMENTO`',
		'operacao': '<='
	},
	{
		'campo': 'filterStatus',
		'campoBD': 'STATUS',
		'operacao': '='
	}
	];


	filds.forEach((fild)=>{
		console.log(document.querySelector(`[name=${fild.campo}]`)?.value);
		document.querySelector(`[name=${fild.campo}]`)?.value?filters.push({'campo': document.querySelector(`[name=${fild.campo}]`)?.value, 'campoBD': `${fild.campoBD}`, 'operacao': `${fild.operacao}`}):'';
	});

	console.log(filters);

	let strFilter = "";
	let i = 0;

	filters.forEach((itensFilter)=>{

		if(strFilter != "" && i < filters.length){
			strFilter += "AND "; 
		}
		strFilter += `${itensFilter.campoBD} ${itensFilter.operacao} '${itensFilter.campo}'`;
		i++;
	});

	console.log(strFilter);
	console.log(`api/listDespesas.api.php?filters=${strFilter}`);

	$.ajax({
		url: strFilter ? `api/listDespesas.api.php?filters=${strFilter}`: 'api/listDespesas.api.php',
		method: 'GET',
		dataType: 'json'
	}).done(function(result){
		// setLista(result);
		console.log(result);
		let total = 0;
		let juros = 0;
		let desconto = 0;
		linha = 1;
		result.forEach((res)=>{
		total = eval(parseFloat(res["VALOR PARCELA FINAL"]) + total);
		juros = eval(parseFloat(res["JUROS"] ?? 0) + juros);
		desconto = eval(parseFloat(res["DESCONTO"] ?? 0) + desconto);
		if(res['DT PAGAMENTO']){
		var valores = 
		`
		<tr>
		<td id="dtconta" idConta="${res['ID']}" data-toggle="modal" data-target="#exampleModal">${res['CONTA'] ?? 0}</td>
		<td>${res['FORNECEDOR']}</td>
		<td>${res['VALOR PARCELA FINAL']}</td>
		<td>${res['Nª PARCELA']}/${res['TOTAL PARCELA']}</td>
		<td>${res['DT VENCIMENTO']}</td>
		<td>${res['JUROS'] ?? "0.00"}</td>
		<td>${res['DESCONTO'] ?? "0.00"}</td>
		<td>${res['DT PAGAMENTO'] ?? ""}</td>
		<td><span name="pagamento_aprovado">PAGO</span></td>
		<td><button class="btn_action" name="reativar_pagamento" opt="${res['ID']}">REATIVAR</button></td>
		</tr>
		`
	}else{
		var valores = 
		`
		<tr>
		<td id="dtconta" idConta="${res['ID']}" data-toggle="modal" data-target="#exampleModal">${res['CONTA'] ?? 0}</td>
		<td>${res['FORNECEDOR']}</td>
		<td>${res['VALOR PARCELA FINAL']}</td>
		<td>${res['Nª PARCELA']}/${res['TOTAL PARCELA']}</td>
		<td>${res['DT VENCIMENTO']}</td>
		<td>${res['JUROS'] ?? "0.00"}</td>
		<td>${res['DESCONTO'] ?? "0.00"}</td>
		<td>${res['DT PAGAMENTO'] ?? ""}</td>
		<td><span name="pagamento_pendente">ABERTO</span></td>
		<td><button class="btn_action" name="realizar_pagamento" opt="${res['ID']}">PAGAR</button></td>
		</tr>
		`
		}
		
		document.querySelector('tbody').innerHTML += valores;
		});
		var valores = 
		`
		<tr>
		<td id="dt_conta" class="total_general">TOTAL GERAL</td>
		<td></td>
		<td class="total_general_values">R$ ${total.toFixed(2)}</td>
		<td></td>
		<td></td>
		<td class="total_general_values juro">R$ ${juros.toFixed(2)}</td>
		<td class="total_general_values desconto">R$ ${desconto.toFixed(2)}</td>
		<td></td>
		<td></td>
		<td></td>
		</tr>
		`;
		totalizarTable(valores);
		addActionsButtons();
	});
		
	}
}

function totalizarTable(valores = null){
	document.querySelector('tbody').innerHTML += valores;
}

function addActionsButtons(){
	if(document.querySelector('[name=realizar_pagamento')){
		document.querySelectorAll('[name=realizar_pagamento').forEach((itens)=>{
			itens.addEventListener('click',(element)=>{
			pagarDespesa(element.target.getAttribute('opt'));
			element.target.parentElement.parentElement.style.display = "none";
			// filterTable();
		});
		});
	}
	if(document.querySelector('[name=reativar_pagamento')){
		document.querySelectorAll('[name=reativar_pagamento').forEach((itens)=>{
			itens.addEventListener('click',(element)=>{
			pagarDespesa(element.target.getAttribute('opt'));
			element.target.parentElement.parentElement.style.display = "none";
			// filterTable();
		});
		})
	}
	if(document.querySelector('#dtconta')){
		document.querySelectorAll('#dtconta').forEach((itens)=>{
			itens.style.cursor = "pointer";
			itens.addEventListener('click',(element)=>{
			console.log(element.target);
			console.log(element.target.getAttribute('idConta'));
			detalheDespesa(element.target.getAttribute('idConta'));
		});
		})
	}
}

function pagarDespesa(id = null){
	fetch(`api/updateDespesaDt.api.php?id=${id}&pagarDespesa=true`)
	.then(result => console.log('Conta paga' + id))
}

function EditarDespesa(){
	let conta = document.querySelector('[name=dt_conta_edit]').value;
	let fornecedor = document.querySelector('[name=dt_fornecedor_edit]').value;
	let valorParcela = document.querySelector('[name=dt_valorParcela_edit]').value;
	let dataVencimento = document.querySelector('[name=dt_dataVencimento_edit]').value;
	let dataPagamento = document.querySelector('[name=dt_dataPagamento_edit]').value;
	let juros = document.querySelector('[name=dt_juros_edit]').value;
	let desconto = document.querySelector('[name=dt_desconto_edit]').value;
	id = getInfoDt()[0]['ID'];
	idDespesa = getInfoDt()[0]['ID_DESPESA'];

	fetch(`
		api/updateDespesaDt.api.php?id=${id}&idDespesa=${idDespesa}&conta=${conta}&fornecedor=${fornecedor}&
		valorParcela=${valorParcela}&dataVencimento=${dataVencimento}&dataPagamento=${dataPagamento}&
		juros=${juros}&desconto=${desconto}
		`)
	.then(result => console.log(result))
}


function detalheDespesa(id = null){
	$("#despesaDetalhes").load(`despesaDt.php?action=editDespesa(${id})`);
	editDespesa(id);
}


if(document.querySelector('#btnRefresh')){
	document.querySelector('#btnRefresh').addEventListener('click', ()=>{
		filterTable();
	});
}

/* Detalhes */



function editDespesa(id = null){
	// alert("oks");
$.ajax({
	url: `api/listDespesas.api.php?id=${id}`,
	method: 'GET',
	dataType: 'json'
}).done((result)=>{
	console.log(result);
	
	infoDt(result);

	document.querySelector('.modalCriarConta').style.display = "inline-block";
	if(document.querySelector('[name=btnFecharModal]')){
		document.querySelector('[name=btnFecharModal]').addEventListener('click', ()=>{
			document.querySelector('.modalCriarConta').style.display = "none";
		});
	}

	initEdit();

	loadSelect('dt_fornecedor_edit');
	loadSelect('dt_conta_edit');

	var lista = "";
	result.forEach((result)=>{
		console.log(result);
		document.querySelector('[name=dt_conta]').innerHTML = result["CONTA"];
		document.querySelector('[name=dt_fornecedor]').innerHTML = result["FORNECEDOR"];
		document.querySelector('[name=dt_valorParcela]').innerHTML = result["VALOR PARCELA"];
		document.querySelector('[name=dt_numeroParcela]').innerHTML = `${result["Nª PARCELA"]} / ${result["TOTAL PARCELA"]}`;
		document.querySelector('[name=dt_dataVencimento]').innerHTML = result["DT VENCIMENTO"];
		document.querySelector('[name=dt_juros]').innerHTML = result["JUROS"] ?? "0.00";
		document.querySelector('[name=dt_desconto]').innerHTML = result["DESCONTO"] ?? "0.00";
		document.querySelector('[name=dt_dataPagamento]').innerHTML = result["DT PAGAMENTO"];
		if(result['STATUS'] == "1"){
			document.querySelector('[name=dt_status]').innerHTML = "EM ABERTO";
		}else{
			document.querySelector('[name=dt_status]').innerHTML = "PAGO";
		}

		document.querySelector('[name=dt_conta_edit]').value = result["CONTA"];
		document.querySelector('[name=dt_fornecedor_edit]').value = result["FORNECEDOR"];
		document.querySelector('[name=dt_valorParcela_edit]').value = result["VALOR PARCELA"];
		document.querySelector('[name=dt_numeroParcela_edit]').innerHTML = `${result["Nª PARCELA"]} / ${result["TOTAL PARCELA"]}`;
		document.querySelector('[name=dt_dataVencimento_edit]').value = result["DT VENCIMENTO"];
		document.querySelector('[name=dt_juros_edit]').value = result["JUROS"] ?? "0.00";
		document.querySelector('[name=dt_desconto_edit]').value = result["DESCONTO"] ?? "0.00";
		document.querySelector('[name=dt_dataPagamento_edit]').value = result["DT PAGAMENTO"];
		if(result['STATUS'] == "1"){
			document.querySelector('[name=dt_status_edit]').innerHTML = "EM ABERTO";
		}else{
			document.querySelector('[name=dt_status_edit]').innerHTML = "PAGO";
		}
	});
});


}

function habilitarEdit(){
		document.querySelector('.dt_view').classList.toggle('hidden');
		document.querySelector('.dt_edit').classList.toggle('hidden');
		filterSelectDetalhes();
		document.querySelector('.dt_btn_edit').addEventListener('click',()=>{
			EditarDespesa();
			filterTable();
		});
}

	var datas;
function infoDt(data = null){
	datas = data;
}

function getInfoDt(){
	return datas;
}

function filterSelectDetalhes(){
	var dados = getInfoDt();
	document.querySelector('[name=dt_fornecedor_edit]').value = dados[0]["ID_FORNECEDOR"];
	document.querySelector('[name=dt_conta_edit]').value = dados[0]["ID_FORMA_PAGAMENTO"];
}

function initEdit(){
	if(document.querySelector('.dt_btn_view')){
		document.querySelector('.dt_btn_view').addEventListener('click',()=>{
		habilitarEdit();
	});
}
}

