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

    <div class="container-fluid px-5 pb-5">
	
	<?php include 'campoPesquisaPaciente.html'?>	
	
	<div class="row mb-5 mt-2">
		<div class="col-md-12 border" align="center">
			<h3>
				Menu do médico
				<small class="text-muted">Minhas consultas</small>
			</h3>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-9">
			
			<p class="h4 border-bottom">Consultas agendadas</p>
			
			<div class="row">
			
			<?php
				date_default_timezone_set("America/Fortaleza");
				
				//Essa função diz se uma determinada data corresponde a ONTEM, HOJE ou AMANHÃ
				function diaParaNome($timestamp){
					$atual = time();
					
					$diaParametro = date("d", $timestamp);
					$diaHoje      = date("d", $atual);
					
					if($diaParametro == $diaHoje){
						return "Hoje";
					}
					if($diaParametro == ($diaHoje-1)){
						return "Ontem";
					}
					if($diaParametro == ($diaHoje+1)){
						return "Amanhã";
					}
					else{
						return date("d/m/Y", $timestamp);
					}
				} 
				
				$cpfmedico = $_SESSION['cpf'];
				$status    = "Agendada";
				$nomemedico = $_SESSION['nomecompleto'];
				
				$conn = getConnection();
		
				$sql = 'SELECT * FROM consultas WHERE cpfmedico = :cpfmedico AND status = :status ORDER BY id DESC';
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
										
									<form  method="post" action="">
										
										<label for="especialidade">Especialidade:</label>
										<h6 class="card-text" id="especialidade" name="especialidade">
											<?php echo $especialidade; ?>
										</h6>
												
										<label for="dia">Dia:</label>
										<h6 class="card-text" id="dia" name="dia">
											<?php echo diaParaNome($diahorarioinicio); ?>
										</h6>
												
										<label for="horario">Horário:</label>
										<h6 class="card-text" id="horario" name="horario">
											<?php echo "Das ".date("H:i:s",$diahorarioinicio)." às ".date("H:i:s",$diahorariofim); ?>
										</h6>
									</form>
								</div>
								
									<?php
									$diahorario = time();
											
									
									$sql2 = 'SELECT * FROM plantoes WHERE diahorarioinicio < :diahorario1 AND diahorariofim > :diahorario2';
									$stmt2 = $conn->prepare($sql2);
									$stmt2->bindValue(':diahorario1', $diahorario);
									$stmt2->bindValue(':diahorario2', $diahorario);
									$stmt2->execute();
									$count2 = $stmt2->rowCount();
		
									if($count2 > 0){
										$result2 = $stmt2->fetchAll();
			
										foreach($result2 as $row2){
											$idplantao = $row2['id'];
													
											$sql3 = 'SELECT * FROM profissionaisplantao WHERE idplantao = :idplantao AND cpfprofissional = :cpfprofissional';
											$stmt3 = $conn->prepare($sql3);
											$stmt3->bindValue(':idplantao'      , $idplantao);
											$stmt3->bindValue(':cpfprofissional', $cpfmedico);
											$stmt3->execute();
											$count3 = $stmt3->rowCount();
		
											if($count3 > 0){
											?>
												<form method="POST" action="atenderPaciente.php">
										
													<input type="hidden" id="id"              name="id"             value="<?php echo $id; ?>">
													<input type="hidden" id="cpfmedico"       name="cpfmedico"      value="<?php echo $cpfmedico; ?>">
													<input type="hidden" id="cpfpaciente"     name="cpfpaciente"    value="<?php echo $cpfpaciente; ?>">
													<input type="hidden" id="nomemedico"      name="nomemedico"     value="<?php echo $nomemedico; ?>">
													<input type="hidden" id="nomepaciente"    name="nomepaciente"   value="<?php echo $nomepaciente; ?>">
													
													<button type="submit" class="btn btn-primary btn-block" style="padding: 0.75rem 1.25rem; border-radius: 0 0 calc(0.25rem - 1px) calc(0.25rem - 1px);">
														Atender
													</button>
												</form>
											<?php
											}
											else{
												//Não está escalado para o plantão atual, portanto não pode Atender um paciente.
											}
										}
									}
									else{
										?>
										<div class="alert alert-primary" role="alert">
											Não há um plantão cadastrado para o horário atual.
										</div>
										<?php
									}
									?>
									
							</div>
						</div>
						<?php
					}
				}
				else{
					?>
					<div class="alert alert-primary w-100" role="alert">
						Você não tem nenhuma consulta agendada.
					</div>
					<?php
				}
			?>
			
			</div>
			
			<p class="h4 border-bottom">Consultas realizadas</p>
			
			<div class="row">
			<?php
				$cpfmedico = $_SESSION['cpf'];
				$status    = "Realizada";
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
												
											<label for="diahorarioinicio">Dia:</label>
											<h6 class="card-text" id="diahorarioinicio" name="diahorarioinicio">
												<?php echo date("d/m/y",$diahorarioinicio); ?>
											</h6>
												
											<label for="horario">Horário:</label>
											<h6 class="card-text" id="horario" name="horario">
												<?php echo "Das ".date("H:i:s",$diahorarioinicio)." às ".date("H:i:s",$diahorariofim); ?>
											</h6>
										</form>
									</div>
							</div>
						</div>
						<?php
					}
				}
				else{
					?>
					<div class="alert alert-primary w-100" role="alert">
						Você não tem nenhuma consulta realizada.
					</div>
					<?php
				}
			?>
			</div>
		</div>
		
		<div class="col-md-3">
			<?php include 'menuMedicoInclude.php'?>	
		</div>
		
	</div>
	
</div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
  </body>
</html>