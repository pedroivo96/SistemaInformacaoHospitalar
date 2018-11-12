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
	
	<script src="js/jquery-3.3.1.min.js"></script>
	
	<script>
	
		function mostrarSetores() {
			var setores = document.getElementById('setorescomvagas');
			
			setores.style.display = "block";
		}
		
		function ocultarSetores() {
			var setores = document.getElementById('setorescomvagas');
			
			setores.style.display = "none";
		}
		
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
		
		function processaExame(){
			ajax = iniciaAjax();
			
			idconsulta         = document.getElementById("idconsulta").value;
			nomeexame          = document.getElementById("nomeexame").value;
			anotacoesopcionais = document.getElementById("anotacoesopcionais1").value;
			
			if(ajax){
				ajax.onreadystatechange = function(){
					if(ajax.readyState == 4){
						if(ajax.status == 200){
							retorno = ajax.responseText;
							
							if(retorno == "Sucesso1"){
								divSucesso1 = document.getElementById("sucesso1");
								divSucesso1.className = "alert alert-success d-block";
								
								listaExames = document.getElementById("exames");
								
								novoItem  = document.createElement("li");
								novoItem.className = "list-group-item";
								novoTexto = document.createTextNode(nomeexame);
								
								novoItem.appendChild(novoTexto);
								listaExames.appendChild(novoItem);
								
							}else if(retorno == "Erro1"){
								divErro1 = document.getElementById("erro1");
								divErro1.className = "alert alert-danger d-block";		
							}
						}
						else{
							alert(ajax.statusText);
						}
					}
				}
				
				//Monta a QueryString
				dados = 'idconsulta='+idconsulta+"&nomeexame="+nomeexame+"&anotacoesopcionais="+anotacoesopcionais;
				
				//Faz a requisição e envio pelo método POST
				ajax.open('POST', 'solicitarExame.php', true);
				ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				ajax.send(dados);
			}
		}
		
		function processaProcedimento(){
			ajax = iniciaAjax();
			
			idconsulta         = document.getElementById("idconsulta").value;
			nomeprocedimento   = document.getElementById("nomeprocedimento").value;
			anotacoesopcionais = document.getElementById("anotacoesopcionais2").value;
			
			if(ajax){
				ajax.onreadystatechange = function(){
					if(ajax.readyState == 4){
						if(ajax.status == 200){
							retorno = ajax.responseText;
							
							if(retorno == "Sucesso2"){
								divSucesso2 = document.getElementById("sucesso2");
								divSucesso2.className = "alert alert-success d-block";
								
								listaProcedimentos = document.getElementById("procedimentos");
								
								novoItem  = document.createElement("li");
								novoItem.className = "list-group-item";
								novoTexto = document.createTextNode(nomeprocedimento);
								
								novoItem.appendChild(novoTexto);
								listaProcedimentos.appendChild(novoItem);
								
							}else if(retorno == "Erro2"){
								divErro2 = document.getElementById("erro2");
								divErro2.className = "alert alert-danger d-block";		
							}
						}
						else{
							alert(ajax.statusText);
						}
					}
				}
				
				//Monta a QueryString
				dados = 'idconsulta='+idconsulta+"&nomeprocedimento="+nomeprocedimento+"&anotacoesopcionais="+anotacoesopcionais;
				
				//Faz a requisição e envio pelo método POST
				ajax.open('POST', 'solicitarProcedimento.php', true);
				ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				ajax.send(dados);
			}
		}
		
		function processaPrescricao(){
			ajax = iniciaAjax();
			
			idconsulta      = document.getElementById("idconsulta").value;
			nomemedicamento = document.getElementById("nomemedicamento").value;
			quantidade      = document.getElementById("quantidade").value;
			vezesaodia      = document.getElementById("vezesaodia").value;
				
			
			if(ajax){
				ajax.onreadystatechange = function(){
					if(ajax.readyState == 4){
						if(ajax.status == 200){
							retorno = ajax.responseText;
							
							if(retorno == "Sucesso3"){
								divSucesso3 = document.getElementById("sucesso3");
								divSucesso3.className = "alert alert-success d-block";
								
								listaPrescricoes = document.getElementById("prescricoes");
								
								novoItem  = document.createElement("li");
								novoItem.className = "list-group-item";
								novoTexto = document.createTextNode(nomemedicamento);
								
								novoItem.appendChild(novoTexto);
								listaPrescricoes.appendChild(novoItem);
								
							}else if(retorno == "Erro3"){
								divErro3 = document.getElementById("erro3");
								divErro3.className = "alert alert-danger d-block";		
							}
						}
						else{
							alert(ajax.statusText);
						}
					}
				}
				
				//Monta a QueryString
				dados = 'idconsulta='+idconsulta+"&nomemedicamento="+nomemedicamento+"&quantidade="+quantidade+"&vezesaodia="+vezesaodia;
				
				//Faz a requisição e envio pelo método POST
				ajax.open('POST', 'prescreverMedicamento.php', true);
				ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				ajax.send(dados);
			}
		}
	
	</script>

  </head>
  <body>

    <div class="container-fluid">
	<div class="row mb-5 mt-5">
		<div class="col-md-12 border" align="center">
			<h3>
				Menu do médico
				<small class="text-muted">Atendimento ao paciente</small>
			</h3>
		</div>
	</div>
	
	<div class="row">
	
		<div class="col-md-9">
			
			<?php
	
				if(!empty($_POST)){
					
					$id           = $_POST['id'];
					$cpfmedico    = $_POST['cpfmedico'];
					$cpfpaciente  = $_POST['cpfpaciente'];
					$nomemedico   = $_POST['nomemedico'];
					$nomepaciente = $_POST['nomepaciente'];
					
				}else{
					
					$id           = $_SESSION['id'];
					$cpfmedico    = $_SESSION['cpfmedico'];
					$cpfpaciente  = $_SESSION['cpfpaciente'];
					$nomemedico   = $_SESSION['nomemedico'];
					$nomepaciente = $_SESSION['nomepaciente'];
				}
			?>
			
			<div class="row">
				
				<div class="col-md-12">
					<dl class="row">
						<dt class="col-sm-5">ID</dt>
						<dd class="col-sm-7"><?php echo $id; ?></dd>

						<dt class="col-sm-5">Nome do médico</dt>
						<dd class="col-sm-7"><?php echo $nomemedico; ?></dd>
				
						<dt class="col-sm-5">Nome do paciente</dt>
						<dd class="col-sm-7"><?php echo $nomepaciente; ?></dd>
					</dl>
			
					<form class="mb-4" method="post" action="finalizarAtendimento.php">
					
						<input type="hidden" id="idconsulta"   name="idconsulta"   value="<?php echo $id; ?>">
						<input type="hidden" id="cpfmedico"    name="cpfmedico"    value="<?php echo $cpfmedico; ?>">
						<input type="hidden" id="cpfpaciente"  name="cpfpaciente"  value="<?php echo $cpfpaciente; ?>">
						<input type="hidden" id="nomemedico"   name="nomemedico"   value="<?php echo $nomemedico; ?>">
						<input type="hidden" id="nomepaciente" name="nomepaciente" value="<?php echo $nomepaciente; ?>">
					
						<div class="form-group">
							<label for="queixaprincipal">Queixa principal</label>
							<textarea rows="4" class="form-control" id="queixaprincipal" name="queixaprincipal"></textarea>
						</div>
				
						<div class="form-group">
							<label for="exameclinico">Exame clínico</label>
							<input type="text" class="form-control" id="exameclinico" name="exameclinico">
						</div>
				
						<div class="form-group">
							<label for="diagnosticoprovavel">Diagnóstico provável</label>
							<input type="text" class="form-control" id="diagnosticoprovavel" name="diagnosticoprovavel">
						</div>
						
						<div class="form-group">
							<label for="especialidade"></label>
							<div class="btn-group-vertical btn-group-toggle btn-block" data-toggle="buttons">
								<label class="btn btn-secondary btn-block">
									<input type="radio" id="radio1" name="altainternacao" autocomplete="off" value="Alta" onclick="ocultarSetores();"> 
									Alta
								</label>
								<label class="btn btn-secondary btn-block">
									<input type="radio" id="radio2" name="altainternacao" autocomplete="off" value="Internação" onclick="mostrarSetores();"> 
									Internação
								</label>
							</div>
						</div>
						
						
						<?php
							
							$conn = getConnection();
							$status = "Livre";
					
							$sql = 'SELECT * FROM leitos WHERE status = :status GROUP BY idsetor';
					
							$stmt = $conn->prepare($sql);
							$stmt->bindValue(':status', $status);
							$stmt->execute();
							$count = $stmt->rowCount();
		
							if($count > 0){
								$result = $stmt->fetchAll();
			
								?>
								<div class="form-group" id="setorescomvagas">
									<label for="label">Setores com vagas</label>
									<div class="btn-group-vertical btn-group-toggle btn-block" data-toggle="buttons">
								<?php
								foreach($result as $row){
									$idleito = $row['id'];
									$idsetor = $row['idsetor'];
									
									$sql1 = 'SELECT nome FROM setores WHERE id = :idsetor';
					
									$stmt1 = $conn->prepare($sql1);
									$stmt1->bindValue(':idsetor', $idsetor);
									$stmt1->execute();
									$count1 = $stmt1->rowCount();
		
									if($count1 > 0){
										$result1 = $stmt1->fetchAll();
			
										foreach($result1 as $row1){
											$nomesetor = $row1['nome'];
											?>
											<label class="btn btn-secondary btn-block">
												<input type="radio" 
												       id="<?php echo $idsetor; ?>" 
												       name="idsetor" 
													   autocomplete="off" 
													   value="<?php echo $idsetor; ?>"> <?php echo $nomesetor; ?>
													
											</label>
											<?php
										}
									}
								}
								?>
									</div>
								</div>
								<?php
							}
							else{
								echo '<div class="alert alert-danger btn-block">
										<strong>Erro!</strong> Não existem setores com vagas.
									  </div>';
							}
													?>
						
						
						<!--
						<div class="form-group">
							<label for="especialidade"></label>
							<div class="btn-group-vertical btn-group-toggle btn-block" data-toggle="buttons">
								<label class="btn btn-secondary btn-block">
									<input type="radio" id="radio1" name="altainternacao" autocomplete="off" value="Alta"> Alta
								</label>
								<label class="btn btn-secondary btn-block">
									<input type="radio" id="radio2" name="altainternacao" autocomplete="off" value="Internação"> Internação
								</label>
							</div>
						</div>
						-->
				
						<button type="submit" class="btn btn-primary btn-block mt-5">Finalizar</button>
					</form>
				</div>
			
			</div>
			
			<div class="row">
				<div class="col-md-4 border-right">
					<form class="mb-4" method="post" action="">
					
						<p class="h4">Solicitar exame</p>
					
						<div class="alert alert-success d-none" role="alert" id="sucesso1">
							Exame solicitado com sucesso.
						</div>
						
						<div class="alert alert-danger d-none" role="alert" id="erro1">
							Erro! Falha no banco de dados.
						</div>
					
						<input type="hidden" id="idconsulta"   name="idconsulta"   value="<?php echo $id; ?>">
									
						<div class="form-group">
							<label for="nomeexame">Nome do exame</label>
							<input type="text" class="form-control" id="nomeexame" name="nomeexame">
						</div>
						
						<div class="form-group">
							<label for="nomeexame">Anotações opcionais</label>
							<input type="text" class="form-control" id="anotacoesopcionais1" name="anotacoesopcionais">
						</div>
				
						<button type="button" onclick="processaExame();" class="btn btn-primary  btn-block">Solicitar</button>
					</form>
				</div>
				
				<div class="col-md-4 border-right">
					<form class="mb-4" method="post" action="">
					
						<p class="h4">Solicitar procedimento</p>
					
						<div class="alert alert-success d-none" role="alert" id="sucesso2">
							Procedimento solicitado com sucesso.
						</div>
						
						<div class="alert alert-danger d-none" role="alert" id="erro2">
							Erro! Falha no banco de dados.
						</div>
						
						<input type="hidden" id="idconsulta" name="idconsulta" value="<?php echo $id; ?>">
						
						<div class="form-group">
							<label for="nomeprocedimento">Nome do procedimento</label>
							<input type="text" class="form-control" id="nomeprocedimento" name="nomeprocedimento">
						</div>
						
						<div class="form-group">
							<label for="anotacoesopcionais">Anotações opcionais</label>
							<input type="text" class="form-control" id="anotacoesopcionais2" name="anotacoesopcionais">
						</div>
				
						<button type="button" onclick="processaProcedimento();" class="btn btn-primary  btn-block">Solicitar</button>
					</form>
				</div>
				
				<div class="col-md-4">
					<form class="mb-4" method="post" action="">
					
						<p class="h4">Prescrever medicamento</p>
						
						<div class="alert alert-success d-none" role="alert" id="sucesso3">
							Medicação prescrita com sucesso.
						</div>
						
						<div class="alert alert-danger d-none" role="alert" id="erro3">
							Erro! Falha no banco de dados.
						</div>
						
						<input type="hidden" id="idconsulta" name="idconsulta" value="<?php echo $id; ?>">
						
						<div class="form-group">
							<label for="nomemedicamento">Nome do medicamento</label>
							<input type="text" class="form-control" id="nomemedicamento" name="nomemedicamento">
						</div>
						
						<div class="form-group">
							<label for="quantidade">Quantidade</label>
							<input type="text" class="form-control" id="quantidade" name="quantidade">
						</div>
						
						<div class="form-group">
							<label for="vezesaodia">Número de vezes ao dia</label>
							<input type="text" class="form-control" id="vezesaodia" name="vezesaodia">
						</div>
				
						<button type="button" onclick="processaPrescricao();" class="btn btn-primary btn-block">Prescrever</button>
					</form>
				</div>
				
			</div>
			
			<div class="row">
				<div class="col-md-4 border-right">
					<p class="h4 border-bottom">Exames solicitados</p>
					
					<ul class="list-group" id="exames">
					
					<?php
					
						$status = "Solicitado";
		
						$sql = 'SELECT idexame FROM consultaexame WHERE idconsulta = :idconsulta';
						$stmt = $conn->prepare($sql);
						$stmt->bindValue(':idconsulta' , $id);
						$stmt->execute();
						$count = $stmt->rowCount();
		
						if($count > 0){
							$result = $stmt->fetchAll();
			
							foreach($result as $row){
								
								$idexame = $row['idexame'];
								
								$sql1 = 'SELECT nomeexame FROM exames WHERE id = :idexame AND status = :status';
								$stmt1 = $conn->prepare($sql1);
								$stmt1->bindValue(':idexame', $idexame);
								$stmt1->bindValue(':status' , $status);
								$stmt1->execute();
								$count1 = $stmt1->rowCount();
		
								if($count1 > 0){
									$result1 = $stmt1->fetchAll();
			
									foreach($result1 as $row1){
										$nomeexame = $row1['nomeexame'];
								
										?>
										<li class="list-group-item"><?php echo $nomeexame; ?></li>
										<?php
									}
								}
							}
						}
					?>
					
					</ul>
				</div>
				
				<div class="col-md-4 border-right">
					<p class="h4 border-bottom">Procedimentos solicitados</p>
					
					<ul class="list-group" id="procedimentos">
					
					<?php
					
						$status = "Solicitado";
		
						$sql = 'SELECT idprocedimento FROM consultaprocedimento WHERE idconsulta = :idconsulta';
						$stmt = $conn->prepare($sql);
						$stmt->bindValue(':idconsulta' , $id);
						$stmt->execute();
						$count = $stmt->rowCount();
		
						if($count > 0){
							$result = $stmt->fetchAll();
			
							foreach($result as $row){
								
								$idprocedimento = $row['idprocedimento'];
								
								$sql1 = 'SELECT nomeprocedimento FROM procedimentos WHERE id = :idprocedimento AND status = :status';
								$stmt1 = $conn->prepare($sql1);
								$stmt1->bindValue(':idprocedimento', $idprocedimento);
								$stmt1->bindValue(':status' , $status);
								$stmt1->execute();
								$count1 = $stmt1->rowCount();
		
								if($count1 > 0){
									$result1 = $stmt1->fetchAll();
			
									foreach($result1 as $row1){
										$nomeprocedimento = $row1['nomeprocedimento'];
								
										?>
										<li class="list-group-item"><?php echo $nomeprocedimento; ?></li>
										<?php
									}
								}
							}
						}
					?>
					
					
					</ul>
				</div>
				
				<div class="col-md-4">
					<p class="h4 border-bottom">Prescrições de medicamentos</p>
					
					<ul class="list-group" id="prescricoes">
					
					<?php
		
						$sql = 'SELECT nomemedicamento FROM prescricoes WHERE idconsulta = :idconsulta';
						$stmt = $conn->prepare($sql);
						$stmt->bindValue(':idconsulta' , $id);
						$stmt->execute();
						$count = $stmt->rowCount();
		
						if($count > 0){
							$result = $stmt->fetchAll();
			
							foreach($result as $row){
								$nomemedicamento = $row['nomemedicamento'];
								
								?>
								<li class="list-group-item"><?php echo $nomemedicamento; ?></li>
								<?php
							}
						}
					?>
					
					</ul>
					
				</div>
			</div>
			
		</div>
		
		<div class="col-md-3">
			<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'consultasMedico.php';">Minhas consultas</button>
			
			<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'examesMedico.php';">Meus exames</button>
			
			<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'procedimentosMedico.php';">Meus procedimentos</button>
			
			<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'pacientesMedico.php';">Meus pacientes</button>
			
			<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'minhasAnamneses.php';">Minhas anamneses</button>
			
			<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'minhasEvolucoes.php';">Minhas evoluções</button>
			
			<?php
			
				$cpfmedico  = $_SESSION['cpf'];
				$diahorario = time();
				
				$conn = getConnection();
				
				$sql = 'SELECT * FROM plantoes WHERE diahorarioinicio < :diahorario1 AND diahorariofim > :diahorario2';
				$stmt = $conn->prepare($sql);
				$stmt->bindValue(':diahorario1', $diahorario);
				$stmt->bindValue(':diahorario2', $diahorario);
				$stmt->execute();
				$count = $stmt->rowCount();
		
				if($count > 0){
					$result = $stmt->fetchAll();
			
					foreach($result as $row){
						
						$idplantao = $row['id'];
						
						$sql1 = 'SELECT * FROM profissionaisplantao WHERE idplantao = :idplantao AND cpfprofissional = :cpfprofissional';
						$stmt1 = $conn->prepare($sql1);
						$stmt1->bindValue(':idplantao'      , $idplantao);
						$stmt1->bindValue(':cpfprofissional', $cpfmedico);
						$stmt1->execute();
						$count1 = $stmt1->rowCount();
		
						if($count1 > 0){
							//Está escalado para o plantão atual, portanto pode realizar internações.
							?>
							
							<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'gerenciamentoInternacoes.php';">
								Gerenciar internações
							</button>
							<?php
						}
						else{
							?>
							<div class="alert alert-primary mt-3" role="alert">
								Você não está escalado para o plantão atual!
							</div>
							<?php
						}	
					}
				}
			?>
			
			<button type="button" class="btn btn-danger btn-lg btn-block" onclick="location.href = 'sair.php';">Sair</button>
			
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