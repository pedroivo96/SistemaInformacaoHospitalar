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

    <title>Evolução do paciente</title>

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
			<h5 class="display-4">Evolução do paciente</h5>
		</div>
	</div>
	<div class="row">
		<div class="col-md-8">
			
			<?php
				$cpfpaciente   = $_POST['cpfpaciente'];
				$cpfenfermeiro = $_POST['cpfenfermeiro'];
			?>
			
			<p class="h5">Anotações sobre o paciente <b><?php echo $nomepaciente; ?></b></p>
			
			<div class="row">
			<?php
				include './conexao.php';
				
				$conn = getConnection();
				
				$actual = time();
		
				$sql = 'SELECT cpfprofissional FROM anotacoesenfermagem WHERE cpfpaciente = :cpfpaciente GROUP BY cpfprofissional';
				$stmt = $conn->prepare($sql);
				$stmt->bindValue(':cpfpaciente', $cpfpaciente);
				$stmt->execute();
				$count = $stmt->rowCount();
		
				if($count > 0){
					$result = $stmt->fetchAll();
			
					foreach($result as $row){
						$cpfprofissional = $row['cpfprofissional'];
						
						$sql = 'SELECT nomecompleto FROM profissionais WHERE cpf = :cpfprofissional';
						$stmt = $conn->prepare($sql);
						$stmt->bindValue(':cpfprofissional', $cpfprofissional);
						$stmt->execute();
						$count = $stmt->rowCount();
						
						if($count1 > 0){
							$result1 = $stmt1->fetchAll();
			
							foreach($result1 as $row1){
								$nomeprofissional = $row1['nomecompleto'];
								
								?>
								<div class="col-sm-4 mb-3">
									<div class="card">
					
										<div class="card-header">
											<?php echo $nomeprofissional; ?>
										</div>
					
										<ul class="list-group list-group-flush">
								<?php
								
								$sql2 = 'SELECT * FROM anotacoesenfermagem WHERE cpfprofissional = :cpfprofissional AND cpfpaciente = :cpfpaciente';
								$stmt2 = $conn->prepare($sql2);
								$stmt2->bindValue(':cpfprofissional', $cpfprofissional);
								$stmt2->bindValue(':cpfpaciente'    , $cpfpaciente);
								$stmt2->execute();
								$count2 = $stmt2->rowCount();
		
								if($count2 > 0){
									$result2 = $stmt2->fetchAll();
			
									foreach($result2 as $row2){
										$conteudo = $row2['conteudo'];
										$diahorario = $row2['diahorario'];
										?>
										<li class="list-group-item">
											<?php echo $conteudo; ?>
										</li>
										<?php
									}
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
			?>
			</div>
			
			<form method="post" action="evoluirPaciente.php">
				<div class="form-group">
					<label for="exampleInputEmail1">Evolução do paciente</label>
					
					<textarea type="email" class="form-control" rows="10" id="evolucao" name="evolucao">
					</textarea>	
				</div>
				
				<input type="hidden" id="cpfpaciente"   name="cpfpaciente"   value="<?php echo $cpfpaciente; ?>">
				<input type="hidden" id="cpfenfermeiro" name="cpfenfermeiro" value="<?php echo $cpfenfermeiro; ?>">
				
				<button type="submit" class="btn btn-primary btn-block">Cadastrar evolução</button>
			</form>
			
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