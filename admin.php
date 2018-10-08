<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Administrador</title>

    <meta name="description" content="Source code generated using layoutit.com">
    <meta name="author" content="LayoutIt!">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
	
	<script src="js/jquery-3.3.1.min.js"></script>

  </head>
  <body>

    <div class="container-fluid">
	
	<div class="row mb-5 mt-5">
		<div class="col-md-12 border" align="center">
			<h3>
				Administrador
				<small class="text-muted">Painel de controle</small>
			</h3>
		</div>
	</div>
	
	<div class="row mb-5">
		<div class="col-md-4 border pt-2 pb-2">
			<p class="h4" align="center">Cadastrar horário</p>
			
			<form method="post" action="cadastrarHorario.php">
				<div class="form-group">
					<label for="cpf">CPF do profissional</label>
					<input type="text" class="form-control" id="cpf" name="cpf">
				</div>
				
				<div class="form-group">
					<label for="cpf">Dia e horário de início</label>
					<input type="datetime-local" class="form-control" id="diahorarioinicio" name="diahorarioinicio">
				</div>
				
				<div class="form-group">
					<label for="cpf">Dia e horário de fim</label>
					<input type="datetime-local" class="form-control" id="diahorariofim" name="diahorariofim">
				</div>
				
				<button type="submit" class="btn btn-primary btn-block">Cadastrar</button>
			</form>
		
		</div>
		
		<div class="col-md-4 border pt-2 pb-2">
			<p class="h4" align="center">Cadastrar profissional</p>
			
			<form method="post" action="cadastrarProfissional.php">
				<div class="form-group">
					<label for="cpf">CPF</label>
					<input type="text" class="form-control" id="cpf" name="cpf">
				</div>
				
				<div class="form-group">
					<label for="rg">RG</label>
					<input type="text" class="form-control" id="rg" name="rg">
				</div>
				
				<div class="form-group">
					<label for="nomecompleto">Nome completo</label>
					<input type="text" class="form-control" id="nomecompleto" name="nomecompleto">
				</div>
				
				<div class="form-group">
					<label for="registro">Número de registro(CRM ou CRE)</label>
					<input type="text" class="form-control" id="registro" name="registro">
				</div>
				
				<div class="form-group">
					<label for="nomeusuario">Nome de usuário</label>
					<input type="text" class="form-control" id="nomeusuario" name="nomeusuario">
				</div>
				
				<div class="form-group">
					<label for="senha">Senha</label>
					<input type="text" class="form-control" id="senha" name="senha">
				</div>
				
				<div class="form-group">
					<label for="especialidade">Especialidade</label>
					<input type="text" class="form-control" id="especialidade" name="especialidade">
				</div>
				
				<div class="form-group">
					<label for="especialidade">Tipo</label>
					<div class="btn-group-vertical btn-group-toggle btn-block" data-toggle="buttons">
						<label class="btn btn-secondary btn-block mb-1">
							<input type="radio" id="radio1" name="tipo" autocomplete="off" value="Médico"> Médico
						</label>
						<label class="btn btn-secondary btn-block mb-1">
							<input type="radio" id="radio2" name="tipo" autocomplete="off" value="Enfermeiro"> Enfermeiro
						</label>
						<label class="btn btn-secondary btn-block">
							<input type="radio" id="radio3" name="tipo" autocomplete="off" value="Técnico em Enfermagem"> Técnico em Enfermagem
						</label>
					</div>
				</div>
				
				
				<button type="submit" class="btn btn-primary btn-block">Cadastrar</button>
			</form>
		</div>
		
		<div class="col-md-4 border pt-2 pb-2">
			<p class="h4" align="center">Cadastrar plantão</p>
			
			<form method="post" action="cadastrarPlantao.php">
				
				<div class="form-group">
					<label for="diahorarioinicio">Dia e horário de início</label>
					<input type="datetime-local" class="form-control" id="diahorarioinicio" name="diahorarioinicio">
				</div>
				
				<div class="form-group">
					<label for="diahorariofim">Dia e horário de fim</label>
					<input type="datetime-local" class="form-control" id="diahorariofim" name="diahorariofim">
				</div>
				
				<button type="submit" class="btn btn-primary btn-block">Cadastrar</button>
			</form>
		
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-4 border pt-2 pb-2 mb-5">
			<p class="h4" align="center">Cadastrar profissional em um plantão</p>
			
			<form method="post" action="cadastrarProfissionalPlantao.php">
				
				<div class="form-group">
					<label for="cpfprofissional">CPF do profissional</label>
					<input type="text" class="form-control" id="cpfprofissional" name="cpfprofissional">
				</div>
				
				<div class="form-group">
					<label for="idplantao">ID do plantão</label>
					<input type="text" class="form-control" id="idplantao" name="idplantao">
				</div>
				
				<button type="submit" class="btn btn-primary btn-block">Cadastrar</button>
			</form>
		
		</div>
		
		<div class="col-md-4 border pt-2 pb-2 mb-5">
			<p class="h4" align="center">Cadastrar novo setor</p>
			
			<form method="post" action="cadastrarSetor.php">
				
				<div class="form-group">
					<label for="cpfprofissional">Nome do setor</label>
					<input type="text" class="form-control" id="nomesetor" name="nomesetor">
				</div>
				
				<button type="submit" class="btn btn-primary btn-block">Cadastrar</button>
			</form>
		
		</div>
		
		<div class="col-md-4 border pt-2 pb-2 mb-5">
			<p class="h4" align="center">Cadastrar leito em um setor</p>
			
			<form method="post" action="cadastrarLeito.php">
				
				<div class="form-group">
					<div class="btn-group-vertical btn-group-toggle btn-block" data-toggle="buttons">
					<?php
					include './conexao.php';
					
					$conn = getConnection();
					
					$sql = 'SELECT * FROM setores';
					
					$stmt = $conn->prepare($sql);
					$stmt->execute();
					$count = $stmt->rowCount();
		
					if($count > 0){
						$result = $stmt->fetchAll();
						$submit = 1;
			
						foreach($result as $row){
							$id   = $row['id'];
							$nome = $row['nome'];
							?>
							<label class="btn btn-secondary btn-block mb-1">
								<input type="radio" id="<?php echo $id; ?>" name="setor" autocomplete="off" value="<?php echo $id; ?>"> <?php echo $nome; ?>
							</label>
							<?php
						}
					}
					else{
						echo '<div class="alert alert-warning btn-block">
								<strong>Não há setores cadastrados!</strong>
							  </div>';
						$submit = 0;
					}
					?>
					</div>
				</div>
				
				<?php
				if($submit == 1){
					?>
					<button type="submit" class="btn btn-primary btn-block">Cadastrar</button>
					<?php
				}
				?>
			</form>
		
		</div>
	</div>
	
	<?php include 'rodape1.html'; ?>
	
</div>

	<script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
  </body>
</html>