
document.querySelector('[name=documento_fornecedor]').addEventListener('blur', (element)=>{
	// console.log(element.target.value);
	var documento = element.target.value.replaceAll('.',"").replaceAll('/',"").replaceAll('-',"")
	console.log(documento);
	fetch(`https://brasilapi.com.br/api/cnpj/v1/${documento}`)
	.then(response => response.json())
	.then(dados	=>{
		if(dados.razao_social){
			document.querySelector('[name=razao_social]').value = dados.razao_social;
		}
	});
});