// let params = (new URL(document.location.href)).searchParams;

// // alert(params);
// let action = params.get("action");
// console.log(action);
// eval(action);

// window.onload = editDespesa(1);




function editDespesa(id = null){
	alert("ok");
$.ajax({
	url: `api/listDespesas.api.php?id=${id}`,
	method: 'GET',
	dataType: 'json'
}).done((result)=>{
	console.log(result);
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
		if(result['STATUS'] == "0"){
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
}

document.querySelector('.dt_btn_view').addEventListener('click',()=>{
	habilitarEdit();
});