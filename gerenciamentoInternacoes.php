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
			<h5 class="display-4">Gerenciamento de Internações</h5>
		</div>
	</div>
	<div class="row">
		<div class="col-md-8">
			
			<div class="row">
			<p class="h5">Internados</p>
			<?php
				$cpfprofissional = $_SESSION['cpf'];
				
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
											<button type="submit" class="btn btn-primary">Evoluir</button>
										</form>
										
										<?php
										if(empty($row['cpftecnico'])){
											?>
											<button type="button" class="btn btn-primary">Associar técnico</button>
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
			
			<div class="row">
			<p class="h5">A internar</p>
			<?php
				$cpfprofissional = $_SESSION['cpf'];
				
				include './conexao.php';
				
				$status = "Solicitada";
				
				$conn = getConnection();
		
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
						$stmt1->bindValue(':cpf', $cpfpaciente);
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
										<button type="button" class="btn btn-primary">Internar</button>
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
			<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'gerenciamentoInternacoes.php';">Gerenciar internações</button>
			
			<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'evolucoesEnfermeiro.php';">Minhas evoluções</button>
			
			<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'diagnosticoEnfermeiro.php';">Meus diagnósticos</button>
			
			<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'anamneseEnfermeiro.php';">Minhas anamneses</button>
			
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