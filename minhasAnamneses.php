<!DOCTYPE html>
<html lang="en">
  <head>
  
	<?php 
		// Inicia sessões 
		include './conexao.php';
		session_start(); 
 
		// Verifica se existe os dados da sessão de login 
		if(!isset($_SESSION["nomeusuario"]) || !isset($_SESSION["cpf"])) { 
			// Usuário não logado! Redireciona para a página de login 
			header("Location: loginProfissional.html"); 
			exit; 
		} 
	?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SIH</title>

    <meta name="description" content="Source code generated using layoutit.com">
    <meta name="author" content="LayoutIt!">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
	<link href="css/bootstrap.css" rel="stylesheet">

  </head>
  <body>

    <div class="container-fluid px-5">
	<div class="row mb-4 mt-5">
		<div class="col-md-12 border" align="center">
			<h3>
				<?php
				$tipo = $_SESSION['tipo'];
				
				if($tipo == "Médico"){
					?>
					Menu do médico
					<?php
				}
				else{
					?>
					Menu do enfermeiro
					<?php
				}
				?>
				<small class="text-muted">Minhas anamneses</small>
			</h3>
		</div>
	</div>
	<div class="row">
	
		<div class="col-md-9">
		
		</div>
		
		<div class="col-md-3">
		
			<?php
			$tipo = $_SESSION['tipo'];
				
			if($tipo == "Médico"){
				include 'menuMedicoInclude.php';
			}
			else{
				include 'menuEnfermeiroInclude.php';
			}
			?>
		</div>
		
	</div>
	
</div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
  </body>
</html>