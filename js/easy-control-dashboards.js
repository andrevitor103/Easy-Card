window.onload = showData();

document.querySelector('#btnFilter').addEventListener('click',()=>{
		document.querySelector('.filters').classList.toggle('hidden');
		document.querySelector('.filters').classList.toggle('hidden');
});


document.querySelector('[name=filtrar]').addEventListener('click',()=>{
		filterData();
		document.querySelector('.filters').classList.toggle('hidden');
		document.querySelector('.filters').classList.toggle('hidden');
});

if(document.querySelector('#btnRefresh')){
	document.querySelector('#btnRefresh').addEventListener('click', ()=>{
		showData();
	});
}


function filterData(){
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
	showData(strFilter);
}


function showData(filters = []){
	let api;
	if(filters.length > 0){
		api = `api/listDespesasDashboard.api.php?filters=${filters}`;
	}else{
		api = 'api/listDespesasDashboard.api.php';
	}
	$.ajax({
		url: api,
		method: 'GET',
		dataType: 'json'
	}).done(function(result){
		console.log(result);
		showDashboard(result);
		valores = result;
		// alimentarArrayFiltro();
	});
	let apiTwo;
	if(filters.length > 0){
		apiTwo = `api/listDespesasDashboardCategoria.api.php?filters=${filters}`;
	}else{
		apiTwo = 'api/listDespesasDashboardCategoria.api.php';
	}

	$.ajax({
		url: apiTwo,
		method: 'GET',
		dataType: 'json'
	}).done(function(result){
		console.log(result);
		showDashboardCategoria(result);
		valores = result;
	});

function showDashboard(value = null){
	let meses = ['x'];
	let totalCompra = ['TOTAL GASTOS'];
	let saldoDisponivel = ['SALDO DISPONIVEL'];
	let linha = [];

	for(var i = 0; i < value.length; i++){
		meses.push(value[i]['CONTA']);
		totalCompra.push(value[i]['TOTAL COMPRA']);
		saldoDisponivel.push(value[i]['SALDO DISPONIVEL']);
	}

	for(var i = 0; i < meses.length; i++){
		console.log(meses[i], saldoDisponivel[i], totalCompra[i]);
		linha.push([meses[i], saldoDisponivel[i], totalCompra[i]]);
	}
	// console.log(linha);
	console.log(totalCompra);
	var chart = c3.generate({
    	bindto: '#dashCartao',
    	data: {
    		x: 'x',
    		columns:[
        		meses,
        		saldoDisponivel,
        		totalCompra
        		],
        		groups: [
        		['TOTAL GASTOS', 'SALDO DISPONIVEL']
        		],
        	type : 'bar',
        	labels: true
    },
    	axis: {
        x: {
            type: 'category'
        }
    },
    grid: {
        y: {
            lines: [{value: 0}]
        }
    }
});	
}

function showDashboardCategoria(value = null){
	let meses = [];
	let totalCompra = [];
	let linha = [];

	for(var i = 0; i < value.length; i++){
		meses.push(value[i]['CATEGORIAS']);
		totalCompra.push(value[i]['TOTAL COMPRA']);
	}

	for(var i = 0; i < meses.length; i++){
		console.log(meses[i], totalCompra[i]);
		linha.push([meses[i], totalCompra[i]]);
	}
	console.log(linha);
	var chart = c3.generate({
    	bindto: '#dashCategoria',
    	data: {
    		columns: 
        		linha,
        	type : 'pie',
        	labels: true
    }
});	
}

}

