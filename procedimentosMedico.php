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

    <title>Meus procedimentos</title>

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
			<h5 class="display-4">Meus procedimentos</h5>
		</div>
	</div>
	<div class="row">
		<div class="col-md-8">
			
			<div class="row">
			<?php
			
				include './conexao.php';
				
				$cpfmedico = $_SESSION['cpf'];
					
				$conn = getConnection();
					
				$sql = 'SELECT * FROM procedimentos WHERE cpfmedico = :cpfmedico';
				$stmt = $conn->prepare($sql);
				$stmt->bindValue(':cpfmedico', $cpfmedico);
				$stmt->execute();
				$count = $stmt->rowCount();
		
				if($count > 0){
					$result = $stmt->fetchAll();
			
					foreach($result as $row){
						$id                 = $row['id'];
						$cpfpaciente        = $row['cpfpaciente'];
						$nomeprocedimento   = $row['nomeprocedimento'];
						$status             = $row['status'];
						$anotacoesopcionais = $row['anotacoesopcionais'];
						$idconsulta         = $row['idconsulta'];
						
						?>
						<div class="col-sm-4 mb-3">
							<div class="card border-secondary">
								<div class="card-header">
									<label for="nomeprocedimento">Nome do procedimento:</label>
									<h5 class="card-title" id="nomeprocedimento" name="nomeprocedimento">
										<?php echo $nomeprocedimento; ?>
									</h5>
								</div>
								
								<div class="card-body">
									<label for="anotacoesopcionais">Anotações opcionais:</label>
									<h6 class="card-text" id="anotacoesopcionais" name="anotacoesopcionais">
										<?php echo $anotacoesopcionais; ?>
									</h6>
									
									<label for="status">Status:</label>
									<h6 class="card-text" id="status" name="status">
										<?php echo $status; ?>
									</h6>
								</div>
							</div>
						</div>
						<?php
					}
				}	
			?>
			</div>
			
		</div>
		<div class="col-md-4">
		
			<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'consultasMedico.php';">Minhas consultas</button>
			
			<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'examesMedico.php';">Meus exames</button>
			
			<button type="button" class="btn btn-primary btn-lg btn-block">Meus procedimentos</button>
			
			<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'pacientesMedico.php';">Meus pacientes</button>
			
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