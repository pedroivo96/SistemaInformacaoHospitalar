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
			<h3>
				Menu do paciente
				<small class="text-muted">Meus exames</small>
			</h3>
		</div>
	</div>
	<div class="row">
	
		<div class="col-md-8">
			
			<div class="row">
				<?php
				
					include './conexao.php';
				
					$cpfpaciente = $_SESSION['cpf'];
					$haExame = false;
					
					$conn = getConnection();
					
					$sql = 'SELECT id, cpfmedico FROM consultas WHERE cpfpaciente = :cpfpaciente';
					$stmt = $conn->prepare($sql);
					$stmt->bindValue(':cpfpaciente', $cpfpaciente);
					$stmt->execute();
					$count = $stmt->rowCount();
		
					if($count > 0){
						$result = $stmt->fetchAll();
			
						foreach($result as $row){
							
							$idconsulta = $row['id'];
							$cpfmedico  = $row['cpfmedico'];
							
							$sql1 = 'SELECT idexame FROM consultaexame WHERE idconsulta = :idconsulta';
							$stmt1 = $conn->prepare($sql1);
							$stmt1->bindValue(':idconsulta', $idconsulta);
							$stmt1->execute();
							$count1 = $stmt1->rowCount();
		
							if($count1 > 0){
								
								$haExame = true;
								
								$result1 = $stmt1->fetchAll();
			
								foreach($result1 as $row1){
							
									$idexame = $row1['idexame'];
									
									$sql2 = 'SELECT * FROM exames WHERE id = :idexame';
									$stmt2 = $conn->prepare($sql2);
									$stmt2->bindValue(':idexame', $idexame);
									$stmt2->execute();
									$count2 = $stmt2->rowCount();
		
									if($count2 > 0){
										$result2 = $stmt2->fetchAll();
			
										foreach($result2 as $row2){
							
											$nomeexame = $row2['nomeexame'];
											$status = $row2['status'];
											$anotacoesopcionais = $row2['anotacoesopcionais'];
											$nomemedico = obterNomeMedico($cpfmedico);
											
											?>
											<div class="col-sm-4 mb-3">
												<div class="card border-secondary">
													<div class="card-header">
														<label for="nomecompleto">Nome do exame:</label>
														<h5 class="card-title" id="nomecompleto" name="nomecompleto">
															<?php echo $nomeexame; ?>
														</h5>
													</div>
													
													<div class="card-body">
														<label for="exampleInputEmail1">Status:</label>
														<h6 class="card-text" id="especialidade" name="especialidade">
															<?php echo $status; ?>
														</h6>
														
														<label for="exampleInputEmail1">Anotações opcionais:</label>
														<h6 class="card-text" id="especialidade" name="especialidade">
															<?php echo $anotacoesopcionais; ?>
														</h6>
														
														<label for="exampleInputEmail1">Solicitado por:</label>
														<h6 class="card-text" id="especialidade" name="especialidade">
															<?php echo $nomemedico; ?>
														</h6>
													</div>
												</div>
											</div>
											<?php				
										}
									}
								}
							}
						}
					}
					else{
						?>
						<div class="alert alert-warning" role="alert">
							Você não foi a nenhum consulta
							Obs: Exames são solicitados durante as consultas.
						</div>
						<?php
					}
					
					if($haExame == false){
						?>
						<div class="alert alert-warning" role="alert">
							Não há registro de exames.
						</div>
						<?php
					}
					
					function obterNomeMedico($cpfmedico){
						$sql = 'SELECT nomecompleto FROM profissionais WHERE cpf = :cpfmedico AND tipo = :tipo';
						
						$conn = getConnection();
						
						$stmt = $conn->prepare($sql);
						$stmt->bindValue(':cpfmedico', $cpfmedico);
						$stmt->bindValue(':tipo', "Médico");
						$stmt->execute();
						$count = $stmt->rowCount();
		
						if($count > 0){
							$result = $stmt->fetchAll();
			
							foreach($result as $row){
								$nomemedico = $row['nomecompleto'];
								
								return $nomemedico;
							}
						}
					}
				?>
			</div>
			
		</div>
		
		<div class="col-md-4">
			<?php include 'menuPacienteInclude.html'; ?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
		</div>
	</div>
	
	<?php include 'rodape1.html'; ?>
	
</div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
  </body>
</html>