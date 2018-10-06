<!DOCTYPE html>
<html lang="en">
  <head>
  
	<?php 
		// Inicia sessões 
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

    <title>Menu do Médico</title>

    <meta name="description" content="Source code generated using layoutit.com">
    <meta name="author" content="LayoutIt!">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
	<link href="css/bootstrap.css" rel="stylesheet">

  </head>
  <body>

    <div class="container-fluid">
	<div class="row mb-5 mt-5">
		<div class="col-md-12 border" align="center">
			<h5 class="display-4">Área do médico</h5>
		</div>
	</div>
	<div class="row">
		<div class="col-md-8">
			
			<dl class="row">
				<dt class="col-sm-3">Nome</dt>
				<dd class="col-sm-9"><?php echo $_SESSION['nomecompleto']; ?></dd>

				<dt class="col-sm-3">CPF</dt>
				<dd class="col-sm-9"><?php echo $_SESSION['cpf']; ?></dd>
				
				<dt class="col-sm-3">RG</dt>
				<dd class="col-sm-9"><?php echo $_SESSION['rg']; ?></dd>
				
				<dt class="col-sm-3">Tipo</dt>
				<dd class="col-sm-9"><?php echo $_SESSION['tipo']; ?></dd>
				
				<dt class="col-sm-3">Nome de usuário</dt>
				<dd class="col-sm-9"><?php echo $_SESSION['nomeusuario']; ?></dd>
				
				<dt class="col-sm-3">Registro</dt>
				<dd class="col-sm-9"><?php echo $_SESSION['registro']; ?></dd>
				
				<dt class="col-sm-3">Especialidade</dt>
				<dd class="col-sm-9"><?php echo $_SESSION['especialidade']; ?></dd>
				
			</dl>
			
		</div>
		<div class="col-md-4">
		
			<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'consultasMedico.php';">Minhas consultas</button>
			
			<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'examesMedico.php';">Meus exames</button>
			
			<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'procedimentosMedico.php';">Meus procedimentos</button>
			
			<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'pacientesMedico.php';">Meus pacientes</button>
			
			<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'minhasAnamneses.php';">Minhas anamneses</button>
			
			<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'minhasEvolucoes.php';">Minhas evoluções</button>
			
			<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'realizarInternacao.php';">Realizar internação</button>
			
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
		</div>
	</div>
</div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
  </body>
</html>