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

    <title>Agendar consulta</title>

    <meta name="description" content="Source code generated using layoutit.com">
    <meta name="author" content="LayoutIt!">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

  </head>
  <body>

    <div class="container-fluid">
	<div class="row mb-5 mt-5">
		<div class="col-md-12 border" align="center">
			<h5 class="display-4">Agendar consulta</h5>
		</div>
	</div>
	<div class="row">
		<div class="col-md-8">
		
			<div class="alert alert-primary d-block" role="alert">
				Resultado da busca
			</div>
			
			<!--
			<div class="card-columns">
			-->
			
			<?php
				include './conexao.php';

				if(!empty($_POST)){
					$especialidade = $_POST['especialidade'];
					$diahorario    = strtotime(strval($_POST['diahorario']));
					
					//echo $diahorario;
					
					$tipo = "Médico";
					
					$conn = getConnection();

					$sql = 'SELECT * FROM profissionais WHERE especialidade = :especialidade AND tipo = :tipo';
					$stmt = $conn->prepare($sql);
					$stmt->bindValue(':especialidade', $especialidade);
					$stmt->bindValue(':tipo'         , $tipo);
					$stmt->execute();
					$count = $stmt->rowCount();

					if($count > 0){
						
						$result = $stmt->fetchAll();
						
						foreach($result as $row){
							
							$cpf = $row['cpf'];
							
							$sql1 = 'SELECT * FROM horarios WHERE cpf = :cpf AND diahorarioinicio <= :diahorario1 AND diahorariofim >= :diahorario2';
							$stmt1 = $conn->prepare($sql1);
							$stmt1->bindValue(':diahorario1', $diahorario);
							$stmt1->bindValue(':diahorario2', $diahorario);
							$stmt1->bindValue(':cpf'        , $cpf);
							$stmt1->execute();
							$count1 = $stmt1->rowCount();
							
							if($count1 > 0){
								
								$result1 = $stmt1->fetchAll();
		
			
								foreach($result1 as $row1){
									
									$nomecompleto     = $row['nomecompleto'];
									$cpf              = $row['cpf'];
									$diahorarioinicio = $row1['diahorarioinicio'];
									$diahorariofim    = $row1['diahorariofim'];
									
									?>
									
									
									<div class="card">
										<form method="post" action="agendarConsulta.php">
											
											<div class="card-body">
													
												<div class="form-group">
													<label for="exampleInputEmail1">Nome do médico:</label>
													<h5 class="card-title" id="nomecompleto" name="nomecompleto">
														<?php echo $nomecompleto; ?>
													</h5>
												</div>
													
												<input type="hidden" id="cpf" name="cpf" value="<?php echo $cpf; ?>">
												<input type="hidden" id="diahorarioinicio" name="diahorarioinicio" value="<?php echo $diahorarioinicio; ?>">
												<input type="hidden" id="diahorariofim" name="diahorariofim" value="<?php echo $diahorariofim; ?>">
													
												<div class="form-group">
													<label for="exampleInputEmail1">Especialidade:</label>
													<h6 class="card-text" id="especialidade" name="especialidade">
														<?php echo $especialidade; ?>
													</h6>
												</div>
													
												<button type="submit" class="btn btn-primary btn-block">Agendar</button>
											</div>
										</form>	
									</div>
										
									<?php
								}
								
							}
						}
			
					}else{
						echo '<div class="alert alert-danger">
								<strong>Erro!</strong> Nenhum resultado encontrado.
							  </div>';
					}
				}
			?>
			<!--
			</div>
			-->
		
		</div>
		<div class="col-md-4">
			<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'consultas.html';">Consultas</button>
			
			<button type="button" class="btn btn-primary btn-lg btn-block">Exames</button>
			
			<button type="button" class="btn btn-primary btn-lg btn-block">Procedimentos</button>
			
			<button type="button" class="btn btn-primary btn-lg btn-block">Prontuário</button>
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