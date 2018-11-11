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

    <div class="container-fluid">
	<div class="row mb-5 mt-5">
		<div class="col-md-12 border" align="center">
			<h3>
				<?php
				$tipo = $_SESSION['tipo'];
				
				if($tipo == "Médico"){
					?>
					Menu do médico
					<?php
				}
				else{
					?>
					Menu do enfermeiro
					<?php
				}
				?>
				<small class="text-muted">Minhas evoluções</small>
			</h3>
		</div>
	</div>
	<div class="row">
		<div class="col-md-9">
		
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
		
		<div class="col-md-3">
			<?php
			$tipo = $_SESSION['tipo'];
				
			if($tipo == "Médico"){
				include 'menuMedicoInclude.php';
			}
			else{
				include 'menuEnfermeiroInclude.php';
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