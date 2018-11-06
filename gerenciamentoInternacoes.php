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

    <title>Gerenciamento de Internações</title>

    <meta name="description" content="Source code generated using layoutit.com">
    <meta name="author" content="LayoutIt!">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
	
	<script type="text/javascript">
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
		
		function listarTecnicos(cpfpaciente){
	
			alert(cpfpaciente);
	
			listaTecnicos = document.getElementById(cpfpaciente);
		
			if (listaTecnicos.style.display == "none") {
				listaTecnicos.style.display = "block";
			} else {
				listaTecnicos.style.display = "none";
			}
		}
		
		function associacao(cpfpaciente, cpftecnico, nometecnico){
			
			ajax = iniciaAjax();
			
			if(ajax){
				
				ajax.onreadystatechange = function(){
					if(ajax.readyState == 4){
						if(ajax.status == 200){
							retorno = ajax.responseText;
							
							if(retorno == "Erro"){
								
								alertErro = document.getElementById("erro");
								alertErro.style.display = "block";
								
							}else{
								
								/*
								//Botão de listar tecnicos some
								listarTecnicosButton = document.getElementById("listarTecnicosButton");
								listarTecnicosButton.style.display = "none"; 
								
								//A lista de técnicos também some
								listaTecnicos = document.getElementById("listatecnicos");
								listaTecnicos.style.display = "none";
								
								//Cria a TAG que mostrar o técnico responsável
								tecnico = document.getElementById("tecnico");
								nometecnicoNode = document.createTextNode(nometecnico);
								tecnico.appendChild(nometecnicoNode);
								tecnico.style.display = "block";
								*/
								
								location.reload();
																
							}
						}
						else{
							alert(ajax.statusText);
						}
						
					}
				}
				
				
				//Monta a QueryString
				dados = 'cpfpaciente='+cpfpaciente+"&cpftecnico="+cpftecnico+"&nometecnico="+nometecnico;
				
				//Faz a requisição e envio pelo método POST
				ajax.open('POST', 'associarTecnico1.php', true);
				ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				ajax.send(dados);
				
			}
			
		}
		
	</script>
	
  </head>
  <body>

    <div class="container-fluid px-5">
	<div class="row mb-5 mt-5">
		<div class="col-md-12 border" align="center">
			<?php
			
			date_default_timezone_set("America/Fortaleza");
			
			$tipo = $_SESSION['tipo'];
			
			if($tipo == "Médico"){
				?>
				<h3>
					Menu do médico
					<small class="text-muted">Gerenciamento de internações</small>
				</h3>
				<?php
			}
			else{
				?>
				<h3>
					Menu do enfermeiro
					<small class="text-muted">Gerenciamento de internações</small>
					
				</h3>
				<?php
			}
			?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-8">
			
			<p class="h5">Internados</p>
			
			<div class="row">
			
			<?php
				$cpfprofissional = $_SESSION['cpf'];
				$tipo            = $_SESSION['tipo'];
				
				include './conexao.php';
				
				$status = "Realizada";
				
				$conn = getConnection();
		
				$sql = 'SELECT * FROM internacoes WHERE status = :status';
				$stmt = $conn->prepare($sql);
				$stmt->bindValue(':status', $status);
				$stmt->execute();
				$count = $stmt->rowCount();
		
				if($count > 0){
					$result = $stmt->fetchAll();
			
					foreach($result as $row){
				
						$idinternacao      = $row['id'];
						$idleito           = $row['idleito'];
						$cpfpaciente       = $row['cpfpaciente'];
						$diahorarioentrada = $row['diahorarioentrada'];
						//$diahorarioalta    = $row['diahorarioalta'];
						$cpfmedico         = $row['cpfmedico'];
						//$cpftecnico        = $row['cpftecnico'];
						
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
								<div class="col-sm-4 mb-3">
								<div class="card">
									<div class="card-header">
										<?php echo $nomepaciente; ?>
									</div>
									<div class="card-body px-2">
									
										<?php
											$timestamptoday = time();
											$flag = 0;
											
											$sql2 = 'SELECT diahorario FROM evolucoes WHERE cpfpaciente = :cpfpaciente';
											$stmt2 = $conn->prepare($sql2);
											$stmt2->bindValue(':cpfpaciente', $cpfpaciente);
											$stmt2->execute();
											$count2 = $stmt2->rowCount();
		
											if($count2 > 0){
												$result2 = $stmt2->fetchAll();
			
												foreach($result2 as $row2){
													$diahorario = $row2['diahorario'];
													
													if(date("d/m/y", $timestamptoday) == date("d/m/y", $diahorario)){
														$flag = 1;
													}
												}
											}
											
											if($flag == 0){
												?>
												<form method="post" action="evolucaoPaciente.php">
													<input type="hidden" id="cpfpaciente"     name="cpfpaciente"     value="<?php echo $cpfpaciente; ?>">
													<input type="hidden" id="cpfprofissional" name="cpfprofissional" value="<?php echo $cpfprofissional; ?>">
													<input type="hidden" id="tipo"            name="tipo"            value="<?php echo $tipo; ?>">
											
													<button type="submit" class="btn btn-primary btn-block mt-2 mb-1">Evoluir</button>
												</form>
												
												<?php
											}
											
										if($tipo == "Enfermeiro"){
											
											$diahorarioatual = time();
											
											//Construir uma lista com os Técnicos disponíveis no plantão atual
											
											$tecnicos = array();
											
											$sql3 = 'SELECT id FROM plantoes WHERE diahorarioinicio <= :diahorario1 AND diahorariofim >= :diahorario2';
											$stmt3 = $conn->prepare($sql3);
											$stmt3->bindValue(':diahorario1', $diahorarioatual);
											$stmt3->bindValue(':diahorario2', $diahorarioatual);
											$stmt3->execute();
											$count3 = $stmt3->rowCount();
		
											if($count3 > 0){
												$result3 = $stmt3->fetchAll();
			
												foreach($result3 as $row3){
													$idplantao = $row3['id'];
													
													$sql4 = 'SELECT cpfprofissional FROM profissionaisplantao WHERE idplantao = :idplantao';
													$stmt4 = $conn->prepare($sql4);
													$stmt4->bindValue(':idplantao', $idplantao);
													$stmt4->execute();
													$count4 = $stmt4->rowCount();
		
													if($count4 > 0){
														$result4 = $stmt4->fetchAll();
			
														foreach($result4 as $row4){
															$cpfprofissional = $row4['cpfprofissional'];
															
															$tipo1 = "Técnico em Enfermagem";
															
															$sql5 = 'SELECT nomecompleto FROM profissionais WHERE cpf = :cpfprofissional AND tipo = :tipo';
															$stmt5 = $conn->prepare($sql5);
															$stmt5->bindValue(':cpfprofissional', $cpfprofissional);
															$stmt5->bindValue(':tipo', $tipo1);
															$stmt5->execute();
															$count5 = $stmt5->rowCount();
		
															if($count5 > 0){
																$result5 = $stmt5->fetchAll();
			
																foreach($result5 as $row5){
																	$nomecompleto = $row5['nomecompleto'];
																	
																	$tecnicos[$cpfprofissional] = $nomecompleto;
																}
															}
														}
													}
												}
											}
											
											if(empty($row['cpftecnico'])){
								
												?>
												<button type="button" 
														onclick="listarTecnicos(<?php echo $cpfpaciente; ?>);" 
														class="btn btn-primary btn-block">
													Listar técnicos
												</button>
												
												<br />
												
												<div class="alert alert-danger" role="alert" id="erro" style="display : none">
													Erro no banco de dados.
												</div>
												
												<?php
											
												if(count($tecnicos) == 0){
													?>
													<div class="alert alert-danger" role="alert">
														Não há técnicos cadastrados nesse plantão.
													</div>
													<?php
												}
												else{
													//Percorre o array de Técnicos e cria uma lista de botões para que o Enfermeiro clique e selecione
													?>
													<div class="btn-group-vertical btn-block mb-2" id="<?php echo $cpfpaciente; ?>">
													<?php
													
													foreach($tecnicos as $cpf => $nometecnico) {
														
														?>
														<button type="button" 
														        onclick="associacao(<?php echo $cpfpaciente        ; ?>,
																                    <?php echo $cpf                ; ?>,
																					<?php echo "'".$nometecnico."'"; ?>);" 
																class="btn btn-secondary btn-sm"> 
																<?php echo $nometecnico; ?>
														</button>
														<?php
													}
													?>
													</div>
													<?php
												}
											}
											else{
											
												$cpftecnico = $row['cpftecnico'];
											
												$sql2 = 'SELECT nomecompleto FROM profissionais WHERE cpf = :cpftecnico';
												$stmt2 = $conn->prepare($sql2);
												$stmt2->bindValue(':cpftecnico', $cpftecnico);
												$stmt2->execute();
												$count2 = $stmt2->rowCount();
		
												if($count2 > 0){
													$result2 = $stmt2->fetchAll();
			
													foreach($result2 as $row2){
														$nometecnico = $row2['nomecompleto'];
														?>
														
														<h5>											
															<small class="text-muted">Técnico responsável:</small><br />
															<?php echo $nometecnico; ?>
														</h5>
												
														<?php
													}
												}
											}
										}
										
										
										if($tipo == "Médico" || $tipo == "Enfermeiro"){
											
											
											$sql3 = 'SELECT * FROM anamnese WHERE idinternacao = :idinternacao';
											$stmt3 = $conn->prepare($sql3);
											$stmt3->bindValue(':idinternacao', $idinternacao);
											$stmt3->execute();
											$count3 = $stmt3->rowCount();
		
											if($count3 > 0){
												$result3 = $stmt3->fetchAll();
					
												foreach($result3 as $row3){
													
													$idanamnese = $row3['id'];
													
													?>
													<form method="POST" action="verAnamnese.php">
														<input type="hidden" id="idinternacao" name="idinternacao" value="<?php echo $idinternacao;?>">
														<input type="hidden" id="idanamnese" name="idanamnese"value="<?php echo $idanamnese; ?>">
														<button class="btn btn-info btn-block">Ver anamnese</button>
													</form>
													<?php
												}
											}
											else{
											?>
											<form method="POST" action="fazerAnamnese.php">
												<input type="hidden" name="idinternacao" id="idinternacao" value="<?php echo $idinternacao;?>">
												<button class="btn btn-primary btn-block">Fazer anamnese</button>
											</form>
											<?php	
											}
										}
										
										?>
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
					<div class="alert alert-primary btn-block" role="alert">
						Não existem pacientes internados.
					</div>
					<?php
				}
			?>
			</div>
			
			<?php
			if($tipo == "Médico"){
				?>
				<p class="h5">A internar</p>
				<div class="row">
					
					<?php
					$status = "Solicitada";
					
					$sql = 'SELECT * FROM internacoes WHERE status = :status';
					$stmt = $conn->prepare($sql);
					$stmt->bindValue(':status', $status);
					$stmt->execute();
					$count = $stmt->rowCount();
		
					if($count > 0){
						$result = $stmt->fetchAll();
			
						foreach($result as $row){
							
							$cpfpaciente = $row['cpfpaciente'];
							$cpfmedico   = $row['cpfmedico'];
							$idsetor     = $row['idsetor'];
							
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
									<div class="col-sm-4 mb-3">
										<form method="post" action="internarPaciente.php">
											<div class="card border-secondary">
												<div class="card-header">
													<label for="nomecompleto">Nome do paciente:</label>
													<h5 class="card-title" id="nomecompleto" name="nomecompleto">
														<?php echo $nomepaciente; ?>
													</h5>
												</div>
											
												<input type="hidden" id="cpfpaciente" name="cpfpaciente" value="<?php echo $cpfpaciente; ?>">
												<input type="hidden" id="cpfmedico"   name="cpfmedico"   value="<?php echo $cpfmedico; ?>">
												<input type="hidden" id="idsetor"     name="idsetor"     value="<?php echo $idsetor; ?>">
								
												<div class="card-body">
													<button type="submit" class="btn btn-primary btn-block">Internar</button>
												</div>
											</div>
										</form>
									</div>
									<?php
								}
							}
						}
					}
					else{
						?>
						<div class="alert alert-primary btn-block" role="alert">
							Não existem pacientes a serem internados.
						</div>
						<?php
					}
					?>
				
				</div>
				<?php
			}
			?>
		</div>
		
		<div class="col-md-4">
		
			<?php
			if($tipo == "Enfermeiro"){
				$cpfprofissional = $_SESSION['cpf'];
				
				//$conn = getConnection();
				
				$diahorario = time();
		
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
						$chefe = 1;
							
						$sql1 = 'SELECT * FROM profissionaisplantao WHERE cpfprofissional = :cpfprofissional AND idplantao = :idplantao';
						$stmt1 = $conn->prepare($sql1);
						$stmt1->bindValue(':cpfprofissional', $cpfprofissional);
						$stmt1->bindValue(':idplantao', $idplantao);
						$stmt1->execute();
						$count1 = $stmt1->rowCount();
		
						if($count1 > 0){
							$result1 = $stmt1->fetchAll();
			
							foreach($result1 as $row1){
							
								$idplantao = $row1['idplantao'];
								$chefe = $row1['chefe'];
						
								$chefe = 1;
								
								?>
								<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'gerenciamentoInternacoes.php';">Gerenciar internações</button>
								<?php
								
							
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
			
			<?php	
			}
			if($tipo == "Médico"){
				?>
				<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'consultasMedico.php';">
					Minhas consultas
				</button>
			
				<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'examesMedico.php';">
					Meus exames
				</button>
				
				<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'procedimentosMedico.php';">
					Meus procedimentos
				</button>
			
				<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'pacientesMedico.php';">
					Meus pacientes
				</button>
			
				<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'minhasAnamneses.php';">
					Minhas anamneses
				</button>
			
				<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'minhasEvolucoes.php';">
					Minhas evoluções
				</button>
			
				<?php
			
				$cpfmedico  = $_SESSION['cpf'];
				$diahorario = time();
				
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
							<div class="alert alert-primary" role="alert">
								Você não está escalado(a) para o plantão atual
							</div>
							<?php
						}	
					}
				}
				?>
				<button type="button" class="btn btn-danger btn-lg btn-block" onclick="location.href = 'sair.php';">
					Sair
				</button>
				<?php
			}
			?>
		
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
		</div>
	</div>
</div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>