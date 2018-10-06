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

    <title>Meus pacientes</title>

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
			<h5 class="display-4">Meus pacientes</h5>
		</div>
	</div>
	<div class="row">
		<div class="col-md-8">
		
			<p class="h3 border-bottom">Atualmente internados</p>
			
				<div class="row">
				<?php
					include './conexao.php';
				
					$cpfmedico = $_SESSION['cpf'];
					$status = "Realizada";
					
					$conn = getConnection();
					
					$sql = 'SELECT cpfpaciente FROM consultas WHERE cpfmedico = :cpfmedico LIMIT 1';
					
					$stmt = $conn->prepare($sql);
					$stmt->bindValue(':cpfmedico', $cpfmedico);
					$stmt->execute();
					$count = $stmt->rowCount();
		
					if($count > 0){
						$result = $stmt->fetchAll();
			
						foreach($result as $row){
							$cpfpaciente = $row['cpfpaciente'];
							
							$sql1 = 'SELECT * FROM internacoes WHERE cpfpaciente = :cpfpaciente WHERE status = :status';
					
							$stmt1 = $conn->prepare($sql1);
							$stmt1->bindValue(':cpfpaciente', $cpfpaciente);
							$stmt1->bindValue(':status', $status);
							$stmt1->execute();
							$count1 = $stmt1->rowCount();
		
							if($count1 > 0){
								$result1 = $stmt1->fetchAll();
			
								foreach($result1 as $row1){
									$cpfpaciente       = $row1['cpfpaciente'];
									$idleito           = $row1['idleito'];
									$diahorarioentrada = $row1['diahorarioentrada'];
									$diahorariosaida   = $row1['diahorariosaida'];
									$status            = $row1['status'];
									
									$sql2 = 'SELECT nomecompleto FROM pacientes WHERE cpfpaciente = :cpfpaciente';
					
									$stmt2 = $conn->prepare($sql2);
									$stmt2->bindValue(':cpfpaciente', $cpfpaciente);
									$stmt2->execute();
									$count2 = $stmt2->rowCount();
		
									if($count2 > 0){
										$result2 = $stmt2->fetchAll();
			
										foreach($result2 as $row2){
											$nomepaciente = $row2['nomecompleto'];
											
											?>
											<div class="col-sm-4 mb-3">
												<div class="card border-secondary">
													<div class="card-header">
														<label for="nomecompleto">Nome do paciente:</label>
														<h5 class="card-title" id="nomecompleto" name="nomecompleto">
															<?php echo $nomepaciente; ?>
														</h5>
													</div>
								
													<div class="card-body">
													<button type="button" class="btn btn-primary btn-block">Evoluir</button>
													
													<button type="button" class="btn btn-primary btn-block">Fazer anamnese</button>
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
				?>
				</div>
			
			<p class="h3 border-bottom">Com internação solicitada ou com Alta</p>
			
				<div class="row">
				<?php
					$cpfmedico = $_SESSION['cpf'];
					
					$status = "Realizada";
					
					$sql = 'SELECT cpfpaciente FROM consultas WHERE cpfmedico = :cpfmedico LIMIT 1';
					
					$stmt = $conn->prepare($sql);
					$stmt->bindValue(':cpfmedico', $cpfmedico);
					$stmt->execute();
					$count = $stmt->rowCount();
		
					if($count > 0){
						$result = $stmt->fetchAll();
			
						foreach($result as $row){
							$cpfpaciente = $row['cpfpaciente'];
							
							$sql1 = 'SELECT * FROM internacoes WHERE cpfpaciente = :cpfpaciente WHERE status != :status';
					
							$stmt1 = $conn->prepare($sql1);
							$stmt1->bindValue(':cpfmedico', $cpfmedico);
							$stmt1->bindValue(':status', $status);
							$stmt1->execute();
							$count1 = $stmt1->rowCount();
		
							if($count1 > 0){
								//Paciente não internados, cuja internação foi solicitada, ou que já tiveram alta
								$result1 = $stmt1->fetchAll();
			
								foreach($result1 as $row1){
									$cpfpaciente       = $row1['cpfpaciente'];
									$idleito           = $row1['idleito'];
									$diahorarioentrada = $row1['diahorarioentrada'];
									$diahorariosaida   = $row1['diahorariosaida'];
									$status            = $row1['status'];
									
									$sql2 = 'SELECT nomecompleto FROM pacientes WHERE cpfpaciente = :cpfpaciente';
					
									$stmt2 = $conn->prepare($sql2);
									$stmt2->bindValue(':cpfpaciente', $cpfpaciente);
									$stmt2->execute();
									$count2 = $stmt2->rowCount();
		
									if($count2 > 0){
										$result2 = $stmt2->fetchAll();
			
										foreach($result2 as $row2){
											$nomepaciente = $row2['nomecompleto'];
											
											?>
											<div class="col-sm-4 mb-3">
												<div class="card border-secondary">
													<div class="card-header">
														<label for="nomecompleto">Nome do paciente:</label>
														<h5 class="card-title" id="nomecompleto" name="nomecompleto">
															<?php echo $nomepaciente; ?>
														</h5>
													</div>
								
													<div class="card-body">
													</div>
													
													<?php
													if($status == "Solicitada"){
														?>
														<div class="card-footer bg-warning text-white border-"><?php echo $status; ?></div>
														<?php
													}
													if($status == "Alta"){
														?>
														<div class="card-footer bg-sucess text-white border-success"><?php echo $status; ?></div>
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
						}
					}	
				?>
				</div>
			
			<p class="h3 border-bottom">Nunca internados</p>
			
				<div class="row">
				<?php
					$cpfmedico = $_SESSION['cpf'];
					
					$status = "Realizada";
					
					$sql = 'SELECT cpfpaciente FROM consultas WHERE cpfmedico = :cpfmedico LIMIT 1';
					
					$stmt = $conn->prepare($sql);
					$stmt->bindValue(':cpfmedico', $cpfmedico);
					$stmt->execute();
					$count = $stmt->rowCount();
		
					if($count > 0){
						$result = $stmt->fetchAll();
						
						foreach($result as $row){
							$cpfpaciente = $row['cpfpaciente'];
			
							$sql1 = 'SELECT * FROM internacoes WHERE cpfpaciente = :cpfpaciente';
						
							$stmt1 = $conn->prepare($sql1);
							$stmt1->bindValue(':cpfpaciente', $cpfpaciente);
							$stmt1->execute();
							$count1 = $stmt1->rowCount();
		
							if($count1 > 0){
								$result1 = $stmt1->fetchAll();
							}
							else{
							
								$sql2 = 'SELECT nomecompleto FROM pacientes WHERE cpf = :cpfpaciente';
					
								$stmt2 = $conn->prepare($sql2);
								$stmt2->bindValue(':cpf', $cpfpaciente);
								$stmt2->execute();
								$count2 = $stmt2->rowCount();
		
								if($count2 > 0){
									$result2 = $stmt2->fetchAll();
								
									foreach($result2 as $row2){
										$nomepaciente = $row2['nomecompleto']
								
										?>
										<div class="col-sm-4 mb-3">
											<div class="card border-secondary">
												<div class="card-header">
													<label for="nomecompleto">Nome do paciente:</label>
														<h5 class="card-title" id="nomecompleto" name="nomecompleto">
															<?php echo $nomepaciente; ?>
														</h5>
													</div>
								
												<div class="card-body">
												</div>			
											</div>
										</div>
										<?php
									}
								}
							}
						}
					}	
				?>
				</div>
		</div>
		<div class="col-md-4">
		
			<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'consultasMedico.php';">Minhas consultas</button>
			
			<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'examesMedico.php';">Meus exames</button>
			
			<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'procedimentosMedico.php';">Meus procedimentos</button>
			
			<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'pacientesMedico.php';">Meus pacientes</button>
			
			<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'prescricoesMedico.php';">Minhas prescrições</button>
			
			<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'pacientesMedico.php';">Meus diagnósticos</button>
			
			<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'anamnesesMedico.php';">Minhas anamneses</button>
			
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