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

    <title>Menu do Médico</title>

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
			include './conexao.php';
			
			$cpf = $_SESSION['cpf'];
			
			$conn = getConnection();
		
			$sql = 'SELECT nomecompleto, tipo FROM profissionais WHERE cpf = :cpf';
			$stmt = $conn->prepare($sql);
			$stmt->bindValue(':cpf', $cpf);
			$stmt->execute();
			$count = $stmt->rowCount();
		
			if($count > 0){
				$result = $stmt->fetchAll();
			
				foreach($result as $row){
					$tipo         = $row['tipo'];
					$nomecompleto = $row['nomecompleto'];
					
					if($tipo == "Médico"){
					?>
					<h3>
						Menu do médico
						<small class="text-muted">Evoluções</small>
					</h3>
					<?php
					}
					else{
					?>
					<h3>
						Menu do enfermeiro
						<small class="text-muted">Evoluções</small>
					</h3>
					<?php	
					}
				}	
			}
			
			?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-8">
		
			<div class="row">
			<?php
				$cpfprofissional = $_SESSION['cpf'];
				
				$conn = getConnection();
		
				$sql = 'SELECT * FROM evolucoes WHERE cpfprofissional = :cpfprofissional';
				$stmt = $conn->prepare($sql);
				$stmt->bindValue(':cpfprofissional', $cpfprofissional);
				$stmt->execute();
				$count = $stmt->rowCount();
		
				if($count > 0){
					$result = $stmt->fetchAll();
			
					foreach($result as $row){
						
						$cpfpaciente = $row['cpfpaciente'];
						$conteudo = $row['conteudo'];
						$diahorario = $row['diahorario'];
						
						$sql1 = 'SELECT nomecompleto FROM pacientes WHERE cpf = :cpf';
						$stmt1 = $conn->prepare($sql1);
						$stmt1->bindValue(':cpf', $cpfpaciente);
						$stmt1->execute();
						$count1 = $stmt1->rowCount();
		
						if($count1 > 0){
							$result1 = $stmt1->fetchAll();
			
							foreach($result1 as $row1){
								$nomepaciente = $row1['nomecompleto'];
								
								?>
								<div class="col-sm-6 mb-3">
									<div class="card border-secondary">
										<div class="card-header">
											<label for="nomecompleto">Nome do paciente:</label>
											<h5 class="card-title" id="nomecompleto" name="nomecompleto">
												<?php echo $nomepaciente; ?>
											</h5>
										</div>
								
										<div class="card-body">
											<label for="anotacoesopcionais">Conteúdo:</label>
											<h6 class="card-text" id="anotacoesopcionais" name="anotacoesopcionais">
												<?php echo $conteudo; ?>
											</h6>
											
											<label for="anotacoesopcionais">Data:</label>
											<h6 class="card-text" id="anotacoesopcionais" name="anotacoesopcionais">
												<?php echo date("d/m/y",$diahorario); ?>
											</h6>
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
			
		</div>
		<div class="col-md-4">
		
			<?php
			include './conexao.php';
			
			$cpf = $_SESSION['cpf'];
			
			$conn = getConnection();
		
			$sql = 'SELECT tipo FROM profissionais WHERE cpf = :cpf';
			$stmt = $conn->prepare($sql);
			$stmt->bindValue(':cpf', $cpf);
			$stmt->execute();
			$count = $stmt->rowCount();
		
			if($count > 0){
				$result = $stmt->fetchAll();
			
				foreach($result as $row){
					$tipo = $row['tipo'];
					
					if($tipo == "Médico"){
						?>
						<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'consultasMedico.php';">Minhas consultas</button>
			
						<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'examesMedico.php';">Meus exames</button>
			
						<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'procedimentosMedico.php';">Meus procedimentos</button>
			
						<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'pacientesMedico.php';">Meus pacientes</button>
			
						<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'minhasAnamneses.php';">Minhas anamneses</button>
				
						<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'minhasEvolucoes.php';">Minhas evoluções</button>
			
						<?php
						include './conexao.php';
			
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
								$stmt1->bindValue(':cpfprofissional', $cpf);
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
					}
					else{		
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
								$stmt1->bindValue(':chefe'          , $chefe);
								$stmt1->execute();
								$count1 = $stmt1->rowCount();
		
								if($count1 > 0){
									$result1 = $stmt1->fetchAll();
			
									foreach($result1 as $row1){
							
										$idplantao = $row1['id'];
										$chefe = $row1['chefe'];
								
										if($chefe == 1){
											?>
											<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'gerenciamentoInternacoes.php';">
												Gerenciar internações
											</button>
											<?php
										}
										else{
											//Está escalado para o plantão porém não é o chefe, portanto não pode gerenciar internações
										}
									}
								}
								else{
									//Não esta escalado para o plantão atual
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