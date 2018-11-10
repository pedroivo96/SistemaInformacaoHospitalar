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
			header("Location: loginPaciente.html"); 
			exit; 
		} 
	?>
  
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Agendar consulta</title>

    <meta name="description" content="Source code generated using layoutit.com">
    <meta name="author" content="LayoutIt!">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
	
  </head>
  <body>

    <div class="container-fluid px-5">
	<div class="row mb-5 mt-5">
		<div class="col-md-12 border" align="center">
			<h3>
				Menu do paciente
				<small class="text-muted">Agendar consulta</small>
			</h3>
		</div>
	</div>
	<div class="row">
		<div class="col-md-9">
		
			<div class="row">
				<div class="col-md-3">
				</div>
				<div class="col-md-6">
					<form method="post" action="buscarMedicoConsulta.php">
						<div class="form-group">
							<label for="especialidade">Especialidade</label>
							<input type="text" class="form-control" id="especialidade" name="especialidade">
						</div>
						<div class="form-group">
							<label for="diahorario">Dia e horário</label>
							<input type="datetime-local" class="form-control" id="diahorario" name="diahorario">
						</div>
				
						<button type="submit" class="btn btn-primary btn-block">Buscar</button>
					</form>
					
				</div>
				<div class="col-md-3">
				</div>
			</div>
		</div>
		
		<div class="col-md-3">
			<?php include 'menuPacienteInclude.php'; ?>
		</div>
	</div>
	
</div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
  </body>
</html>