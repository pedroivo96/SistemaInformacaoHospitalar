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

    <title>Menu do Enfermeiro</title>

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
				Menu do enfermeiro
				<small class="text-muted">Informações pessoais</small>
			</h3>
		</div>
	</div>
	<div class="row">
		<div class="col-md-8">
			
			<dl class="row">
				<dt class="col-sm-3">Nome</dt>
				<dd class="col-sm-9"><?php echo $_SESSION['nomecompleto']; ?></dd>

				<dt class="col-sm-3">CPF</dt>
				<dd class="col-sm-9"><?php echo $_SESSION['cpf']; ?></dd>
				
				<dt class="col-sm-3">RG</dt>
				<dd class="col-sm-9"><?php echo $_SESSION['rg']; ?></dd>
				
				<dt class="col-sm-3">Tipo</dt>
				<dd class="col-sm-9"><?php echo $_SESSION['tipo']; ?></dd>
				
				<dt class="col-sm-3">Nome de usuário</dt>
				<dd class="col-sm-9"><?php echo $_SESSION['nomeusuario']; ?></dd>
				
				<dt class="col-sm-3">Registro</dt>
				<dd class="col-sm-9"><?php echo $_SESSION['registro']; ?></dd>
				
				<dt class="col-sm-3">Especialidade</dt>
				<dd class="col-sm-9"><?php echo $_SESSION['especialidade']; ?></dd>
				
			</dl>
			
		</div>
		<div class="col-md-4">
		
			<?php
				$cpfprofissional = $_SESSION['cpf'];
				
				include './conexao.php';
				
				$conn = getConnection();
				
				$actual = time();
		
				$sql = 'SELECT * FROM plantoes WHERE diahorarioinicio < :actual AND diahorariofim > :actual';
				$stmt = $conn->prepare($sql);
				$stmt->bindValue(':actual', $actual);
				$stmt->execute();
				$count = $stmt->rowCount();
		
				if($count > 0){
					$result = $stmt->fetchAll();
			
					foreach($result as $row){
						
						$idplantao = $row['id'];
						$chefe = 1;
							
						$sql1 = 'SELECT * FROM profissionaisplantao WHERE cpfprofissional = :cpfprofissional';
						$stmt1 = $conn->prepare($sql1);
						$stmt1->bindValue(':cpfprofissional', $cpfprofissional);
						$stmt1->bindValue(':chefe', $chefe);
						$stmt1->execute();
						$count1 = $stmt1->rowCount();
		
						if($count1 > 0){
							$result1 = $stmt1->fetchAll();
			
							foreach($result1 as $row1){
							
								$idplantao = $row1['id'];
								$chefe = $row1['chefe'];
								
								if($chefe == 1){
									?>
									<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'gerenciamentoInternacoes.php';">Gerenciar internações</button>
									<?php
								}
								else{
									//Está escalado para o plantão porém não é o chefe, portanto não pode gerenciar internações
								}
							}
						}
						else{
							//Não esta escalado para o plantão atual
						}
					}
				}
			?>
		
			<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'evolucoesEnfermeiro.php';">
				Minhas evoluções
			</button>
			
			<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'diagnosticoEnfermeiro.php';">
				Meus diagnósticos
			</button>
			
			<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'anamneseEnfermeiro.php';">
				Minhas anamneses
			</button>
			
			<button type="button" class="btn btn-danger btn-lg btn-block" onclick="location.href = 'sair.php';">
				Sair
			</button>
			
		</div>
	</div>
	<div class="row">
		<?php include 'rodape.html'; ?>
	</div>
</div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
  </body>
</html>