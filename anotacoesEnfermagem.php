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
			header("Location: loginPaciente.html"); 
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
			<?php
			
				$cpfprofissional = $_SESSION['cpf'];
				
				$conn = getConnection();
			
				$sql = 'SELECT tipo FROM profissionais WHERE cpf = :cpfprofissional';
				$stmt = $conn->prepare($sql);
				$stmt->bindValue(':cpfprofissional', $cpfprofissional);
				$stmt->execute();
				$count = $stmt->rowCount();
		
				if($count > 0){
					$result = $stmt->fetchAll();
			
					foreach($result as $row){
						$tipo = $row['tipo'];
						
						if($tipo == "Enfermeiro"){
						?>
							<h3>
								Menu do enfermeiro
								<small class="text-muted">Minhas anotações</small>
							</h3>
						<?php
						}
						if($tipo == "Técnico em Enfermagem"){
						?>
							<h3>
								Menu do técnico em enfermagem
								<small class="text-muted">Minhas anotações</small>
							</h3>
						<?php
						}
					}
				}
			?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-8">
			
			<div class="row">
			<?php
				$cpfprofissional = $_SESSION['cpf'];
				
				$sql = 'SELECT cpfpaciente FROM anotacoesenfermagem WHERE cpfprofissional = :cpfprofissional GROUP BY cpfpaciente';
				$stmt = $conn->prepare($sql);
				$stmt->bindValue(':cpfprofissional', $cpfprofissional);
				$stmt->execute();
				$count = $stmt->rowCount();
		
				if($count > 0){
					$result = $stmt->fetchAll();
			
					foreach($result as $row){
						$cpfpaciente = $row['cpfpaciente'];
						
						$sql1 = 'SELECT nomecompleto FROM pacientes WHERE cpf = :cpfpaciente';
						$stmt1 = $conn->prepare($sql1);
						$stmt1->bindValue(':cpfpaciente', $cpfpaciente);
						$stmt1->execute();
						$count1 = $stmt1->rowCount();
		
						if($count1 > 0){
							foreach($result1 as $row1){
								$nomepaciente = $row1['nomecompleto'];
						
								$sql1 = 'SELECT * FROM anotacoesenfermagem WHERE cpfprofissional = :cpfprofissional AND cpfpaciente = :cpfpaciente';
								$stmt1 = $conn->prepare($sql1);
								$stmt1->bindValue(':cpfprofissional', $cpfprofissional);
								$stmt1->bindValue(':cpfpaciente'    , $cpfpaciente);
								$stmt1->execute();
								$count1 = $stmt1->rowCount();
		
								if($count1 > 0){
									$result1 = $stmt1->fetchAll();
							
									?>
									<div class="col-sm-4 mb-3">
									<div class="card">
								
										<div class="card-header">
											<?php echo $nomepaciente; ?>
										</div>
								
										<ul class="list-group list-group-flush">
									
									<?php
									foreach($result1 as $row1){
										$conteudo = $row1['conteudo'];
										$diahorario = $row1['diahorario'];
											?>
											<li class="list-group-item">
												<?php echo $conteudo; ?>
											</li>
											<?php
									}
									?>
										</ul>
									</div>
									</div>
									<?php							
								}
								
							}
						}	
					}
				}
			?>	
			</div>
			
		</div>
		<div class="col-md-4">
		
			<?php
				if($_SESSION['tipo'] == "Enfermeiro"){
					include 'menuEnfermeiroInclude.html';
				}
				else{
					include 'menuTecnicoInclude.html';
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