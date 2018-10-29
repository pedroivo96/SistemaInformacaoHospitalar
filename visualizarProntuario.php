<!DOCTYPE html>
<html lang="en">
  <head>
	<?php 
	
		//header('Content-Type: image/jpeg');
		// Inicia sessões 
		session_start();  
 
		// Verifica se existe os dados da sessão de login 
		if(!isset($_SESSION["nomeusuario"]) || !isset($_SESSION["cpf"])) { 
			// Usuário não logado! Redireciona para a página de login 
			header("Location: loginPaciente.html"); 
			
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
				Menu do paciente
				<small class="text-muted">Prontuário</small>
			</h3>
		</div>
	</div>
	
	<div class="row mb-5">
		<div class="col-md-8">
			
			<p class="h3 border-bottom">Informações do paciente</p>
			<?php
				include './conexao.php';
				
				date_default_timezone_set("America/Fortaleza"); 
				
				$cpfpaciente = $_SESSION['cpf'];
					
				$conn = getConnection();
				
				$tipo = "Médico";
				
				$sql = 'SELECT * FROM pacientes WHERE cpf = :cpfpaciente';
				$stmt = $conn->prepare($sql);
				$stmt->bindValue(':cpfpaciente', $cpfpaciente);
				$stmt->execute();
				$count = $stmt->rowCount();
		
				if($count > 0){
					$result = $stmt->fetchAll();
			
					foreach($result as $row){
							
						$nomecompleto           = $row['nomecompleto'];
						$datanascimento         = $row['datanascimento'];
						$sexo                   = $row['sexo'];
						$nomemae                = $row['nomemae'];
						$naturalidademunicipio  = $row['naturalidademunicipio'];
						$naturalidadeestado     = $row['naturalidadeestado'];
						$enderecovia            = $row['enderecovia'];
						$endereconumero         = $row['endereconumero'];
						$enderecocomplemento    = $row['enderecocomplemento'];
						$enderecobairrodistrito = $row['enderecobairrodistrito'];
						$enderecomunicipio      = $row['enderecomunicipio'];
						$enderecoestado         = $row['enderecoestado'];
						?>
						<dl class="row">
							<dt class="col-sm-3">Nome completo</dt>
							<dd class="col-sm-9"><?php echo $nomecompleto; ?></dd>
								
							<dt class="col-sm-3">Data de nascimento</dt>
							<dd class="col-sm-9"><?php echo $datanascimento; ?></dd>
								
							<dt class="col-sm-3">Sexo</dt>
							<dd class="col-sm-9"><?php echo $sexo; ?></dd>
								
							<dt class="col-sm-3">Nome da mãe</dt>
							<dd class="col-sm-9"><?php echo $nomemae; ?></dd>
								
							<dt class="col-sm-3">Naturalidade-município</dt>
							<dd class="col-sm-9"><?php echo $naturalidademunicipio; ?></dd>
								
							<dt class="col-sm-3">Naturalidade-estado</dt>
							<dd class="col-sm-9"><?php echo $naturalidadeestado; ?></dd>
								
							<dt class="col-sm-3">Endereço-via</dt>
							<dd class="col-sm-9"><?php echo $enderecovia; ?></dd>
								
							<dt class="col-sm-3">Endereço-número</dt>
							<dd class="col-sm-9"><?php echo $endereconumero; ?></dd>
								
							<dt class="col-sm-3">Endereço-complemento</dt>
							<dd class="col-sm-9"><?php echo $enderecocomplemento; ?></dd>
								
							<dt class="col-sm-3">Endereço-bairro/distrito</dt>
							<dd class="col-sm-9"><?php echo $enderecobairrodistrito; ?></dd>
							
							<dt class="col-sm-3">Endereço-município</dt>
							<dd class="col-sm-9"><?php echo $enderecomunicipio; ?></dd>
								
							<dt class="col-sm-3">Endereço-município</dt>
							<dd class="col-sm-9"><?php echo $enderecoestado; ?></dd>
								
							<dt class="col-sm-3">Médicos do paciente</dt>
							<?php
							$sql1 = 'SELECT cpfmedico FROM consultas WHERE cpfpaciente = :cpfpaciente GROUP BY cpfmedico';
							$stmt1 = $conn->prepare($sql1);
							$stmt1->bindValue(':cpfpaciente', $cpfpaciente);
							$stmt1->execute();
							$count1 = $stmt1->rowCount();
		
							if($count1 > 0){
								$result1 = $stmt1->fetchAll();
			
								foreach($result1 as $row1){
									$cpfmedico = $row1['cpfmedico'];
									
									$sql2 = 'SELECT * FROM profissionais WHERE cpf = :cpfmedico AND tipo = :tipo';
									$stmt2 = $conn->prepare($sql2);
									$stmt2->bindValue(':cpfmedico', $cpfmedico);
									$stmt2->bindValue(':tipo'     , $tipo);
									$stmt2->execute();
									$count2 = $stmt2->rowCount();
			
									if($count2 > 0){
										$result2 = $stmt2->fetchAll();
			
										foreach($result2 as $row2){
											$nomemedico = $row2['nomecompleto'];
											?>
											<dd class="col-sm-9"><?php echo $nomemedico; ?></dd>
											<?php									
										}
									}
								}
							}
							?>
						</dl>
						<?php
						}
					}
			?>
			
			<p class="h3 border-bottom">Histórico de consultas</p>
			<div class="row">
			<?php
			$conn = getConnection();
				
			$sql = 'SELECT * FROM consultas WHERE cpfpaciente = :cpfpaciente';
			$stmt = $conn->prepare($sql);
			$stmt->bindValue(':cpfpaciente', $cpfpaciente);
			$stmt->execute();
			$count = $stmt->rowCount();
		
			if($count > 0){
				$result = $stmt->fetchAll();
			
				foreach($result as $row){
					
					$idconsulta            = $row['id'];
					$cpfmedico             = $row['cpfmedico'];
					$diahorarioatendimento = date("d/m/Y", $row['diahorarioatendimento']);
					$status                = $row['status'];
					$queixaprincipal       = $row['queixaprincipal'];
					$exameclinico          = $row['exameclinico'];
					$diagnosticoprovavel   = $row['diagnosticoprovavel'];
					$altainternacao        = $row['altainternacao'];
					
					$tipo = "Médico";
					
					$sql1 = 'SELECT nomecompleto FROM profissionais WHERE cpf = :cpfmedico AND tipo = :tipo';
					$stmt1 = $conn->prepare($sql1);
					$stmt1->bindValue(':cpfmedico', $cpfmedico);
					$stmt1->bindValue(':tipo'     , $tipo);
					$stmt1->execute();
					$count1 = $stmt1->rowCount();
		
					if($count1 > 0){
						$result1 = $stmt1->fetchAll();
			
						foreach($result1 as $row1){
							
							$nomecompleto = $row1['nomecompleto'];
							
							?>
							<div class="col-sm-6 mb-3">
								<div class="card border-secondary">
									<div class="card-header">
												
										<label for="nomecompleto">Nome do médico:</label>
										<h5 class="card-title" id="nomecompleto" name="nomecompleto">
											<?php echo $nomemedico; ?>
										</h5>
									</div>
												
									<div class="card-body">
									
										<dl class="row">
											<dt class="col-sm-6">Dia e horário do atendimento</dt>
											<dd class="col-sm-6"><?php echo $diahorarioatendimento; ?></dd>
											
											<dt class="col-sm-6">Status</dt>
											<dd class="col-sm-6"><?php echo $status; ?></dd>
											
											<dt class="col-sm-6">Queixa principal</dt>
											<dd class="col-sm-6"><?php echo $queixaprincipal; ?></dd>
											
											<dt class="col-sm-6">Exame clínico</dt>
											<dd class="col-sm-6"><?php echo $exameclinico; ?></dd>
											
											<dt class="col-sm-6">Diagnóstico provável</dt>
											<dd class="col-sm-6"><?php echo $diagnosticoprovavel; ?></dd>
											
											<dt class="col-sm-6">Alta ou internação ?</dt>
											<dd class="col-sm-6"><?php echo $altainternacao; ?></dd>
										
											<dt class="col-sm-6">Exames solicitados</dt>
											<?php
											
											$sql2 = 'SELECT nomeexame FROM exames WHERE idconsulta = :idconsulta';
											$stmt2 = $conn->prepare($sql2);
											$stmt2->bindValue(':idconsulta', $idconsulta);
											$stmt2->execute();
											$count2 = $stmt2->rowCount();
		
											if($count2 > 0){
												$result2 = $stmt2->fetchAll();
				
												foreach($result2 as $row2){
													$nomeexame = $row2['nomeexame'];
													?>
													<dd class="col-sm-6"><?php echo $nomeexame; ?></dd>
													<?php
												}
											}
											?>
											
											<dt class="col-sm-6">Procedimentos solicitados</dt>
											<?php
											$sql3 = 'SELECT nomeprocedimento FROM procedimentos WHERE idconsulta = :idconsulta';
											$stmt3 = $conn->prepare($sql3);
											$stmt3->bindValue(':idconsulta', $idconsulta);
											$stmt3->execute();
											$count3 = $stmt3->rowCount();
		
											if($count3 > 0){
												$result3 = $stmt3->fetchAll();
				
												foreach($result3 as $row3){
													$nomeprocedimento = $row3['nomeprocedimento'];
													?>
													<dd class="col-sm-6"><?php echo $nomeprocedimento; ?></dd>
													<?php
												}
											}
											?>
										</dl>
										
									</div>
								</div>
							</div>
							<?php
						}
					}
				}
			}
			?>
			</div>
			
			<p class="h3 border-bottom">Histórico de exames</p>
			<div class="row">
			<?php
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
					
					$sql1 = 'SELECT nomecompleto FROM profissionais WHERE cpf = :cpfmedico';
					$stmt1 = $conn->prepare($sql1);
					$stmt1->bindValue(':cpfmedico', $cpfmedico);
					$stmt1->execute();
					$count1 = $stmt1->rowCount();
		
					if($count1 > 0){
						$result1 = $stmt1->fetchAll();
			
						foreach($result1 as $row1){
							$nomemedico = $row1['nomecompleto'];
							?>
							<div class="col-sm-6 mb-3">
								<div class="card border-secondary">
									<div class="card-header">
												
										<label for="nomecompleto">Nome do exame:</label>
										<h5 class="card-title" id="nomecompleto" name="nomecompleto">
											<?php echo $nomeexame; ?>
										</h5>
									</div>
												
									<div class="card-body">
										<dl class="row">
											<dt class="col-sm-6">Médico solicitante</dt>
											<dd class="col-sm-6"><?php echo $nomemedico; ?></dd>
											
											<dt class="col-sm-6">Anotações opcionais</dt>
											<dd class="col-sm-6"><?php echo $anotacoesopcionais; ?></dd>
											
											<dt class="col-sm-6">Status</dt>
											<dd class="col-sm-6"><?php echo $status; ?></dd>
											
											<?php
											if($status == "Resultado"){
												?>
												<dt class="col-sm-6">Resultado(s)</dt>
												
												<?php
												$sql2 = 'SELECT nomeimagem FROM resultadosexames WHERE id = :id';
												$stmt2 = $conn->prepare($sql2);
												$stmt2->bindValue(':id', $id);
												$stmt2->execute();
												$count2 = $stmt2->rowCount();
		
												if($count2 > 0){
													$result2 = $stmt2->fetchAll();
			
													foreach($result2 as $row2){
														
														$nomeimagem = $row2['nomeimagem'];
														$caminhoimagem = "img/".$nomeimagem;
														?>
														<img class="img-fluid" src="<?php echo $nomeimagem; ?>">
														<?php														
													}
												}
											}
											?>
											
										</dl>
									</div>
								</div>
							</div>
							<?php
						}
					}
					
				}
			}
			?>
			</div>
			
			<p class="h3 border-bottom">Histórico de procedimentos</p>
			<div class="row">
			<?php
			
			?>
			</div>
			
		</div>
		
		<div class="col-md-4">
			<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'consultasPaciente.php';">Consultas</button>
			
			<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'examesPaciente.php';">Exames</button>
			
			<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'procedimentosPaciente.php';">Procedimentos</button>
			
			<button type="button" class="btn btn-success btn-lg btn-block" onclick="location.href = 'gerarProntuario.php';">Baixar prontuário</button>
			
			<button type="button" class="btn btn-danger btn-lg btn-block" onclick="location.href = 'sair.php';">Sair</button>
		</div>
	</div>
	
</div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
  </body>
</html>