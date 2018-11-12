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
	
	<div class="row mb-4 mt-2">
		<div class="col-md-12 border" align="center">
			<h3>
				Menu do médico
				<small class="text-muted">Informações pessoais</small>
			</h3>
		</div>
	</div>
	<div class="row">
	
		<div class="col-md-9">
		
			<div class="row">
			
			<?php
			if(!empty($_POST)){
				
				$pesquisa = $_POST['pesquisa'];
				
				$conn = getConnection();
				
				$sql = 'SELECT cpf, nomecompleto FROM pacientes WHERE nomecompleto LIKE :pesquisa';
				$stmt = $conn->prepare($sql);
				$stmt->bindValue(':pesquisa', "%".$pesquisa."%");
				$stmt->execute();
				$count = $stmt->rowCount();

				if($count > 0){
						
					$result = $stmt->fetchAll();
						
					foreach($result as $row){
						?>
						<div class="col-sm-4 mb-3">
							<div class="card">
								<div class="card-header">
									<?php echo $row['nomecompleto']; ?>
								</div>
								
								<form method="POST" action="gerarProntuario.php">
									<input type="hidden" id="cpfpaciente" name="cpfpaciente" value="<?php echo $row['cpf']; ?>">
													
									<button type="submit" class="btn btn-primary btn-block" style="padding: 0.75rem 1.25rem; border-radius: 0 0 calc(0.25rem - 1px) calc(0.25rem - 1px);">
										Ver prontuário
									</button>
								</form>
								
							</div>
						</div>
						<?php
					}
				}
				else{
					?>
					<div class="alert alert-primary w-100" role="alert">
						A pesquisa não retornou resultados.
					</div>
					<?php
				}
			}
			?>
			
			</div>
			
		</div>
		
		<div class="col-md-3">
			<?php include 'menuMedicoInclude.php'?>	
		</div>
		
	</div>
	
</div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
  </body>
</html>