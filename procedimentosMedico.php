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

    <title>Meus procedimentos</title>

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
				<small class="text-muted">Procedimentos</small>
			</h3>
		</div>
	</div>
	<div class="row">
		<div class="col-md-8">
			
			<div class="row">
			<?php
			
				include './conexao.php';
				
				$cpfmedico = $_SESSION['cpf'];
					
				$conn = getConnection();
					
				$sql = 'SELECT * FROM procedimentos WHERE cpfmedico = :cpfmedico';
				$stmt = $conn->prepare($sql);
				$stmt->bindValue(':cpfmedico', $cpfmedico);
				$stmt->execute();
				$count = $stmt->rowCount();
		
				if($count > 0){
					$result = $stmt->fetchAll();
			
					foreach($result as $row){
						$id                 = $row['id'];
						$cpfpaciente        = $row['cpfpaciente'];
						$nomeprocedimento   = $row['nomeprocedimento'];
						$status             = $row['status'];
						$anotacoesopcionais = $row['anotacoesopcionais'];
						$idconsulta         = $row['idconsulta'];
						
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
									
									<label for="status">Status:</label>
									<h6 class="card-text" id="status" name="status">
										<?php echo $status; ?>
									</h6>
								</div>
							</div>
						</div>
						<?php
					}
				}	
			?>
			</div>
			
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