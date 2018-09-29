<!DOCTYPE html>
<html lang="en">
  <head>
  
	<?php 
		// Inicia sessões 
		session_start(); 
 
		// Verifica se existe os dados da sessão de login 
		if(!isset($_SESSION["id_usuario"]) || !isset($_SESSION["nome_usuario"])) { 
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

    <div class="container-fluid">
	<div class="row mb-5 mt-5">
		<div class="col-md-12 border" align="center">
			<h5 class="display-4">Área do paciente</h5>
		</div>
	</div>
	<div class="row">
		<div class="col-md-8">
			
			<dl class="row">
				<dt class="col-sm-3">Nome</dt>
				<dd class="col-sm-9">Pedro Ivo Soares Barbosa</dd>

				<dt class="col-sm-3">Data de nascimento</dt>
				<dd class="col-sm-9">18/05/96</dd>
				
				<dt class="col-sm-3">Algo aleatório</dt>
				<dd class="col-sm-9">
					<p>Vestibulum id ligula porta felis euismod semper eget lacinia odio sem nec elit.</p>
					<p>Donec id elit non mi porta gravida at eget metus.</p>
				</dd>

				<dt class="col-sm-3">Malesuada porta</dt>
				<dd class="col-sm-9">Etiam porta sem malesuada magna mollis euismod.</dd>

				<dt class="col-sm-3 text-truncate">Truncated term is truncated</dt>
				<dd class="col-sm-9">Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</dd>

				<dt class="col-sm-3">Nesting</dt>
				<dd class="col-sm-9">
				
					<dl class="row">
						<dt class="col-sm-4">Nested definition list</dt>
						<dd class="col-sm-8">Aenean posuere, tortor sed cursus feugiat, nunc augue blandit nunc.</dd>
					</dl>
				</dd>
			</dl>
			
		</div>
		<div class="col-md-4">
			<button type="button" class="btn btn-primary btn-lg btn-block">Consultas</button>
			
			<button type="button" class="btn btn-primary btn-lg btn-block">Exames</button>
			
			<button type="button" class="btn btn-primary btn-lg btn-block">Procedimentos</button>
			
			<button type="button" class="btn btn-primary btn-lg btn-block">Prontuário</button>
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