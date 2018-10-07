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

    <title>Atendimento</title>

    <meta name="description" content="Source code generated using layoutit.com">
    <meta name="author" content="LayoutIt!">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
	<link href="css/bootstrap.css" rel="stylesheet">
	
	<script src="js/jquery-3.3.1.min.js"></script>
	
	<script>
	
		function mostrarSetores() {
			var setores = document.getElementById('setorescomvagas');
			
			setores.style.display = "block";
		}
		
		function ocultarSetores() {
			var setores = document.getElementById('setorescomvagas');
			
			setores.style.display = "none";
		}
	
	</script>

  </head>
  <body>

    <div class="container-fluid">
	<div class="row mb-5 mt-5">
		<div class="col-md-12 border" align="center">
			<h5 class="display-4">Atendimento</h5>
		</div>
	</div>
	<div class="row">
	
		<div class="col-md-8">
			
			<?php
				include './conexao.php';
	
				if(!empty($_POST)){
					
					$id           = $_POST['id'];
					$cpfmedico    = $_POST['cpfmedico'];
					$cpfpaciente  = $_POST['cpfpaciente'];
					$nomemedico   = $_POST['nomemedico'];
					$nomepaciente = $_POST['nomepaciente'];
					
				}else{
					
					$id           = $_SESSION['id'];
					$cpfmedico    = $_SESSION['cpfmedico'];
					$cpfpaciente  = $_SESSION['cpfpaciente'];
					$nomemedico   = $_SESSION['nomemedico'];
					$nomepaciente = $_SESSION['nomepaciente'];
				}
			?>
			
			<div class="row">
	
				<div class="col-md-2">
				</div>
				
				<div class="col-md-8">
					<dl class="row">
						<dt class="col-sm-5">ID</dt>
						<dd class="col-sm-7"><?php echo $id; ?></dd>

						<dt class="col-sm-5">Nome do médico</dt>
						<dd class="col-sm-7"><?php echo $nomemedico; ?></dd>
				
						<dt class="col-sm-5">Nome do paciente</dt>
						<dd class="col-sm-7"><?php echo $nomepaciente; ?></dd>
					</dl>
			
					<form class="mb-4" method="post" action="finalizarAtendimento.php">
					
						<input type="hidden" id="idconsulta"   name="idconsulta"   value="<?php echo $id; ?>">
						<input type="hidden" id="cpfmedico"    name="cpfmedico"    value="<?php echo $cpfmedico; ?>">
						<input type="hidden" id="cpfpaciente"  name="cpfpaciente"  value="<?php echo $cpfpaciente; ?>">
						<input type="hidden" id="nomemedico"   name="nomemedico"   value="<?php echo $nomemedico; ?>">
						<input type="hidden" id="nomepaciente" name="nomepaciente" value="<?php echo $nomepaciente; ?>">
					
						<div class="form-group">
							<label for="queixaprincipal">Queixa principal</label>
							<textarea rows="4" class="form-control" id="queixaprincipal" name="queixaprincipal"></textarea>
						</div>
				
						<div class="form-group">
							<label for="exameclinico">Exame clínico</label>
							<input type="text" class="form-control" id="exameclinico" name="exameclinico">
						</div>
				
						<div class="form-group">
							<label for="diagnosticoprovavel">Diagnóstico provável</label>
							<input type="text" class="form-control" id="diagnosticoprovavel" name="diagnosticoprovavel">
						</div>
						
						<div class="btn-group-vertical">
							<button type="button" class="btn btn-primary" onclick="ocultarSetores();">
								Alta
							</button>
							
							<button type="button" class="btn btn-primary" onclick="mostrarSetores();">
								Internação
							</button>
						</div>
						
						<?php
							include './conexao.php';
				
							$conn = getConnection();
							$status = "Livre";
					
							$sql = 'SELECT * FROM leitos WHERE status = :status GROUP BY idsetor';
					
							$stmt = $conn->prepare($sql);
							$stmt->bindValue(':status', $status);
							$stmt->execute();
							$count = $stmt->rowCount();
		
							if($count > 0){
								$result = $stmt->fetchAll();
			
								?>
								<div class="form-group" id="setorescomvagas">
									<label for="label">Setores com vagas</label>
									<div class="btn-group-vertical btn-group-toggle btn-block" data-toggle="buttons">
								<?php
								foreach($result as $row){
									$idleito = $row['id'];
									$idsetor = $row['idsetor'];
									
									$sql1 = 'SELECT nome FROM setores WHERE id = :idsetor';
					
									$stmt1 = $conn->prepare($sql1);
									$stmt1->bindValue(':idsetor', $idsetor);
									$stmt1->execute();
									$count1 = $stmt1->rowCount();
		
									if($count1 > 0){
										$result1 = $stmt1->fetchAll();
			
										foreach($result1 as $row1){
											$nomesetor = $row1['nome'];
											?>
											<label class="btn btn-secondary btn-block">
												<input type="radio" 
												       id="<?php echo $idsetor; ?>" 
												       name="setor" 
													   autocomplete="off" 
													   value="<?php echo $nomesetor; ?>"> <?php echo $nomesetor; ?>
													   
												<input type="hidden" id="idsetor" name="idsetor" value="<?php echo $idsetor; ?>">
											</label>
											<?php
										}
									}
								}
								?>
									</div>
								</div>
								<?php
							}
							else{
								echo '<div class="alert alert-danger btn-block">
										<strong>Erro!</strong> Não existem setores com vagas.
									  </div>';
							}
						?>
						<!--
						<div class="form-group">
							<label for="especialidade"></label>
							<div class="btn-group-vertical btn-group-toggle btn-block" data-toggle="buttons">
								<label class="btn btn-secondary btn-block">
									<input type="radio" id="radio1" name="altainternacao" autocomplete="off" value="Alta"> Alta
								</label>
								<label class="btn btn-secondary btn-block">
									<input type="radio" id="radio2" name="altainternacao" autocomplete="off" value="Internação"> Internação
								</label>
							</div>
						</div>
						-->
				
						<button type="submit" class="btn btn-primary  btn-block">Finalizar</button>
					</form>
					
					<form class="mb-4" method="post" action="solicitarExame.php">
					
						<input type="hidden" id="idconsulta"   name="idconsulta"   value="<?php echo $id; ?>">
						<input type="hidden" id="cpfmedico"    name="cpfmedico"    value="<?php echo $cpfmedico; ?>">
						<input type="hidden" id="cpfpaciente"  name="cpfpaciente"  value="<?php echo $cpfpaciente; ?>">
						<input type="hidden" id="nomemedico"   name="nomemedico"   value="<?php echo $nomemedico; ?>">
						<input type="hidden" id="nomepaciente" name="nomepaciente" value="<?php echo $nomepaciente; ?>">
					
						<div class="form-group">
							<label for="nomeexame">Nome do exame</label>
							<input type="text" class="form-control" id="nomeexame" name="nomeexame">
						</div>
						
						<div class="form-group">
							<label for="nomeexame">Anotações opcionais</label>
							<input type="text" class="form-control" id="anotacoesopcionais" name="anotacoesopcionais">
						</div>
				
						<button type="submit" class="btn btn-primary  btn-block">Solicitar</button>
					</form>
					
					<form class="mb-4" method="post" action="solicitarProcedimento.php">
						
						<input type="hidden" id="idconsulta" name="idconsulta" value="<?php echo $id; ?>">
						<input type="hidden" id="cpfmedico"   name="cpfmedico"   value="<?php echo $cpfmedico; ?>">
						<input type="hidden" id="cpfpaciente" name="cpfpaciente" value="<?php echo $cpfpaciente; ?>">
						<input type="hidden" id="nomemedico"   name="nomemedico"   value="<?php echo $nomemedico; ?>">
						<input type="hidden" id="nomepaciente" name="nomepaciente" value="<?php echo $nomepaciente; ?>">
						
						<div class="form-group">
							<label for="nomeprocedimento">Nome do procedimento</label>
							<input type="text" class="form-control" id="nomeprocedimento" name="nomeprocedimento">
						</div>
						
						<div class="form-group">
							<label for="nomeexame">Anotações opcionais</label>
							<input type="text" class="form-control" id="anotacoesopcionais" name="anotacoesopcionais">
						</div>
				
						<button type="submit" class="btn btn-primary  btn-block">Solicitar</button>
					</form>
					
					<form class="mb-4" method="post" action="prescreverMedicamento.php">
						
						<input type="hidden" id="idconsulta" name="idconsulta" value="<?php echo $id; ?>">
						<input type="hidden" id="cpfmedico"   name="cpfmedico"   value="<?php echo $cpfmedico; ?>">
						<input type="hidden" id="cpfpaciente" name="cpfpaciente" value="<?php echo $cpfpaciente; ?>">
						<input type="hidden" id="nomemedico"   name="nomemedico"   value="<?php echo $nomemedico; ?>">
						<input type="hidden" id="nomepaciente" name="nomepaciente" value="<?php echo $nomepaciente; ?>">
						
						<div class="form-group">
							<label for="nomemedicamento">Nome do medicamento</label>
							<input type="text" class="form-control" id="nomemedicamento" name="nomemedicamento">
						</div>
						
						<div class="form-group">
							<label for="quantidade">Quantidade</label>
							<input type="text" class="form-control" id="quantidade" name="quantidade">
						</div>
						
						<div class="form-group">
							<label for="vezesaodia">Número de vezes ao dia</label>
							<input type="text" class="form-control" id="vezesaodia" name="vezesaodia">
						</div>
				
						<button type="submit" class="btn btn-primary btn-block">Prescrever</button>
					</form>
					
					<p class="h4 border-bottom">Exames solicitados</p>
					
					<?php
					
						$status = "Solicitado";
					
						$conn = getConnection();
		
						$sql = 'SELECT nomeexame FROM exames WHERE idconsulta = :idconsulta AND status = :status';
						$stmt = $conn->prepare($sql);
						$stmt->bindValue(':idconsulta' , $id);
						$stmt->bindValue(':status'     , $status);
						$stmt->execute();
						$count = $stmt->rowCount();
		
						if($count > 0){
							$result = $stmt->fetchAll();
			
							?>
								<ul class="list-group">
							<?php
			
							foreach($result as $row){
								$nomeexame = $row['nomeexame'];
								
								?>
								<li class="list-group-item"><?php echo $nomeexame; ?></li>
								<?php
							}
							
							?>
								</ul>
							<?php
						}
					?>
					
					<p class="h4 border-bottom">Procedimentos solicitados</p>
					
					<?php
					
						$status = "Solicitado";
					
						$conn = getConnection();
		
						$sql = 'SELECT nomeprocedimento FROM procedimentos WHERE idconsulta = :idconsulta AND status = :status';
						$stmt = $conn->prepare($sql);
						$stmt->bindValue(':idconsulta' , $id);
						$stmt->bindValue(':status'     , $status);
						$stmt->execute();
						$count = $stmt->rowCount();
		
						if($count > 0){
							$result = $stmt->fetchAll();
			
							?>
								<ul class="list-group">
							<?php
			
							foreach($result as $row){
								$nomeprocedimento = $row['nomeprocedimento'];
								
								?>
								<li class="list-group-item"><?php echo $nomeprocedimento; ?></li>
								<?php
							}
							
							?>
								</ul>
							<?php
						}
					?>
					
					<p class="h4 border-bottom">Prescrições de medicamentos</p>
					
					<?php
					
						$conn = getConnection();
		
						$sql = 'SELECT nomemedicamento FROM prescricoes WHERE idconsulta = :idconsulta';
						$stmt = $conn->prepare($sql);
						$stmt->bindValue(':idconsulta' , $id);
						$stmt->execute();
						$count = $stmt->rowCount();
		
						if($count > 0){
							$result = $stmt->fetchAll();
			
							?>
								<ul class="list-group">
							<?php
			
							foreach($result as $row){
								$nomemedicamento = $row['nomemedicamento'];
								
								?>
								<li class="list-group-item"><?php echo $nomemedicamento; ?></li>
								<?php
							}
							
							?>
								</ul>
							<?php
						}
					?>
					
				</div>
				
				<div class="col-md-2">
				</div>
			</div>
			
		</div>
		
		<div class="col-md-4">
			<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'consultasMedico.php';">Minhas consultas</button>
			
			<button type="button" class="btn btn-primary btn-lg btn-block">Meus exames</button>
			
			<button type="button" class="btn btn-primary btn-lg btn-block">Meus procedimentos</button>
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