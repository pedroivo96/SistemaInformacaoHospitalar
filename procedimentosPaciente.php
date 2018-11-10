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

    <title>Exames</title>

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
				<small class="text-muted">Meus procedimentos</small>
			</h3>
		</div>
	</div>
	<div class="row">
	
		<div class="col-md-9">
		
			<div class="row">
				<?php
				
					include './conexao.php';
				
					$cpfpaciente = $_SESSION['cpf'];
					$haExame = false;
					
					$conn = getConnection();
					
					$sql = 'SELECT id, cpfmedico FROM consultas WHERE cpfpaciente = :cpfpaciente';
					$stmt = $conn->prepare($sql);
					$stmt->bindValue(':cpfpaciente', $cpfpaciente);
					$stmt->execute();
					$count = $stmt->rowCount();
		
					if($count > 0){
						$result = $stmt->fetchAll();
			
						foreach($result as $row){
							
							$idconsulta = $row['id'];
							$cpfmedico  = $row['cpfmedico'];
							
							$sql1 = 'SELECT idprocedimento FROM consultaprocedimento WHERE idconsulta = :idconsulta';
							$stmt1 = $conn->prepare($sql1);
							$stmt1->bindValue(':idconsulta', $idconsulta);
							$stmt1->execute();
							$count1 = $stmt1->rowCount();
		
							if($count1 > 0){
								
								$haExame = true;
								
								$result1 = $stmt1->fetchAll();
			
								foreach($result1 as $row1){
							
									$idprocedimento = $row1['idprocedimento'];
									
									$sql2 = 'SELECT * FROM procedimentos WHERE id = :idprocedimento';
									$stmt2 = $conn->prepare($sql2);
									$stmt2->bindValue(':idprocedimento', $idprocedimento);
									$stmt2->execute();
									$count2 = $stmt2->rowCount();
		
									if($count2 > 0){
										$result2 = $stmt2->fetchAll();
			
										foreach($result2 as $row2){
							
											$nomeprocedimento = $row2['nomeprocedimento'];
											$status = $row2['status'];
											$anotacoesopcionais = $row2['anotacoesopcionais'];
											$nomemedico = obterNomeMedico($cpfmedico);
											
											?>
											<div class="col-sm-4 mb-3">
												<div class="card border-secondary">
													<div class="card-header">
														<label for="nomeprocedimento">Nome do procedimento:</label>
														<h5 class="card-title" id="nomeprocedimento" name="nomeprocedimento">
															<?php echo $nomeprocedimento; ?>
														</h5>
													</div>
													
													<div class="card-body">
														
														<label for="anotacoesopcionais">Anotações opcionais:</label>
														<h6 class="card-text" id="anotacoesopcionais" name="anotacoesopcionais">
															<?php echo $anotacoesopcionais; ?>
														</h6>
														
														<label for="nomemedico">Solicitado por:</label>
														<h6 class="card-text" id="nomemedico" name="nomemedico">
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
														<form method="POST" action="verResultadosProcedimento.php">
														
															<input type="hidden" id="idprocedimento" name="idprocedimento" value="<?php echo $idprocedimento; ?>">
														
															<button type="submit" class="btn btn-success btn-block" style="padding: 0.75rem 1.25rem; border-radius: 0 0 calc(0.25rem - 1px) calc(0.25rem - 1px);">
																Ver resultados
															</button>
														</form>
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
							<b>Você não foi a nenhum consulta<br/>
							Obs: Procedimentos são solicitados durante as consultas.</b>
						</div>
						<?php
					}
					
					if($haExame == false){
						?>
						<div class="alert alert-warning w-100 text-center" role="alert">
							<b>Não há registro de procedimentos.</b>
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
			<?php include 'menuPacienteInclude.php'; ?>
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