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

    <title>Resultados dos exames</title>

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
				<?php
				if(!isset($_SESSION["especialidade"])){
					?>
					Menu do paciente
					<?php
				}
				else{
					?>
					Menu do médico
					<?php
				}
				?>
				
				<small class="text-muted">Resultados dos exames</small>
			</h3>
		</div>
	</div>
	<div class="row">
	
		<div class="col-md-9">
			<?php
				if(!empty($_POST)){
		
					$conn = getConnection();
				
					$idexame = $_POST['idexame'];
		
					$sql = 'SELECT nomeexame, anotacoesopcionais FROM exames WHERE id = :idexame';
					$stmt = $conn->prepare($sql);
					$stmt->bindValue(':idexame', $idexame);
					$stmt->execute();
					$count = $stmt->rowCount();

					if($count > 0){
						
						$result = $stmt->fetchAll();
						
						foreach($result as $row){
				
							$nomeexame          = $row['nomeexame'];
							$anotacoesopcionais = $row['anotacoesopcionais'];
							?>
							<dl class="row">
								<dt class="col-sm-4">Nome do exame</dt>
								<dd class="col-sm-8"><?php echo $nomeexame; ?></dd>
								
								<dt class="col-sm-4">Anotações opcionais</dt>
								<dd class="col-sm-8"><?php echo $anotacoesopcionais; ?></dd>
							</dl>
							
							<p class="h3 border-bottom">Resultados</p>
							
							<?php

							$sql1 = 'SELECT nomeimagem FROM resultadosexames WHERE id = :idexame';
							$stmt1 = $conn->prepare($sql1);
							$stmt1->bindValue(':idexame', $idexame);
							$stmt1->execute();
							$count1 = $stmt1->rowCount();

							if($count1 > 0){
								?>
								<div class="row">
								<?php
								
								$result1 = $stmt1->fetchAll();
						
								foreach($result1 as $row1){
									$nomeimagem = $row1['nomeimagem'];
									
									//img/TIMESTAMP.formato
									      
									//           0            1
 									//Divide em img e TIMESTAMP.formato
									$nomeImagemArray1 = explode("/", $nomeimagem);
									
									//             0           1
									//Divide em TIMESTAMP e formato
									$nomeImagemArray2 = explode(".", $nomeImagemArray1[1]);
									
									?>
									<div class="col-md-4">
									
										<a data-toggle="modal" href="<?php echo "#".$nomeImagemArray2[0]; ?>">
											<img src="<?php echo $nomeimagem; ?>" class="img-fluid">
										</a>
			
									</div>
									
									<div class="modal" tabindex="-1" role="dialog" id="<?php echo $nomeImagemArray2[0]; ?>">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
      
												<div class="modal-body">
													<img src="<?php echo $nomeimagem; ?>" class="img-fluid" alt="Responsive image">
												</div>
      
											</div>
										</div>
									</div>
									
									<?php
								}
								
								?>
								</div>
								<?php
							}
						}
					}
				}
			?>
		</div>
		
		<div class="col-md-3">
			<?php 
			if(!isset($_SESSION["especialidade"])){
				include 'menuPacienteInclude.php';
			}
			else{
				include 'menuMedicoInclude.php';
			}
			?>
		</div>
		
	</div>
	<div class="row">
		<div class="col-md-12">
		</div>
	</div>
	
</div>

    <script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
	
  </body>
</html>