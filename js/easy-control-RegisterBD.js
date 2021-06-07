alert('Óla mundo');

if(document.querySelector('[name=conta_acao]')){
	document.querySelector('[name=conta_acao]').addEventListener('click',(element)=>{
		element.preventDefault();
		fetch(`api/addCategory.php?categoria_descricao=teste`);
		
	});
}