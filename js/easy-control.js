
// alert("Hello World");

if(document.querySelector('[name=btn_filterShow]') != null){
	document.querySelector('[name=btn_filterShow]').addEventListener('click',actionFilter);
	document.querySelector('[name=btn_filterHidden]').addEventListener('click',actionFilter);
}
	
function actionFilter(){
	document.querySelector('.filter_contas_dt_main').classList.toggle('hidden');
	document.querySelector('.filter_actionShow').classList.toggle('hidden');
}
	
	function getModal(element){
		if(element == "tipo_pagamento"){
			$("#divModal").load("RegisterCartao.php");
		}else if(element == "fornecedor"){
			$("#divModal").load("RegisterFornecedor.php");
		}else if(element == "categoria"){
			$("#divModal").load("RegisterCategory.php");
		}
	}	

	document.querySelector('.close-modal-register').addEventListener('click',()=>{
		document.querySelector('.modalRegister').style.display = "none";
	})

	document.querySelectorAll("#btnRegisterAccount").forEach((result)=>{
		result.addEventListener("click",(element)=>{
			console.log(element.target.getAttribute('opt'));
			getModal(element.target.getAttribute('opt'));
			document.querySelector('.modalRegister').style.display = "inline-block";
		});
	});

	if(document.querySelector("#btnRegister") != null ){
		document.querySelector("#btnRegister").addEventListener('click',()=>{
			$("#divModal").load("MainRegisterAccountModal.php");
	});
	}


var lista;
	
function setLista(dados){
	// console.log(dados);
	lista = dados;
}

function getLista(){
	return lista;
}

if(document.querySelector('[name=filter_search]'))
{
	document.querySelector('[name=filter_search]').addEventListener("click", ()=>{
		var fildsFilter = [];
		var fildsValues = [];
		var listaFilds = ["FORNECEDOR","CONTA","DT VENCIMENTO","DT PAGAMENTO","STATUS"];
		for(var i = 0; i < listaFilds.length; i++){
			console.log(listaFilds[i]);
			if(document.querySelector(`[name="${listaFilds[i]}"]`).value != ""){
				fildsFilter.push(listaFilds[i]);
				fildsValues.push(document.querySelector(`[name="${listaFilds[i]}"]`).value);
			}
		}
		filter(fildsFilter, fildsValues);
	});

}

function dtDespensas(){
	document.querySelectorAll('#dtconta').forEach((singleElement)=>{
		singleElement.style.cursor = "pointer";
		singleElement.style.color = "#f00";
		singleElement.addEventListener('click',(element)=>{
			console.log(element.target.getAttribute('idConta'));
			$("#divModal").load("RegisterCategory.php");

		});
	});

}

function filter(paramKeys, paramValues){
	let listaFilter = [];

	// console.log(paramKeys);
	// console.log(paramValues);
	var indice = 0;
	Object.keys(getLista()).forEach((result)=>{
			var countParam = 0;
			paramKeys.forEach((paramResult)=>{
					console.log(result + paramResult + paramValues[paramKeys.indexOf(paramResult)] + indice);
				if(getLista()[result][paramResult] == paramValues[paramKeys.indexOf(paramResult)]){
					console.log("somou");
					countParam++;
				}

				if(paramResult == "STATUS" && paramValues[paramKeys.indexOf(paramResult)] == "PAGA"){
					if(getLista()[result]["DT PAGAMENTO"] != undefined){	
						countParam++;
						console.log("Entrouuu" + getLista()[result][paramResult]);
					}
				}else if(paramResult == "STATUS" && paramValues[paramKeys.indexOf(paramResult)] == "EM ABERTO"){
					if(getLista()[result]["DT PAGAMENTO"] == undefined){
						countParam++;
					}
				}
			}); 
			if(countParam == paramKeys.length){
				listaFilter.push(getLista()[result]);
			}
			countParam = 0;
	});	
	console.log(listaFilter);
	if(listaFilter.length <= 0){
		clearTable();
	}else{
		filterData(listaFilter);
	}
}
	
	function clearTable(){
		document.querySelectorAll('tbody > tr').forEach(
			(linha)=>{
				linha.remove()
			});
	}

	$.ajax({
		url: '../api/listDespesas.api.php',
		method: 'GET',
		dataType: 'json'
	}).done(function(result){
		setLista(result);
		// console.log(result);
		let total = 0;
		let juros = 0;
		let desconto = 0;
		linha = 1;
		result.forEach((res)=>{
		total = eval(parseFloat(res["VALOR PARCELA"]) + total);
		juros = eval(parseFloat(res["JUROS"] ?? 0) + juros);
		desconto = eval(parseFloat(res["DESCONTO"] ?? 0) + desconto);
		if(res['DT PAGAMENTO']){
		var valores = 
		`
		<tr>
		<td id="dtconta" idConta="${res['ID CONTA']}" data-toggle="modal" data-target="#exampleModal">${res['CONTA'] ?? 0}</td>
		<td>${res['FORNECEDOR']}</td>
		<td>${res['VALOR PARCELA']}</td>
		<td>${res['Nª PARCELA']}/${res['TOTAL PARCELA']}</td>
		<td>${res['DT VENCIMENTO']}</td>
		<td>${res['JUROS'] ?? "0.00"}</td>
		<td>${res['DESCONTO'] ?? "0.00"}</td>
		<td>${res['DT PAGAMENTO'] ?? ""}</td>
		<td><span name="pagamento_aprovado">PAGO</span></td>
		<td><a href="?"><button class="btn_action" name="reativar_pagamento">REATIVAR</button></a></td>
		</tr>
		`
	}else{
		var valores = 
		`
		<tr>
		<td id="dtconta" idConta="${res['ID CONTA']}" data-toggle="modal" data-target="#exampleModal">${res['CONTA'] ?? 0}</td>
		<td>${res['FORNECEDOR']}</td>
		<td>${res['VALOR PARCELA']}</td>
		<td>${res['Nª PARCELA']}/${res['TOTAL PARCELA']}</td>
		<td>${res['DT VENCIMENTO']}</td>
		<td>${res['JUROS'] ?? "0.00"}</td>
		<td>${res['DESCONTO'] ?? "0.00"}</td>
		<td>${res['DT PAGAMENTO'] ?? ""}</td>
		<td><span name="pagamento_pendente">ABERTO</span></td>
		<td><a href="?"><button class="btn_action" name="realizar_pagamento">PAGAR</button></a></td>
		</tr>
		`
		}
		
		document.querySelector('tbody').innerHTML += valores;
		});
		var valores = 
		`
		<tr>
		<td class="total_general">TOTAL GERAL</td>
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
		dtDespensas();
	});

	function filterData(newFilter){
		clearTable();
		let total = 0;
		let juros = 0;
		let desconto = 0;

		newFilter.forEach((res)=>{
		total = eval(parseFloat(res["VALOR PARCELA"]) + total);
		juros = eval(parseFloat(res["JUROS"] ?? 0) + juros);
		desconto = eval(parseFloat(res["DESCONTO"] ?? 0) + desconto);
		if(res['DT PAGAMENTO']){
		var valores = 
		`
		<tr>
		<td id="dtconta">${res['CONTA'] ?? 0}</td>
		<td>${res['FORNECEDOR']}</td>
		<td>${res['VALOR PARCELA']}</td>
		<td>${res['Nª PARCELA']}/${res['TOTAL PARCELA']}</td>
		<td>${res['DT VENCIMENTO']}</td>
		<td>${res['JUROS'] ?? "0.00"}</td>
		<td>${res['DESCONTO'] ?? "0.00"}</td>
		<td>${res['DT PAGAMENTO'] ?? ""}</td>
		<td><span name="pagamento_aprovado">PAGO</span></td>
		<td><a href="?"><button class="btn_action" name="reativar_pagamento">REATIVAR</button></a></td>
		</tr>
		`
	}else{
		var valores = 
		`
		<tr>
		<td id="dtconta">${res['CONTA'] ?? 0}</td>
		<td>${res['FORNECEDOR']}</td>
		<td>${res['VALOR PARCELA']}</td>
		<td>${res['Nª PARCELA']}/${res['TOTAL PARCELA']}</td>
		<td>${res['DT VENCIMENTO']}</td>
		<td>${res['JUROS'] ?? "0.00"}</td>
		<td>${res['DESCONTO'] ?? "0.00"}</td>
		<td>${res['DT PAGAMENTO'] ?? ""}</td>
		<td><span name="pagamento_pendente">ABERTO</span></td>
		<td><a href="?"><button class="btn_action" name="realizar_pagamento">PAGAR</button></a></td>
		</tr>
		`
		}
		
		document.querySelector('tbody').innerHTML += valores;
		});
		var valores = 
		`
		<tr>
		<td class="total_general">TOTAL GERAL</td>
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
		console.log("aquii");
	}

