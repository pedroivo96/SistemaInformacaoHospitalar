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

    <div class="container-fluid px-5 pb-5">
	
	<?php include 'campoPesquisaPaciente.html'?>	
	
	<div class="row mb-4 mt-2">
		<div class="col-md-12 border" align="center">
			<h3>
				Menu do médico
				<small class="text-muted">Informações pessoais</small>
			</h3>
		</div>
	</div>
	<div class="row">
	
		<div class="col-md-2"></div>
		
		<div class="col-md-5">
		
		
			<dl class="row">
				<dt class="col-sm-6">Nome</dt>
				<dd class="col-sm-6"><?php echo $_SESSION['nomecompleto']; ?></dd>

				<dt class="col-sm-6">CPF</dt>
				<dd class="col-sm-6"><?php echo $_SESSION['cpf']; ?></dd>
				
				<dt class="col-sm-6">RG</dt>
				<dd class="col-sm-6"><?php echo $_SESSION['rg']; ?></dd>
				
				<dt class="col-sm-6">Tipo</dt>
				<dd class="col-sm-6"><?php echo $_SESSION['tipo']; ?></dd>
				
				<dt class="col-sm-6">Nome de usuário</dt>
				<dd class="col-sm-6"><?php echo $_SESSION['nomeusuario']; ?></dd>
				
				<dt class="col-sm-6">Registro</dt>
				<dd class="col-sm-6"><?php echo $_SESSION['registro']; ?></dd>
				
				<dt class="col-sm-6">Especialidade</dt>
				<dd class="col-sm-6"><?php echo $_SESSION['especialidade']; ?></dd>
				
			</dl>
			
		</div>
		
		<div class="col-md-2"></div>
		
		<div class="col-md-3">
			<?php include 'menuMedicoInclude.php'?>	
		</div>
		
	</div>
	
</div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
  </body>
</html>