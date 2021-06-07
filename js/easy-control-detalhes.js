if(document.querySelector('[name=despesa_deletar]')){
	document.querySelectorAll('[name=despesa_deletar]').forEach((element)=>{
		element.addEventListener('click',()=>{
			let idDespesa = element.getAttribute('id_conta');
			console.log(`Deletar ${element.getAttribute('id_conta')}`);
			fetch(`./api/deleteDespesa.api.php?id=${idDespesa}`)
			.then(()=>{
				alert("Deletado com sucesso");
				location.reload();
			});
		})
	})
}


