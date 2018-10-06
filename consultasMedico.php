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
			<h3>
				Menu do médico
				<small class="text-muted">Consultas</small>
			</h3>
		</div>
	</div>
	<div class="row">
		<div class="col-md-8">
			
			<p class="h4 border-bottom">Consultas agendadas</p>
			
			<div class="row">
			
			<?php
				include './conexao.php';
				
				$cpfmedico = $_SESSION['cpf'];
				$status    = "Agendada";
				$nomemedico = $_SESSION['nomecompleto'];
				
				$conn = getConnection();
		
				$sql = 'SELECT * FROM consultas WHERE cpfmedico = :cpfmedico AND status = :status';
				$stmt = $conn->prepare($sql);
				$stmt->bindValue(':cpfmedico', $cpfmedico);
				$stmt->bindValue(':status'   , $status);
				$stmt->execute();
				$count = $stmt->rowCount();
		
				if($count > 0){
					$result = $stmt->fetchAll();
			
					foreach($result as $row){
						
						$id               = $row['id'];
						$cpfpaciente      = $row['cpfpaciente'];
						$diahorarioinicio = $row['diahorarioinicio'];
						$diahorariofim    = $row['diahorariofim'];
						
						$especialidade    = $_SESSION['especialidade'];
						
						$sql1 = 'SELECT nomecompleto FROM pacientes WHERE cpf = :cpfpaciente';
						$stmt1 = $conn->prepare($sql1);
						$stmt1->bindValue(':cpfpaciente', $cpfpaciente);
						$stmt1->execute();
						$count1 = $stmt1->rowCount();
		
						if($count1 > 0){
							$result1 = $stmt1->fetchAll();
			
							foreach($result1 as $row1){
								$nomepaciente = $row1['nomecompleto'];
							}
						}
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
										
										<form  method="post" action="atenderPaciente.php">
										
											<input type="hidden" id="id"              name="id"             value="<?php echo $id; ?>">
											<input type="hidden" id="cpfmedico"       name="cpfmedico"      value="<?php echo $cpfmedico; ?>">
											<input type="hidden" id="cpfpaciente"     name="cpfpaciente"    value="<?php echo $cpfpaciente; ?>">
											<input type="hidden" id="nomemedico"      name="nomemedico"     value="<?php echo $nomemedico; ?>">
											<input type="hidden" id="nomepaciente"    name="nomepaciente"   value="<?php echo $nomepaciente; ?>">
										
											<label for="exampleInputEmail1">Especialidade:</label>
											<h6 class="card-text" id="especialidade" name="especialidade">
												<?php echo $especialidade; ?>
											</h6>
												
											<label for="exampleInputEmail1">Dia:</label>
											<h6 class="card-text" id="especialidade" name="especialidade">
												<?php echo date("d/m/y",$diahorarioinicio); ?>
											</h6>
												
											<label for="exampleInputEmail1">Horário:</label>
											<h6 class="card-text" id="especialidade" name="especialidade">
												<?php echo "Das ".date("H:i:s",$diahorarioinicio)." às ".date("H:i:s",$diahorariofim); ?>
											</h6>
										
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
													$stmt1->bindValue(':cpfprofissional', $cpfmedico);
													$stmt1->execute();
													$count1 = $stmt1->rowCount();
		
													if($count1 > 0){
													?>
														<button type="submit" class="btn btn-primary btn-block">Atender</button>
													<?php
													}
													else{
														//Não está escalado para o plantão atual, portanto não pode Atender um paciente.
													}
													
												}
											}
											?>
										</form>
									</div>
							</div>
						</div>
						
						<?php
					}
				}
			?>
			
			</div>
			
			<p class="h4 border-bottom">Consultas realizadas</p>
			
			<?php
			?>
			
		</div>
		<div class="col-md-4">
		
			<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'consultasMedico.php';">Minhas consultas</button>
			
			<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'examesMedico.php';">Meus exames</button>
			
			<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'procedimentosMedico.php';">Meus procedimentos</button>
			
			<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'pacientesMedico.php';">Meus pacientes</button>
			
			<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'minhasAnamneses.php';">Minhas anamneses</button>
			
			<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'minhasEvolucoes.php';">Minhas evoluções</button>
			
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