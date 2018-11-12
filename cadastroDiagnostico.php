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

	<script>
		
		function iniciaAjax(){
			
			var ajax;
			
			if(window.XMLHttpRequest){       //Mozilla, Safari ...
				ajax = new XMLHttpRequest();
			} else if(windows.ActiveXObject){ //Internet Explorer
				ajax = new ActiveXObject("Msxml2.XMLHTTP");
				
				if(!ajax){
					ajax = new ActiveXObject("Microsoft.XMLHTTP");
				}
			}
			else{
				alert("Seu navegador não possui suporte a essa aplicação.");
			}
			
			return ajax;
		}
		
		function cadastrarDiagnostico(){
			
			ajax = iniciaAjax();
			
			if(ajax){
				
				ajax.onreadystatechange = function(){
					if(ajax.readyState == 4){
						if(ajax.status == 200){
							retorno = ajax.responseText;
							
							if(retorno == "ERRO"){
								alert("Falha no banco de dados.");
								
							}else{
								alert("Diagnóstico cadastrado com sucesso");								
							}
						}
						else{
							alert(ajax.statusText);
						}
					}
				}
				
				var idinternacao  = document.getElementById('idinternacao').value;
				var diagnostico   = document.getElementById('diagnostico').value;
			
				//Monta a QueryString
				dados = 'idinternacao='+idinternacao+"&diagnostico="+diagnostico;
				
				//Faz a requisição e envio pelo método POST
				ajax.open('POST', 'cadastrarDiagnostico.php', true);
				ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				ajax.send(dados);
				
			}
			
		}
	
	</script>
	
  </head>
  <body>

    <div class="container-fluid px-5 pb-5">
	
	<?php include 'campoPesquisaPaciente.html'?>	
	
	<div class="row mb-4 mt-2">
		<div class="col-md-12 border" align="center">
			<h3>
				Menu do médico
				<small class="text-muted">Cadastrar diagnóstico</small>
			</h3>
		</div>
	</div>
	<div class="row">
	
		<div class="col-md-9">
		
			<?php
			if(!empty($_POST)){
				$cpfpaciente = $_POST['cpfpaciente'];
				$status      = "Realizada";
				
				$conn = getConnection();
				
				$sql = 'SELECT idconsulta, diagnostico, id FROM internacoes WHERE cpfpaciente = :cpfpaciente AND status = :status';
				$stmt = $conn->prepare($sql);
				$stmt->bindValue(':cpfpaciente', $cpfpaciente);
				$stmt->bindValue(':status'     , $status);
				$stmt->execute();
				$count = $stmt->rowCount();
		
				if($count > 0){
					$result = $stmt->fetchAll();
			
					foreach($result as $row){
						
						$idconsulta  = $row['idconsulta'];
						$diagnostico = $row['diagnostico'];
						$id          = $row['id'];
						
						$sql1 = 'SELECT queixaprincipal, exameclinico, diagnosticoprovavel FROM consultas WHERE id = :idconsulta';
						$stmt1 = $conn->prepare($sql1);
						$stmt1->bindValue(':idconsulta', $idconsulta);
						$stmt1->execute();
						$count1 = $stmt1->rowCount();
		
						if($count1 > 0){
							$result1 = $stmt1->fetchAll();
			
							foreach($result1 as $row1){
								
								$queixaprincipal     = $row1['queixaprincipal'];
								$exameclinico        = $row1['exameclinico'];
								$diagnosticoprovavel = $row1['diagnosticoprovavel'];
								
								?>
								<div class="row">
									<div class="card w-100">
										<div class="card-header">
											<?php echo obterNomePaciente($cpfpaciente); ?>
										</div>
										
										<div class="card-body">
											<h5 class="card-title">Queixa principal</h5>
											<p class="card-text"><?php echo $queixaprincipal; ?></p>
											
											<h5 class="card-title">Exame clínico</h5>
											<p class="card-text"><?php echo $exameclinico; ?></p>
											
											<h5 class="card-title">Diagnóstico provável do solicitante da internação</h5>
											<p class="card-text"><?php echo $diagnosticoprovavel; ?></p>
											
											<h5 class="card-title">Diagnóstico mais recente cadastrado</h5>
											<p class="card-text"><?php echo $diagnostico; ?></p>
										</div>
										
										<form method="POST" action="">
										
											<div class="form-group mx-3">
												<label for="diagnostico">Novo diagnóstico</label>
												<textarea class="form-control" id="diagnostico" name="diagnostico" rows="4"></textarea>
											</div>
											
											<input type="hidden" id="idinternacao" name="idinternacao" value="<?php echo $id; ?>">
												
											<button type="button" 
													class="btn btn-primary btn-block"
													style="padding: 0.75rem 1.25rem; border-radius: 0 0 calc(0.25rem - 1px) calc(0.25rem - 1px);"
													onclick="cadastrarDiagnostico();">
												Cadastrar
											</button>
										</form>
										
									</div>
								</div>
								<?php
							}
						}
						
						?>
						<p class="h4 mt-5 text-center border-bottom">Anotações sobre este paciente</p>
						<?php
						
						$sql2 = 'SELECT * FROM anotacoesenfermagem WHERE idinternacao = :idconsulta';
						$stmt2 = $conn->prepare($sql2);
						$stmt2->bindValue(':idconsulta', $idconsulta);
						$stmt2->execute();
						$count2 = $stmt2->rowCount();
		
						if($count2 > 0){
							$result2 = $stmt2->fetchAll();
							
							?>
							<div class="row">
							<?php
							
							foreach($result2 as $row2){
							?>
							<div class="col-sm-6">
								<div class="card">
									<div class="card-header">
										<?php echo "Cadastrada por ".obterNomeProfissional($row2['cpfprofissional']); ?>
									</div>
									
									<div class="card-body">
										
										<h5 class="card-title">Anotação</h5>
										<p class="card-text"><?php echo $row2['conteudo']?></p>
										
										<h5 class="card-title">Dia e horário</h5>
										<p class="card-text"><?php echo date("d/m/y" , $row2['diahorario'])." às ".date("H:i:s" , $row2['diahorario']); ?></p>
									</div>
								</div>
							</div>
							<?php
							}
							
							?>
							</div>
							<?php
						}
						else{
							?>
							<div class="alert alert-primary w-100" role="alert">
								Não há nenhuma anotação cadastrada sobre esta internação.
							</div>
							<?php
						}
					}
				}
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
			
			function obterNomeProfissional($cpfprofissional){
				
				$conn = getConnection();
				
				$sql = 'SELECT nomecompleto FROM profissionais WHERE cpf = :cpfprofissional';
				$stmt = $conn->prepare($sql);
				$stmt->bindValue(':cpfprofissional', $cpfprofissional);
				$stmt->execute();
				$count = $stmt->rowCount();
		
				if($count > 0){
					$result = $stmt->fetchAll();
			
					foreach($result as $row){
						$nomeprofissional = $row['nomecompleto'];
						
						return $nomeprofissional;
					}
				}
			}
			?>
			
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