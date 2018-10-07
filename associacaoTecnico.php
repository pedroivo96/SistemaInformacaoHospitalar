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

    <title>Associar técnico</title>

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
			<h5 class="display-4">Associar técnico</h5>
		</div>
	</div>
	<div class="row">
		<div class="col-md-8">
			<?php
			$cpfEnfermeiro = $_SESSION["cpf"];
			$cpfpaciente   = $_POST['cpfpaciente'];
			
			$diahorarioatual = time();
			
			$sql = 'SELECT id FROM plantoes WHERE diahorarioinicio < :diahorarioatual AND diahorariofim > :diahorarioatual';
			$stmt = $conn->prepare($sql);
			$stmt->bindValue(':diahorarioatual', $diahorarioatual);
			$stmt->execute();
			$count = $stmt->rowCount();
		
			if($count > 0){
				$result = $stmt->fetchAll();
				?>
				<form method="post" action="associarTecnico.php">
					<div class="form-group">
						<div class="btn-group-vertical btn-group-toggle btn-block" data-toggle="buttons">
				<?php
				foreach($result as $row){
					$idplantao = $row['id'];
					
					$sql1 = 'SELECT * FROM profissionaisplantao WHERE idplantao = :idplantao';
					$stmt1 = $conn->prepare($sql1);
					$stmt1->bindValue(':idplantao', $idplantao);
					$stmt1->execute();
					$count1 = $stmt1->rowCount();
		
					if($count1 > 0){
						$result1 = $stmt1->fetchAll();
			
						foreach($result1 as $row1){
							$cpfprofissional = $row1['cpfprofissional'];
							
							$sql2 = 'SELECT nomecompleto,tipo FROM profissionais WHERE cpf = :cpfprofissional';
							$stmt2 = $conn->prepare($sql2);
							$stmt2->bindValue(':cpfprofissional', $cpfprofissional);
							$stmt2->execute();
							$count2 = $stmt2->rowCount();
		
							if($count2 > 0){
								$result2 = $stmt2->fetchAll();
			
								foreach($result2 as $row2){
									$tipo = $row2['tipo'];
									
									if($tipo == "Técnico em Enfermagem"){
										$nomeprofissional = $row2['nomecompleto'];
										
										?>
										<label class="btn btn-secondary btn-block">
											<input type="radio"  id="nometecnico"  name="nometecnico" autocomplete="off" value="<?php echo $nomeprofissional;?>">Médico
											<input type="hidden" id="cpftecnico"   name="cpftecnico"  autocomplete="off" value="<?php echo $cpfprofissional;?>">
											<input type="hidden" id="cpfpaciente"  name="cpfpaciente" autocomplete="off" value="<?php echo $cpfpaciente;?>">
										</label>
										<?php
									}
								}
							}
						}
					}
				}
				?>
							<button type="submit" class="btn btn-primary">Associar</button>
						</div>
					</div>
				</form>
				<?php
			}
			else{
				?>
				<div class="alert alert-warning" role="alert">
					Não existem profissionais cadastrados nesse plantão.
				</div>
				<?php
			}
			?>
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