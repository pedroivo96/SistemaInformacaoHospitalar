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

    <title>Consultas</title>

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
				<small class="text-muted">Minhas consultas</small>
			</h3>
		</div>
	</div>
	<div class="row">
	
		<div class="col-md-8">
			
			<div class="row">
				<?php
				
					date_default_timezone_set("America/Fortaleza"); 
				
					include './conexao.php';
				
					$cpfpaciente = $_SESSION['cpf'];
					
					$conn = getConnection();
					
					$sql = 'SELECT * FROM consultas WHERE cpfpaciente = :cpfpaciente';
					$stmt = $conn->prepare($sql);
					$stmt->bindValue(':cpfpaciente', $cpfpaciente);
					$stmt->execute();
					$count = $stmt->rowCount();
		
					if($count > 0){
						$result = $stmt->fetchAll();
			
						foreach($result as $row){
							
							$cpfmedico        = $row['cpfmedico'];
							$status           = $row['status'];
							$id               = $row['id'];
							$diahorarioinicio = $row['diahorarioinicio'];
							$diahorariofim    = $row['diahorariofim'];
							
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
												
												<label for="nomecompleto">Nome do médico:</label>
												<h5 class="card-title" id="nomecompleto" name="nomecompleto">
													<?php echo $nomemedico; ?>
												</h5>
											</div>
											
											<div class="card-body">
												
												<input type="hidden" id="cpf"              name="cpf"              value="<?php echo $cpf; ?>">
												<input type="hidden" id="diahorarioinicio" name="diahorarioinicio" value="<?php echo $diahorarioinicio; ?>">
												<input type="hidden" id="diahorariofim"    name="diahorariofim"    value="<?php echo $diahorariofim; ?>">
												
												<label for="exampleInputEmail1">Especialidade:</label>
												<h6 class="card-text" id="especialidade" name="especialidade">
													<?php echo $especialidade; ?>
												</h6>
												
												<label for="exampleInputEmail1">Dia:</label>
												<h6 class="card-text" id="especialidade" name="especialidade">
													<?php echo date("d/m/y",$diahorarioinicio); ?>
													a
													<?php echo date("d/m/y",$diahorariofim); ?>
												</h6>
												
												<label for="exampleInputEmail1">Horário:</label>
												<h6 class="card-text" id="especialidade" name="especialidade">
													<?php echo "Das ".date("H:i:s",$diahorarioinicio)." às ".date("H:i:s",$diahorariofim); ?>
												</h6>
												
											</div>
											
											<?php
												if($status == "Agendada"){
													?>
													<div class="card-footer bg-info text-white border-success"><?php echo $status; ?></div>
													<?php
												}
												if($status == "Realizada"){
													?>
													<div class="card-footer bg-success text-white border-success"><?php echo $status; ?></div>
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
					else{
						echo '<div class="alert alert-primary btn-block">
								<strong>Você não tem nenhuma consulta agendada!</strong>
                              </div>';
					}
				?>
			</div>
			
		</div>
		
		<div class="col-md-4">
			<button type="button" class="btn btn-success btn-lg btn-block" onclick="location.href = 'buscarMedico.html';">Nova consulta</button>
			
			<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'examesPaciente.php';">Exames</button>
			
			<button type="button" class="btn btn-primary btn-lg btn-block">Procedimentos</button>
			
			<button type="button" class="btn btn-primary btn-lg btn-block">Prontuário</button>
			
			<button type="button" class="btn btn-danger btn-lg btn-block" onclick="location.href = 'sair.php';">Sair</button>
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