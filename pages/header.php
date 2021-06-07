<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" type="text/css" href="css/mainPage.css">
	<link rel="stylesheet" type="text/css" href="css/easy-control-registers.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">


	<link href="./c3-0.7.20/c3.css" rel="stylesheet">

	<!-- Load d3.js and c3.js -->
	<script src="./c3-0.7.20/docs/js/d3-5.8.2.min.js" charset="utf-8"></script>
	<script src="./c3-0.7.20/docs/js/c3.min.js"></script>

	<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<title>Main Page</title>
</head>

<header>
	<div class="header">
		<a href="mainPageNow.php"><div class="logo"></div></a>
		<div class="options">
			<nav class="navBar">
					<div class="navBar__main">
						<span class="navBar__main__btn">Despesas</span>
						<div class="navBar__main__itens">
							<a href="mainRegisterAccount.php">Adicionar Despesa</a>
							<a href="pageDespesasDetalhes.php">Despesas</a>
						</div>
					</div>

					<div class="navBar__main">
						<span class="navBar__main__btn">Analises</span>
						<div class="navBar__main__itens">
							<a href="dashboard.analytics.php">Dashbord</a>
						</div>
					</div>

					<div class="navBar__main">
						<a href="ECLogin.php"><i class="fas fa-sign-out-alt navBar__main__btn_logout"></i></a>
					</div>

			</nav>
		</div>
	</div>		
</header>
<body>