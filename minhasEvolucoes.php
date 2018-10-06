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
			<h5 class="display-4">Área do médico</h5>
		</div>
	</div>
	<div class="row">
		<div class="col-md-8">
		
			<div class="row">
			<?php
				$cpfprofissional = $_SESSION['cpf'];
				
				include './conexao.php';
				
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
		
			<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'consultasMedico.php';">Minhas consultas</button>
			
			<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'examesMedico.php';">Meus exames</button>
			
			<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'procedimentosMedico.php';">Meus procedimentos</button>
			
			<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'pacientesMedico.php';">Meus pacientes</button>
			
			<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'minhasAnamneses.php';">Minhas anamneses</button>
			
			<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'minhasEvolucoes.php';">Minhas evoluções</button>
			
			<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'realizarInternacao.php';">Realizar internação</button>
			
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