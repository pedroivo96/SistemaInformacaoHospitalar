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

    <title>Meus exames</title>

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
				Menu do médico
				<small class="text-muted">Meus exames</small>
			</h3>
		</div>
	</div>
	<div class="row">
		<div class="col-md-9">
			
			<div class="row">
			<?php
				include './conexao.php';
				
				$cpfmedico = $_SESSION['cpf'];
					
				$conn = getConnection();
				$haExame = false;
					
				$sql = 'SELECT id FROM consultas WHERE cpfmedico = :cpfmedico';
				$stmt = $conn->prepare($sql);
				$stmt->bindValue(':cpfmedico', $cpfmedico);
				$stmt->execute();
				$count = $stmt->rowCount();
		
				if($count > 0){
					$result = $stmt->fetchAll();
			
					foreach($result as $row){
						$idconsulta = $row['id'];
						
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
										$nomeexame          = $row2['nomeexame'];
										$status             = $row2['status'];
										$anotacoesopcionais = $row2['anotacoesopcionais'];
										$nomemedico         = obterNomeMedico($cpfmedico);
											
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
														
														<label for="exampleInputEmail1">Anotações opcionais:</label>
														<h6 class="card-text" id="especialidade" name="especialidade">
															<?php echo $anotacoesopcionais; ?>
														</h6>
														
														<label for="exampleInputEmail1">Solicitado por:</label>
														<h6 class="card-text" id="especialidade" name="especialidade">
															<?php echo $nomemedico; ?>
														</h6>
													</div>
													
													<?php
													if($status == "Solicitado"){
														?>
														<div class="card-footer bg-dark text-white border-success"><?php echo $status; ?></div>
														<?php
													}
													if($status == "Resultado"){
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
				else{
					?>
					<div class="alert alert-warning w-100 text-center" role="alert">
						<b>Você não realizou nenhuma consulta<br/>
						Obs: Exames são solicitados durante as consultas.</b>
					</div>
					<?php
				}
					
				if($haExame == false){
					?>
					<div class="alert alert-warning w-100 text-center" role="alert">
						<b>Não há registro de exames.</b>
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
		<div class="col-md-3">
			
			<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'menuMedico.php';">
				Minhas informações
			</button>
			
			<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'consultasMedico.php';">
				Minhas consultas
			</button>
			
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
			
				$cpfmedico  = $_SESSION['cpf'];
				$diahorario = time();
				
				$conn = getConnection();
				
				$sql = 'SELECT * FROM plantoes WHERE diahorarioinicio < :diahorario1 AND diahorariofim > :diahorario2';
				$stmt = $conn->prepare($sql);
				$stmt->bindValue(':diahorario1', $diahorario);
				$stmt->bindValue(':diahorario2', $diahorario);
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
							<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'realizarInternacao.php';">
								Realizar internação
							</button>
							
							<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'gerenciamentoInternacoes.php';">
								Gerenciar internações
							</button>
							<?php
						}
						else{
							?>
							<div class="alert alert-primary" role="alert">
								Você não está escalado para o plantão atual
							</div>
							<?php
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