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

    <title>Menu do Paciente</title>

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
				Menu do paciente
				<small class="text-muted">Informações pessoais</small>
			</h3>
		</div>
	</div>
	
	<div class="row mb-5">
		<div class="col-md-2"></div>
		
		<div class="col-md-5">
		
			<dl class="row">
				<?php
				
				$conn = getConnection();
				
				$sql = 'SELECT * FROM pacientes WHERE cpf = :cpf';
				$stmt = $conn->prepare($sql);
				$stmt->bindValue(':cpf', $_SESSION['cpf']);
				$stmt->execute();
				$count = $stmt->rowCount();
		
				if($count > 0){
					$result = $stmt->fetchAll();
			
					foreach($result as $row){
						
						$nomecompleto           = $row['nomecompleto'];
						$datanascimento         = date("d/m/Y" , $row['datanascimento']);
						$estadocivil            = $row['estadocivil'];
						$profissao              = $row['profissao'];
						$sexo                   = $row['sexo'];
						$nomemae                = $row['nomemae'];
						$naturalidademunicipio  = $row['naturalidademunicipio'];
						$naturalidadeestado     = $row['naturalidadeestado'];
						$enderecovia            = $row['enderecovia'];
						$endereconumero         = $row['endereconumero'];
						$enderecocomplemento    = $row['enderecocomplemento'];
						$enderecobairrodistrito = $row['enderecobairrodistrito'];
						$enderecomunicipio      = $row['enderecomunicipio'];
						$enderecoestado         = $row['enderecoestado'];
						$rg                     = $row['rg'];
						$nomeusuario            = $row['nomeusuario'];
						$email                  = $row['email'];
						
						$dataatual = time();
						
						$idade = date("Y", $dataatual) - date("Y", $row['datanascimento']);
					}
				}
				?>
			
				<dt class="col-sm-6">Nome</dt>
				<dd class="col-sm-6"><?php echo $nomecompleto; ?></dd>

				<dt class="col-sm-6">CPF</dt>
				<dd class="col-sm-6"><?php echo $_SESSION['cpf']; ?></dd>
				
				<dt class="col-sm-6">RG</dt>
				<dd class="col-sm-6"><?php echo $rg; ?></dd>
				
				<dt class="col-sm-6">Sexo</dt>
				<dd class="col-sm-6"><?php echo $sexo; ?></dd>
			
				<dt class="col-sm-6">Data de nascimento</dt>
				<dd class="col-sm-6"><?php echo $datanascimento; ?></dd>
				
				<dt class="col-sm-6">Idade</dt>
				<dd class="col-sm-6"><?php echo $idade; ?></dd>
			
				<dt class="col-sm-6">Nome da mãe</dt>
				<dd class="col-sm-6"><?php echo $nomemae; ?></dd>
				
				<dt class="col-sm-6">Município de nascimento</dt>
				<dd class="col-sm-6"><?php echo $naturalidademunicipio; ?></dd>
				
				<dt class="col-sm-6">Estado de nascimento</dt>
				<dd class="col-sm-6"><?php echo $naturalidadeestado; ?></dd>
				
				<dt class="col-sm-6">Via</dt>
				<dd class="col-sm-6"><?php echo $enderecovia; ?></dd>
				
				<dt class="col-sm-6">Número</dt>
				<dd class="col-sm-6"><?php echo $endereconumero; ?></dd>
				
				<dt class="col-sm-6">Complemento</dt>
				<dd class="col-sm-6"><?php echo $enderecocomplemento; ?></dd>
				
				<dt class="col-sm-6">Distrito/Bairro</dt>
				<dd class="col-sm-6"><?php echo $enderecobairrodistrito; ?></dd>
				
				<dt class="col-sm-6">Município</dt>
				<dd class="col-sm-6"><?php echo $enderecomunicipio; ?></dd>
				
				<dt class="col-sm-6">Estado</dt>
				<dd class="col-sm-6"><?php echo $enderecoestado; ?></dd>
				
				<dt class="col-sm-6">Nome de usuário</dt>
				<dd class="col-sm-6"><?php echo $nomeusuario; ?></dd>
				
				<dt class="col-sm-6">E-mail</dt>
				<dd class="col-sm-6"><?php echo $email; ?></dd>
				
				<dt class="col-sm-6">Estado civil</dt>
				<dd class="col-sm-6"><?php echo $estadocivil; ?></dd>
				
				<dt class="col-sm-6">Profissão</dt>
				<dd class="col-sm-6"><?php echo $profissao; ?></dd>
				
			</dl>
			
		</div>
		<div class="col-md-2"></div>
		
		<div class="col-md-3">
			<?php include 'menuPacienteInclude.html'; ?>
		</div>
	</div>
	
</div>

	<?php include 'rodape1.html'; ?>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
  </body>
</html>