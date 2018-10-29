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

    <title>Exames</title>

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
			<h5 class="display-4">Meus exames</h5>
		</div>
	</div>
	<div class="row">
	
		<div class="col-md-8">
			
			<div class="row">
				<?php
				
					include './conexao.php';
				
					$cpfpaciente = $_SESSION['cpf'];
					
					$conn = getConnection();
					
					$sql = 'SELECT * FROM exames WHERE cpfpaciente = :cpfpaciente';
					$stmt = $conn->prepare($sql);
					$stmt->bindValue(':cpfpaciente', $cpfpaciente);
					$stmt->execute();
					$count = $stmt->rowCount();
		
					if($count > 0){
						$result = $stmt->fetchAll();
			
						foreach($result as $row){
							
							$id                 = $row['id'];
							$cpfmedico          = $row['cpfmedico'];
							$nomeexame          = $row['nomeexame'];
							$status             = $row['status'];
							$anotacoesopcionais = $row['anotacoesopcionais'];
							$idconsulta         = $row['idconsulta'];
							
							$tipo = "Médico";
							
							$sql1 = 'SELECT nomecompleto, especialidade FROM profissionais WHERE cpf = :cpf AND tipo = :tipo';
							$stmt1 = $conn->prepare($sql1);
							$stmt1->bindValue(':cpf' , $cpfmedico);
							$stmt1->bindValue(':tipo', $tipo);
							$stmt1->execute();
							$count1 = $stmt1->rowCount();
		
							if($count1 > 0){
								$result1 = $stmt1->fetchAll();
			
								foreach($result1 as $row1){
									$nomemedico = $row1['nomecompleto'];
									$especialidade = $row1['especialidade'];
						
									?>
									<div class="col-sm-4 mb-3">
										<div class="card border-secondary">
											
											<div class="card-header">
												
												<label for="nomeexame">Nome do exame:</label>
												<h5 class="card-title" id="nomeexame" name="nomeexame">
													<?php echo $nomeexame; ?>
												</h5>
										
											</div>
											
											<div class="card-body">
												
												<label for="anotacoesopcionais">Anotações opcionais:</label>
												<h6 class="card-text" id="anotacoesopcionais" name="anotacoesopcionais">
													<?php echo $anotacoesopcionais; ?>
												</h6>
												
												<label for="nomemedico">Solicitado por:</label>
												<h6 class="card-text" id="nomemedico" name="nomemedico">
													<?php echo $nomemedico; ?>
												</h6>
												
											</div>
											
											<?php
												if($status == "Agendado"){
													?>
													<div class="card-footer bg-info text-white border-success"><?php echo $status; ?></div>
													<?php
												}
												if($status == "Realizado"){
													?>
													<div class="card-footer bg-warning text-white border-success"><?php echo $status; ?></div>
													<?php
												}
												if($status == "Resultado"){
													?>
													<div class="card-footer bg-success text-white border-success">Ver resultado</div>
													<?php
												}
											?>
											
										</div>
									</div>
									<?php
										
								}
							}
						}
					}
				?>
			</div>
			
		</div>
		
		<div class="col-md-4">
			<button type="button" class="btn btn-success btn-lg btn-block" onclick="location.href = 'buscarMedico.html';">Nova consulta</button>
			
			<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'examesPaciente.php';">Exames</button>
			
			<button type="button" class="btn btn-primary btn-lg btn-block">Procedimentos</button>
			
			<button type="button" class="btn btn-primary btn-lg btn-block">Pesquisar médicos</button>
			
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