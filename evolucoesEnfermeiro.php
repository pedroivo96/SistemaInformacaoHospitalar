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

    <title>Minhas evoluções</title>

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
			<h5 class="display-4">Minhas evoluções</h5>
			
			<div class="row">
			<?php
				include './conexao.php';
				
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
						
						$sql1 = 'SELECT nomecompleto FROM pacientes WHERE cpf = :cpfpaciente';
						$stmt1 = $conn->prepare($sql1);
						$stmt1->bindValue(':cpfpaciente', $cpfpaciente);
						$stmt1->execute();
						$count1 = $stmt1->rowCount();
		
						if($count1 > 0){
							$result1 = $stmt1->fetchAll();
			
							foreach($result1 as $row1){
								$nomepaciente = $row1['nomecompleto'];
								
								?>
								<div class="col-sm-12">
									<div class="card">
										<div class="card-header">
											<?php echo $nomepaciente; ?>
										</div>
										<div class="card-body">
											<h5 class="card-title">Conteúdo</h5>
											<p class="card-text"><?php echo $conteudo; ?></p>
										</div>
									</div>
								</div>
								<?php
							}
						}
					}
				}
				else{
					?>
					<div class="alert alert-warning" role="alert">
						Você não tem evoluções cadastradas.
					</div>
					<?php
				}
			?>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-8">
			
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