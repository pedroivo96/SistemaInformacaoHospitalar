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

    <title>Gerenciamento de Internações</title>

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
			<?php
			$tipo = $_SESSION['tipo'];
			
			if($tipo == "Médico"){
				?>
				<h3>
					Menu do médico
					<small class="text-muted">Gerenciamento de internações</small>
				</h3>
				<?php
			}
			else{
				?>
				<h3>
					Menu do enfermeiro
					<small class="text-muted">Gerenciamento de internações</small>
				</h3>
				<?php
			}
			?>
		
			<h5 class="display-4">Gerenciamento de Internações</h5>
		</div>
	</div>
	<div class="row">
		<div class="col-md-8">
			
			<div class="row">
			<p class="h5">Internados</p>
			<?php
				$cpfprofissional = $_SESSION['cpf'];
				$tipo            = $_SESSION['tipo'];
				
				include './conexao.php';
				
				$status = "Realizada";
				
				$conn = getConnection();
		
				$sql = 'SELECT * FROM internacoes WHERE status = :status';
				$stmt = $conn->prepare($sql);
				$stmt->bindValue(':status', $status);
				$stmt->execute();
				$count = $stmt->rowCount();
		
				if($count > 0){
					$result = $stmt->fetchAll();
			
					foreach($result as $row){
						
						$idleito           = $row['idleito'];
						$cpfpaciente       = $row['cpfpaciente'];
						$diahorarioentrada = $row['diahorarioentrada'];
						$diahorarioalta    = $row['diahorarioalta'];
						$cpfmedico         = $row['cpfmedico'];
						//$cpftecnico        = $row['cpftecnico'];
						
						$sql1 = 'SELECT nomecompleto FROM pacientes WHERE cpf = :cpfpaciente';
						$stmt1 = $conn->prepare($sql1);
						$stmt1->bindValue(':cpfpaciente', $cpfpaciente);
						$stmt1->execute();
						$count1 = $stmt1->rowCount();
		
						if($count1 > 0){
							$result1 = $stmt1->fetchAll();
			
							foreach($result1 as $row1){
								$nomepaciente = $row1['nomecompleto'];
								
								?>
								<div class="card">
									<div class="card-header">
										<?php echo $nomepaciente; ?>
									</div>
									<div class="card-body">
									
										<form method="post" action="evolucaoPaciente.php">
											<input type="hidden" id="cpfpaciente"   name="cpfpaciente"   value="<?php echo $cpfpaciente; ?>">
											<input type="hidden" id="cpfenfermeiro" name="cpfenfermeiro" value="<?php echo $cpfenfermeiro; ?>">
											<input type="hidden" id="tipo"          name="tipo"          value="<?php echo $tipo; ?>">
											
											<button type="submit" class="btn btn-primary">Evoluir</button>
										</form>
										
										<?php
										if($tipo == "Enfermeiro"){
											if(empty($row['cpftecnico'])){
												?>
												<form method="post" action="associacaoTecnico.php">
													<input type="hidden" id="cpfpaciente" name="cpfpaciente" value="<?php echo $cpfpaciente; ?>">
													<button type="submit" class="btn btn-primary">Associar técnico</button>
												</form>
												<?php
											}
											else{
											
												$sql2 = 'SELECT nomecompleto FROM profissionais WHERE cpf = :cpftecnico';
												$stmt2 = $conn->prepare($sql2);
												$stmt2->bindValue(':cpftecnico', $cpftecnico);
												$stmt2->execute();
												$count2 = $stmt2->rowCount();
		
												if($count2 > 0){
													$result2 = $stmt2->fetchAll();
			
													foreach($result2 as $row2){
														$nometecnico = $row2['nomecompleto'];
														?>
														<dl class="row">
															<dt class="col-sm-3">Técnico responsável</dt>
															<dd class="col-sm-9"><?php echo $nometecnico; ?></dd>
														</dl>
														<?php
													}
													
													?>
													<form method="post" action="associacaoTecnico.php">
														<input type="hidden" id="cpfpaciente" name="cpfpaciente" value="<?php echo $cpfpaciente; ?>">
														<button type="submit" class="btn btn-primary btn-block">Associar técnico</button>
													</form>
													<?php
												}
											}
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
			
			<?php
			if($tipo == "Médico"){
				?>
				<div class="row">
					<p class="h5">A internar</p>
					
					<?php
					$status = "Solicitada";
					
					$sql = 'SELECT * FROM internacoes WHERE status = :status';
					$stmt = $conn->prepare($sql);
					$stmt->bindValue(':status', $status);
					$stmt->execute();
					$count = $stmt->rowCount();
		
					if($count > 0){
						$result = $stmt->fetchAll();
			
						foreach($result as $row){
							$cpfpaciente = $row['cpfpaciente'];
							
							$sql1 = 'SELECT nomecompleto FROM pacientes WHERE cpf = :cpfpaciente';
							$stmt1 = $conn->prepare($sql1);
							$stmt1->bindValue(':cpfpaciente', $cpfpaciente);
							$stmt1->execute();
							$count1 = $stmt1->rowCount();
		
							if($count1 > 0){
								$result1 = $stmt1->fetchAll();
			
								foreach($result1 as $row1){
									$nomepaciente = $row1['nomecompleto'];
									
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
												<button type="button" class="btn btn-primary btn-block">Internar</button>
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
				<?php
			}
			?>
		</div>
		<div class="col-md-4">
		
			<?php
			if($tipo == "Enfermeiro"){
				$cpfprofissional = $_SESSION['cpf'];
				
				include './conexao.php';
				
				$conn = getConnection();
				
				$actual = time();
		
				$sql = 'SELECT * FROM plantoes WHERE diahorarioinicio < :actual AND diahorariofim > :actual';
				$stmt = $conn->prepare($sql);
				$stmt->bindValue(':actual', $actual);
				$stmt->execute();
				$count = $stmt->rowCount();
		
				if($count > 0){
					$result = $stmt->fetchAll();
			
					foreach($result as $row){
						
						$idplantao = $row['id'];
						$chefe = 1;
							
						$sql1 = 'SELECT * FROM profissionaisplantao WHERE cpfprofissional = :cpfprofissional';
						$stmt1 = $conn->prepare($sql1);
						$stmt1->bindValue(':cpfprofissional', $cpfprofissional);
						$stmt1->bindValue(':chefe', $chefe);
						$stmt1->execute();
						$count1 = $stmt1->rowCount();
		
						if($count1 > 0){
							$result1 = $stmt1->fetchAll();
			
							foreach($result1 as $row1){
							
								$idplantao = $row1['id'];
								$chefe = $row1['chefe'];
								
								if($chefe == 1){
									?>
									<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'gerenciamentoInternacoes.php';">Gerenciar internações</button>
									<?php
								}
								else{
									//Está escalado para o plantão porém não é o chefe, portanto não pode gerenciar internações
								}
							}
						}
						else{
							?>
							<div class="alert alert-primary" role="alert">
								Você não está escalado(a) para o plantão atual
							</div>
							<?php
						}
					}
				}
			?>
		
				<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'evolucoesEnfermeiro.php';">
					Minhas evoluções
				</button>
			
				<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'diagnosticoEnfermeiro.php';">
					Meus diagnósticos
				</button>
			
				<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'anamneseEnfermeiro.php';">
					Minhas anamneses
				</button>
			
			<?php	
			}
			if($tipo == "Médico"){
				?>
				<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'consultasMedico.php';">
					Minhas consultas
				</button>
			
				<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'examesMedico.php';">
					Meus exames
				</button>
				
				<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'procedimentosMedico.php';">
					Meus procedimentos
				</button>
			
				<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'pacientesMedico.php';">
					Meus pacientes
				</button>
			
				<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'minhasAnamneses.php';">
					Minhas anamneses
				</button>
			
				<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'minhasEvolucoes.php';">
					Minhas evoluções
				</button>
			
				<?php
				include './conexao.php';
			
				$cpfmedico  = $_SESSION['cpf'];
				$diahorario = time();
				
				$conn = getConnection();
				
				$sql = 'SELECT * FROM plantoes WHERE diahorarioinicio < :diahorario AND diahorariofim > :diahorario';
				$stmt = $conn->prepare($sql);
				$stmt->bindValue(':diahorario', $diahorario);
				$stmt->execute();
				$count = $stmt->rowCount();
		
				if($count > 0){
					$result = $stmt->fetchAll();
			
					foreach($result as $row){
						
						$idplantao = $row['id'];
						
						$sql1 = 'SELECT * FROM profissionaisplantao WHERE idplantao = :idplantao AND cpfprofissional = :cpfprofissional';
						$stmt1 = $conn->prepare($sql1);
						$stmt1->bindValue(':idplantao'      , $idplantao);
						$stmt1->bindValue(':cpfprofissional', $cpfmedico);
						$stmt1->execute();
						$count1 = $stmt1->rowCount();
		
						if($count1 > 0){
							//Está escalado para o plantão atual, portanto pode realizar internações.
							?>
							
							<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'gerenciamentoInternacoes.php';">
								Gerenciar internações
							</button>
							<?php
						}
						else{
							?>
							<div class="alert alert-primary" role="alert">
								Você não está escalado(a) para o plantão atual
							</div>
							<?php
						}	
					}
				}
			}
			?>
		
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