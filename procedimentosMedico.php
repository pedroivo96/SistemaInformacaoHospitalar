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
	
	<div class="row mb-5 mt-2">
		<div class="col-md-12 border" align="center">
			<h3>
				Menu do médico
				<small class="text-muted">Meus procedimentos</small>
			</h3>
		</div>
	</div>
	<div class="row">
		<div class="col-md-9">
			
			<div class="row">
				<?php
				
					$cpfmedico = $_SESSION['cpf'];
					$haExame = false;
					
					$conn = getConnection();
					
					$sql = 'SELECT id, cpfpaciente FROM consultas WHERE cpfmedico = :cpfmedico';
					$stmt = $conn->prepare($sql);
					$stmt->bindValue(':cpfmedico', $cpfmedico);
					$stmt->execute();
					$count = $stmt->rowCount();
		
					if($count > 0){
						$result = $stmt->fetchAll();
			
						foreach($result as $row){
							
							$idconsulta = $row['id'];
							$cpfpaciente  = $row['cpfpaciente'];
							
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
							
											$nomeprocedimento   = $row2['nomeprocedimento'];
											$status             = $row2['status'];
											$anotacoesopcionais = $row2['anotacoesopcionais'];
											$nomemedico         = obterNomeMedico($cpfmedico);
											$nomepaciente       = obterNomePaciente($cpfpaciente);
											
											?>
											<div class="col-sm-4 mb-3">
												<div class="card border-secondary">
													<div class="card-header">
														<label for="nomecompleto">Nome do procedimento:</label>
														<h5 class="card-title" id="nomecompleto" name="nomecompleto">
															<?php echo $nomeprocedimento; ?>
														</h5>
													</div>
													
													<div class="card-body">
														
														<label for="exampleInputEmail1">Anotações opcionais:</label>
														<h6 class="card-text" id="especialidade" name="especialidade">
															<?php echo $anotacoesopcionais; ?>
														</h6>
														
														<label for="exampleInputEmail1">Solicitado ao paciente:</label>
														<h6 class="card-text" id="especialidade" name="especialidade">
															<?php echo $nomepaciente; ?>
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
					
					function obterNomePaciente($cpfpaciente){
						$sql = 'SELECT nomecompleto FROM pacientes WHERE cpf = :cpfpaciente';
						
						$conn = getConnection();
						
						$stmt = $conn->prepare($sql);
						$stmt->bindValue(':cpfpaciente', $cpfpaciente);
						$stmt->execute();
						$count = $stmt->rowCount();
		
						if($count > 0){
							$result = $stmt->fetchAll();
			
							foreach($result as $row){
								$nomepaciente = $row['nomecompleto'];
								
								return $nomepaciente;
							}
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