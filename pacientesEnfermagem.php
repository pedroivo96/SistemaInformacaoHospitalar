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

    <div class="container-fluid px-5">
	<div class="row mb-5 mt-5">
		<div class="col-md-12 border" align="center">
			<h3>
				Menu do técnico em enfermagem
				<small class="text-muted">Meus pacientes</small>
			</h3>
		</div>
	</div>
	<div class="row">
		<div class="col-md-9">
		
			<div class="row">
			
			<?php
			
			$cpftecnico = $_SESSION['cpf'];
			
			$conn = getConnection();
			
			$sql = 'SELECT * FROM internacoes WHERE cpftecnico = :cpftecnico AND status = :status';
			$stmt = $conn->prepare($sql);
			$stmt->bindValue(':cpftecnico', $cpftecnico);
			$stmt->bindValue(':status'    , "Realizada");
			$stmt->execute();
			$count = $stmt->rowCount();
		
			if($count > 0){
				$result = $stmt->fetchAll();
			
				foreach($result as $row){
					?>
					<div class="col-md-6">
						<div class="card">
						
							<div class="card-header">
								<?php echo obterNomePaciente($row['cpfpaciente']); ?>
							</div>
						
							<div class="card-body">
								
								<dl class="row">
									<dt class="col-sm-6">Número do leito</dt>
									<dd class="col-sm-6"><?php echo $row['idleito']; ?></dd>
									
									<dt class="col-sm-6">Setor</dt>
									<dd class="col-sm-6"><?php echo obterNomeSetor($row['idsetor']); ?></dd>
									
									<dt class="col-sm-6">Dia e horário de entrada</dt>
									<dd class="col-sm-6"><?php echo date("d/m/y", $row['diahorarioentrada'])." às ".date("H:i", $row['diahorarioentrada']); ?></dd>
								</dl>
							
							</div>
							
							<form  method="post" action="atenderPaciente.php">
								
								<input type="hidden" id="idinternacao" name="idinternacao" value="<?php echo $row['id']; ?>">
								<input type="hidden" id="cpfpaciente"  name="cpfpaciente"  value="<?php echo $row['cpfpaciente']; ?>">
								
								<button type="submit" class="btn btn-primary btn-block" style="padding: 0.75rem 1.25rem; border-radius: 0 0 calc(0.25rem - 1px) calc(0.25rem - 1px);">
									Realizar anotação
								</button>
							</form>
						</div>
					</div>
					<?php
				}
			}
			else{
				?>
				<div class="alert alert-danger w-100" role="alert">
					Você não possui nenhum paciente.
				</div>
				<?php
			}
			
			function obterNomePaciente($cpfpaciente){
				
				$conn = getConnection();
				
				$sql = 'SELECT nomecompleto FROM pacientes WHERE cpf = :cpfpaciente';
				$stmt = $conn->prepare($sql);
				$stmt->bindValue(':cpfpaciente', $cpfpaciente);
				$stmt->execute();
				$count = $stmt->rowCount();
		
				if($count > 0){
					$result = $stmt->fetchAll();
			
					foreach($result as $row){
						$nomepaciente = $row['nomecompleto'];
						
						return $nomepaciente;
					}
				}
			}
			
			function obterNomeSetor($idsetor){
				
				$conn = getConnection();
				
				$sql = 'SELECT nome FROM setores WHERE id = :idsetor';
				$stmt = $conn->prepare($sql);
				$stmt->bindValue(':idsetor', $idsetor);
				$stmt->execute();
				$count = $stmt->rowCount();
		
				if($count > 0){
					$result = $stmt->fetchAll();
			
					foreach($result as $row){
						$nome = $row['nome'];
						
						return $nome;
					}
				}
			}
			?>
			
			</div>
			
		</div>
		
		<div class="col-md-3">
		
			<?php include 'menuTecnicoInclude.html'?>	
			
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