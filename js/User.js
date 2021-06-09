// alert("Usuarios");
	
	document.querySelector('[name=login_acao]').addEventListener('click',()=>{
		let username = document.querySelector('[name=login_user]');
		let password = document.querySelector('[name=login_password]');
		fetch(`../api/validUser.api.php?USERNAME=${username.value}&PASSWORD=${password.value}`)
		.then(response => response.json())
		.then((resposta) =>{
			console.log(resposta["username"]);
			if(resposta["username"] != undefined){
				window.location.href = "MainPageNow.php";
			}else{
				alert("Usuário ou senha inválido");
				document.querySelectorAll('.login_access_single > input').forEach((item) =>{
					item.style.border = "1px #f00 solid";
				})
			}
		});
	});
