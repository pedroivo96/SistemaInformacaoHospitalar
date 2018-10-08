<!DOCTYPE html>
<html lang="en">
  <head>
  
	<?php 
		// Inicia sessões 
		session_start(); 
 
		// Verifica se existe os dados da sessão de login 
		if(!isset($_SESSION["nomeusuario"]) || !isset($_SESSION["cpf"])) { 
			// Usuário não logado! Redireciona para a página de login 
			header("Location: loginPaciente.html"); 
			exit; 
		} 
	?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Menu do Paciente</title>

    <meta name="description" content="Source code generated using layoutit.com">
    <meta name="author" content="LayoutIt!">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
	<link href="css/bootstrap.css" rel="stylesheet">

  </head>
  <body>

    <div class="container-fluid px-5">
	<div class="row mb-5 mt-5">
		<div class="col-md-12 border" align="center">
			<h3>
				Menu do médico
				<small class="text-muted">Informações pessoais</small>
			</h3>
		</div>
	</div>
	
	<div class="row mb-5">
		<div class="col-md-8">
			
			<dl class="row">
				<dt class="col-sm-3">Nome</dt>
				<dd class="col-sm-9"><?php echo $_SESSION['nomecompleto']; ?></dd>

				<dt class="col-sm-3">CPF</dt>
				<dd class="col-sm-9"><?php echo $_SESSION['cpf']; ?></dd>
				
				<dt class="col-sm-3">RG</dt>
				<dd class="col-sm-9"><?php echo $_SESSION['rg']; ?></dd>
				
				<dt class="col-sm-3">Sexo</dt>
				<dd class="col-sm-9"><?php echo $_SESSION['sexo']; ?></dd>
				
				<dt class="col-sm-3">Nome da mãe</dt>
				<dd class="col-sm-9"><?php echo $_SESSION['nomemae']; ?></dd>
				
				<dt class="col-sm-3">Município de nascimento</dt>
				<dd class="col-sm-9"><?php echo $_SESSION['naturalidademunicipio']; ?></dd>
				
				<dt class="col-sm-3">Estado de nascimento</dt>
				<dd class="col-sm-9"><?php echo $_SESSION['naturalidadeestado']; ?></dd>
				
				<dt class="col-sm-3">Via</dt>
				<dd class="col-sm-9"><?php echo $_SESSION['enderecovia']; ?></dd>
				
				<dt class="col-sm-3">Número</dt>
				<dd class="col-sm-9"><?php echo $_SESSION['endereconumero']; ?></dd>
				
				<dt class="col-sm-3">Complemento</dt>
				<dd class="col-sm-9"><?php echo $_SESSION['enderecocomplemento']; ?></dd>
				
				<dt class="col-sm-3">Distrito/Bairro</dt>
				<dd class="col-sm-9"><?php echo $_SESSION['enderecobairrodistrito']; ?></dd>
				
				<dt class="col-sm-3">Município</dt>
				<dd class="col-sm-9"><?php echo $_SESSION['enderecomunicipio']; ?></dd>
				
				<dt class="col-sm-3">Estado</dt>
				<dd class="col-sm-9"><?php echo $_SESSION['enderecoestado']; ?></dd>
				
				<dt class="col-sm-3">Nome de usuário</dt>
				<dd class="col-sm-9"><?php echo $_SESSION['nomeusuario']; ?></dd>
				
				<dt class="col-sm-3">E-mail</dt>
				<dd class="col-sm-9"><?php echo $_SESSION['email']; ?></dd>
				
			</dl>
			
		</div>
		<div class="col-md-4">
			<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'consultasPaciente.php';">Consultas</button>
			
			<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'examesPaciente.php';">Exames</button>
			
			<button type="button" class="btn btn-primary btn-lg btn-block">Procedimentos</button>
			
			<button type="button" class="btn btn-primary btn-lg btn-block">Prontuário</button>
			
			<button type="button" class="btn btn-danger btn-lg btn-block" onclick="location.href = 'sair.php';">Sair</button>
		</div>
	</div>
	
	<div class="row">
		<?php include 'rodape.html'; ?>
	</div>
</div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
  </body>
</html>