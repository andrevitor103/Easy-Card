	window.onload = onloadData();


	function onloadData(){
		loadSelect('conta_tipo_pagamento');
		loadSelect('conta_fornecedor');
		loadSelect('conta_categoria');
		loadSelect('filterFornecedor');
		loadSelect('filterFormaPagamento');
	}

	function clearSelect(name = null){
		document.querySelectorAll(`[name=${name}] > option`).forEach(res => res.remove());
	}

	function loadSelect(name = null){
		if( document.querySelector(`[name=${name}]`)){
			let campoFiltrar = document.querySelector(`[name=${name}]`).value;
		}
		clearSelect(name);


		let rotaSearch = null;
		let value = null;
		let label = null;

		let rotas = [
		{
			'name': 'conta_tipo_pagamento',
			'rota': 'api/listTipoPagamento',
			'value': 'ID',
			'label': 'DESCRICAO'
		},
		{
			'name': 'conta_fornecedor',
			'rota': 'api/listFornecedor',
			'value': 'ID',
			'label': 'RAZAO_SOCIAL'
	 	},
		{
			'name': 'conta_categoria',
			'rota': 'api/listCategoria',
			'value': 'ID',
			'label': 'DESCRICAO'
		},
		{
			'name': 'filterFornecedor',
			'rota': 'api/listFornecedor',
			'value': 'ID',
			'label': 'RAZAO_SOCIAL'
		},
		{
			'name': 'filterFormaPagamento',
			'rota': 'api/listTipoPagamento',
			'value': 'ID',
			'label': 'DESCRICAO'
		},
		{
			'name': 'dt_fornecedor_edit',
			'rota': 'api/listFornecedor',
			'value': 'ID',
			'label': 'RAZAO_SOCIAL'
	 	},
	 	{
			'name': 'dt_conta_edit',
			'rota': 'api/listTipoPagamento',
			'value': 'ID',
			'label': 'DESCRICAO'
	 	}
		];

		rotas.forEach((rota)=>{
			if(rota.name == name){
				rotaSearch = rota.rota;
				value = rota.value;
				label = rota.label;
			}
		});
		
		// alert(rotaSearch);
		// console.log(value + label + rotaSearch + name);

		if(name && rotaSearch){ 
		if(document.querySelector(`[name=${name}]`)){

		fetch(`${rotaSearch}.api.php`)
		.then(response=>response.json())
		.then(resultado => {
			// console.log(resultado);
			resultado.forEach((result) => {
				let chave = result[`${value}`];
				let valor = result[`${label}`];
				// console.log(chave + valor);
				document.querySelector(`[name=${name}]`).innerHTML += `<option value=${chave}>${valor}</option>`;
			});
			// console.log(document.querySelector(`[name=${name}]`).value = campoFiltrar);
		});
		document.querySelector(`[name=${name}]`).innerHTML += `<option value=''></option>`;
		// console.log(document.querySelector(`[name=${name}]`));
		// console.log(campoFiltrar);
	}
		}
	}



/*

* Registros

*/

	if(document.querySelector('[name=categoria_acao]')){
		let categoriaDescricao = document.querySelector('[name=categoria_descricao]');
		document.querySelector('[name=categoria_acao]').addEventListener('click',(element)=>{
			element.preventDefault();
			
			document.querySelector('[name=categoria_acao]').disabled = true;
			this.alterStyleBtn('categoria_acao', 'red');

			fetch(`api/addCategory.php?categoria_descricao=${categoriaDescricao.value}`)
			.then(()=> onloadData('conta_categoria'))
			.then(() => {
				this.msgBox('Cadastrado com sucesso');
				document.querySelector('[name=categoria_acao]').disabled = false;
				this.alterStyleBtn('categoria_acao', null);
			})
			.catch(() => {
				document.querySelector('[name=categoria_acao]').disabled = false;
				this.alterStyleBtn('categoria_acao', null);
			});
		});
	}


	if(document.querySelector('[name=fornecedor_acao]')){
		document.querySelector('[name=fornecedor_acao]').addEventListener('click',(element)=>{
			element.preventDefault();
		
			let documento = document.querySelector('[name=documento_fornecedor]');
			let razaoSocial = document.querySelector('[name=razao_social]');

			document.querySelector('[name=fornecedor_acao]').disabled = true;
			this.alterStyleBtn('fornecedor_acao', 'red');

			fetch(`api/RegisterFornecedor.api.php?documento_fornecedor=${documento.value}&razao_social=${razaoSocial.value}`)
			.then(() => onloadData('conta_fornecedor'))
			.then(() => {
				this.msgBox('Cadastrado com sucesso');
				document.querySelector('[name=fornecedor_acao]').disabled = false;
				this.alterStyleBtn('fornecedor_acao', null);
			})
			.catch(() => {
				document.querySelector('[name=fornecedor_acao]').disabled = false;
				this.alterStyleBtn('fornecedor_acao', null);
			});
		});
	}

	if(document.querySelector('[name=cartao_acao]')){
		document.querySelector('[name=cartao_acao]').addEventListener('click',(element)=>{
			element.preventDefault();
		
			let descricao = document.querySelector('[name=cartao_descricao]');
			let limite = document.querySelector('[name=cartao_limite]');
			let vencimento = document.querySelector('[name=data_vencimento]');
			console.log(vencimento.value);

			document.querySelector('[name=cartao_acao]').disabled = true;
			this.alterStyleBtn('cartao_acao', 'red');
			
			fetch(`api/addCartao.php?cartao_descricao=${descricao.value}&cartao_limite=${limite.value}&data_vencimento=${vencimento.value}`)
			.then(() => onloadData('conta_tipo_pagamento'))
			.then(() => {
				this.msgBox('Cadastrado com sucesso');
				document.querySelector('[name=cartao_acao]').disabled = false;
				this.alterStyleBtn('cartao_acao', null);
			})
			.catch(() => {
				document.querySelector('[name=cartao_acao]').disabled = false;
				this.alterStyleBtn('cartao_acao', null);
			});
		});
	}

	if(document.querySelector('[name=formRegister]')){
		document.querySelector('[name=formRegister]').addEventListener('submit', (element) => {
			element.preventDefault();
		})
	}
	if(document.querySelector('[name=formRegister]')){
		
		document.querySelector('[name=formRegister]').addEventListener('submit',(element)=>{
			
			element.preventDefault();
			let tipoPagamento = document.querySelector('[name=conta_tipo_pagamento]');
			let contaFornecedor = document.querySelector('[name=conta_fornecedor]');
			let contaValor = document.querySelector('[name=conta_valor]');
			let contaDesconto = document.querySelector('[name=conta_desconto]');
			let contaJuros = document.querySelector('[name=conta_juros]');
			let contaCategoria = document.querySelector('[name=conta_categoria]');
			let contaTotalParcela = document.querySelector('[name=conta_total_parcela]');
			let contaData = document.querySelector('[name=conta_data]');

			document.querySelector('[name=submit_register]').disabled = true;
			this.alterStyleBtn('submit_register', 'red');

			fetch(`
				api/RegisterAccount.api.php?conta_tipo_pagamento=${tipoPagamento.value}&conta_fornecedor=${contaFornecedor.value}
				&conta_valor=${contaValor.value}&conta_desconto=${contaDesconto.value}&conta_juros=${contaJuros.value}&conta_categoria=${contaCategoria.value}
				&conta_total_parcela=${contaTotalParcela.value}&conta_data=${contaData.value}`)
			.then(response => response.json())
			.then((result) => {
				if(result == "ok"){
					this.msgBox('Cadastrado com sucesso');
					document.querySelector('[name=submit_register]').disabled = false;
					this.alterStyleBtn('submit_register', null);
					document.querySelector('[name=conta_tipo_pagamento]').value = "";
				 	document.querySelector('[name=conta_fornecedor]').value = "";
				 	document.querySelector('[name=conta_valor]').value = "";
					document.querySelector('[name=conta_desconto]').value = "";
					document.querySelector('[name=conta_juros]').value = "";
					document.querySelector('[name=conta_categoria]').value = "";
					document.querySelector('[name=conta_total_parcela]').value = "";
					document.querySelector('[name=conta_data]').value = "";
				}else{
					alert("Erro ao cadastrar, favor verificar os dados");
					document.querySelector('[name=submit_register]').disabled = false;
					this.alterStyleBtn('submit_register', null);
				}

			})
			.catch(() => {
				document.querySelector('[name=submit_register]').disabled = false;
				this.alterStyleBtn('submit_register', null);
			});
		});
	}


	function msgBox(msg){
		alert(`${msg}`);
	}

	function alterStyleBtn(name, color){
		document.querySelector(`[name=${name}]`).style.backgroundColor = color;
	}

