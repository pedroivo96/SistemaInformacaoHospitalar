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
	
	<?php include 'campoPesquisaPaciente.html'?>	
	
	<div class="row mb-5">
		<div class="col-md-12 border" align="center">
			<h3>
				Menu do médico
				<small class="text-muted">Meus pacientes</small>
			</h3>
		</div>
	</div>
	<div class="row">
		<div class="col-md-9">
		
			<p class="h3 border-bottom">Atualmente internados</p>
			
			<div class="row">
				<?php
				
					$cpfmedico = $_SESSION['cpf'];
					$status = "Realizada";
					
					$conn = getConnection();
					
					$sql = 'SELECT cpfpaciente FROM consultas WHERE cpfmedico = :cpfmedico GROUP BY cpfpaciente';
					
					$stmt = $conn->prepare($sql);
					$stmt->bindValue(':cpfmedico', $cpfmedico);
					$stmt->execute();
					$count = $stmt->rowCount();
		
					if($count > 0){
						$result = $stmt->fetchAll();
						
						$flag1 = 0;//Caso mude para 1, significa que este médico possui algum paciente internado
			
						foreach($result as $row){
							$cpfpaciente = $row['cpfpaciente'];
							
							$sql1 = 'SELECT * FROM internacoes WHERE cpfpaciente = :cpfpaciente AND status = :status';
					
							$stmt1 = $conn->prepare($sql1);
							$stmt1->bindValue(':cpfpaciente', $cpfpaciente);
							$stmt1->bindValue(':status', $status);
							$stmt1->execute();
							$count1 = $stmt1->rowCount();
		
							if($count1 > 0){
								$result1 = $stmt1->fetchAll();
								
								$flag1 = 1;
			
								foreach($result1 as $row1){
									$cpfpaciente       = $row1['cpfpaciente'];
									$idleito           = $row1['idleito'];
									$diahorarioentrada = $row1['diahorarioentrada'];
									$diahorariosaida   = $row1['diahorariosaida'];
									$status            = $row1['status'];
									
									$sql2 = 'SELECT nomecompleto FROM pacientes WHERE cpf = :cpfpaciente';
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
													
													<form method="POST" action="gerarProntuario.php">
														<input type="hidden" id="cpfpaciente" name="cpfpaciente" value="<?php echo $cpfpaciente; ?>">
													
														<button type="submit" class="btn btn-primary btn-block" style="padding: 0.75rem 1.25rem; border-radius: 0 0 calc(0.25rem - 1px) calc(0.25rem - 1px);">
															Ver prontuário
														</button>
													</form>
													
												</div>
											</div>
											<?php
										}
									}
								}
							}	
						}
						if($flag1 == 0){
							?>
							<div class="alert alert-primary w-100" role="alert">
								Você não tem nenhum paciente internado.
							</div>
							<?php
							
						}
					}else{
						
					}	
				?>
				</div>
			
			<p class="h3 border-bottom">Com internação solicitada</p>
			
			<div class="row">
				<?php
					$cpfmedico = $_SESSION['cpf'];
					
					$status = "Solicitada";
					$flag2 = 0;//Caso continue em 0, então nenhum dos pacientes teve internação solicitada
					
					$sql = 'SELECT cpfpaciente FROM consultas WHERE cpfmedico = :cpfmedico GROUP BY cpfpaciente';
					
					$stmt = $conn->prepare($sql);
					$stmt->bindValue(':cpfmedico', $cpfmedico);
					$stmt->execute();
					$count = $stmt->rowCount();
		
					if($count > 0){
						$result = $stmt->fetchAll();
			
						foreach($result as $row){
							$cpfpaciente = $row['cpfpaciente'];
							
							$sql1 = 'SELECT * FROM internacoes WHERE cpfpaciente = :cpfpaciente AND status = :status';
					
							$stmt1 = $conn->prepare($sql1);
							$stmt1->bindValue(':cpfpaciente', $cpfpaciente);
							$stmt1->bindValue(':status'     , $status);
							$stmt1->execute();
							$count1 = $stmt1->rowCount();
		
							if($count1 > 0){
								
								$flag2 = 1;
								
								//Paciente não internados, cuja internação foi solicitada, ou que já tiveram alta
								$result1 = $stmt1->fetchAll();
			
								foreach($result1 as $row1){
									$cpfpaciente       = $row1['cpfpaciente'];
									$idleito           = $row1['idleito'];
									$diahorarioentrada = $row1['diahorarioentrada'];
									$diahorariosaida   = $row1['diahorariosaida'];
									$status            = $row1['status'];
									
									$sql2 = 'SELECT nomecompleto FROM pacientes WHERE cpf = :cpfpaciente';
					
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
													
													<form method="POST" action="gerarProntuario.php">
														<input type="hidden" id="cpfpaciente" name="cpfpaciente" value="<?php echo $cpfpaciente; ?>">
													
														<button type="submit" class="btn btn-primary btn-block" style="padding: 0.75rem 1.25rem; border-radius: 0 0 calc(0.25rem - 1px) calc(0.25rem - 1px);">
															Ver prontuário
														</button>
													</form>
													
												</div>
											</div>
											<?php
										}
									}	
								}
							}
						}
						
						if($flag2 == 0){
							?>
							<div class="alert alert-warning w-100" role="alert">
								<b>Nenhum dos seus pacientes teve internação solicitada.</b>
							</div>
							<?php
						}
					}	
				?>
				</div>
				
			<p class="h3 border-bottom">Já tiveram alta</p>
			
			<div class="row">
				<?php
					$cpfmedico = $_SESSION['cpf'];
					
					$status = "Alta";
					$flag3 = 0;//Caso continue em 0, então nenhum dos pacientes teve internação solicitada
					
					$sql = 'SELECT cpfpaciente FROM consultas WHERE cpfmedico = :cpfmedico GROUP BY cpfpaciente';
					
					$stmt = $conn->prepare($sql);
					$stmt->bindValue(':cpfmedico', $cpfmedico);
					$stmt->execute();
					$count = $stmt->rowCount();
		
					if($count > 0){
						$result = $stmt->fetchAll();
			
						foreach($result as $row){
							$cpfpaciente = $row['cpfpaciente'];
							
							$sql1 = 'SELECT * FROM internacoes WHERE cpfpaciente = :cpfpaciente AND status = :status';
					
							$stmt1 = $conn->prepare($sql1);
							$stmt1->bindValue(':cpfpaciente', $cpfpaciente);
							$stmt1->bindValue(':status'   , $status);
							$stmt1->execute();
							$count1 = $stmt1->rowCount();
		
							if($count1 > 0){
								
								$flag3 = 1;
								
								//Paciente não internados, cuja internação foi solicitada, ou que já tiveram alta
								$result1 = $stmt1->fetchAll();
			
								foreach($result1 as $row1){
									$cpfpaciente       = $row1['cpfpaciente'];
									$idleito           = $row1['idleito'];
									$diahorarioentrada = $row1['diahorarioentrada'];
									$diahorariosaida   = $row1['diahorariosaida'];
									$status            = $row1['status'];
									
									$sql2 = 'SELECT nomecompleto FROM pacientes WHERE cpf = :cpfpaciente';
					
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
								
													<form method="POST" action="gerarProntuario.php">
														<input type="hidden" id="cpfpaciente" name="cpfpaciente" value="<?php echo $cpfpaciente; ?>">
													
														<button type="submit" class="btn btn-primary btn-block" style="padding: 0.75rem 1.25rem; border-radius: 0 0 calc(0.25rem - 1px) calc(0.25rem - 1px);">
															Ver prontuário
														</button>
													</form>
													
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
						
						if($flag3 == 0){
							?>
							<div class="alert alert-primary w-100" role="alert">
								Nenhum dos seus pacientes teve Alta.
							</div>
							<?php
						}
					}	
				?>
				</div>
			
			<p class="h3 border-bottom">Nunca internados</p>
			
			<div class="row">
				<?php
					$cpfmedico = $_SESSION['cpf'];
					
					$status = "Realizada";
					
					$sql = 'SELECT cpfpaciente FROM consultas WHERE cpfmedico = :cpfmedico GROUP BY cpfpaciente';
					
					$stmt = $conn->prepare($sql);
					$stmt->bindValue(':cpfmedico', $cpfmedico);
					$stmt->execute();
					$count = $stmt->rowCount();
		
					if($count > 0){
						$result = $stmt->fetchAll();
						
						$flag4 = 0;
						
						foreach($result as $row){
							$cpfpaciente = $row['cpfpaciente'];
			
							$sql1 = 'SELECT * FROM internacoes WHERE cpfpaciente = :cpfpaciente AND status = :status';
						
							$stmt1 = $conn->prepare($sql1);
							$stmt1->bindValue(':cpfpaciente', $cpfpaciente);
							$stmt1->bindValue(':status'     , $status);
							$stmt1->execute();
							$count1 = $stmt1->rowCount();
		
							if($count1 > 0){
								$result1 = $stmt1->fetchAll();
							}
							else{
								
								$flag4 = 1;
							
								$sql2 = 'SELECT nomecompleto FROM pacientes WHERE cpf = :cpfpaciente';
					
								$stmt2 = $conn->prepare($sql2);
								$stmt2->bindValue(':cpfpaciente', $cpfpaciente);
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
								
												<form method="POST" action="gerarProntuario.php">
													<input type="hidden" id="cpfpaciente" name="cpfpaciente" value="<?php echo $cpfpaciente; ?>">
													
													<button type="submit" class="btn btn-primary btn-block" style="padding: 0.75rem 1.25rem; border-radius: 0 0 calc(0.25rem - 1px) calc(0.25rem - 1px);">
														Ver prontuário
													</button>
												</form>
												
											</div>
										</div>
										<?php
									}
								}
							}
						}
						
						if($flag4 == 0){
							?>
							<div class="alert alert-primary w-100" role="alert">
								Existem registros de internação associados a algum de seus paciente.
							</div>
							<?php
						}
					}	
				?>
				</div>
		</div>
		
		<div class="col-md-3">
			<?php include 'menuMedicoInclude.php'?>	
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