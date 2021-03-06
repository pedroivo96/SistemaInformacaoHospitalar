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

    <title>Agendar consulta</title>

    <meta name="description" content="Source code generated using layoutit.com">
    <meta name="author" content="LayoutIt!">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
	
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
		
		function processa(){
			ajax = iniciaAjax();
			
			idconsulta         = document.getElementById("idconsulta").value;
			nomeexame          = document.getElementById("nomeexame").value;
			anotacoesopcionais = document.getElementById("anotacoesopcionais").value;
			
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
	</script>
	
  </head>
  <body>

    <div class="container-fluid px-5">
	<div class="row mb-5 mt-5">
		<div class="col-md-12 border" align="center">
			<h3>
				Menu do paciente
				<small class="text-muted">Agendar consulta</small>
			</h3>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-9">
		
			<div class="alert alert-primary d-block" role="alert">
				Resultado da busca
			</div>
			
			<?php
				include './conexao.php';
				
				date_default_timezone_set("America/Fortaleza"); 

				if(!empty($_POST)){
					$especialidade = $_POST['especialidade'];
					$diahorariotemp    = $_POST['diahorario'];
					$diahorario = strtotime($diahorariotemp);
					
					$tipo = "Médico";
					
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
							
							$idplantao        = $row['id'];
							//echo $idplantao;
							$diahorarioinicio = $row['diahorarioinicio'];
							$diahorariofim    = $row['diahorariofim'];
							
							$sql1 = 'SELECT cpfprofissional FROM profissionaisplantao WHERE idplantao = :idplantao';
							$stmt1 = $conn->prepare($sql1);
							$stmt1->bindValue(':idplantao', $idplantao);
							$stmt1->execute();
							$count1 = $stmt1->rowCount();
							
							if($count1 > 0){
								
								$result1 = $stmt1->fetchAll();
		
								foreach($result1 as $row1){
									
									$cpfprofissional = $row1['cpfprofissional'];
									
									$sql2 = 'SELECT * FROM profissionais WHERE  cpf = :cpfprofissional AND especialidade LIKE :especialidade AND tipo = :tipo';
									$stmt2 = $conn->prepare($sql2);
									$stmt2->bindValue(':cpfprofissional', $cpfprofissional);
									$stmt2->bindValue(':especialidade'  , "%".$especialidade."%");
									$stmt2->bindValue(':tipo'           , $tipo);
									$stmt2->execute();
									$count2 = $stmt2->rowCount();
							
									if($count2 > 0){
								
										$result2 = $stmt2->fetchAll();
		
										foreach($result2 as $row2){
											
											$nomemedico     = $row2['nomecompleto'];
											$especialidade1 = $row2['especialidade'];
											
											?>
											<div class="col-sm-4 mb-3">
												<div class="card">
													<form method="post" action="agendarConsulta.php">
											
														<div class="card-body">
													
															<div class="form-group">
																<label for="exampleInputEmail1">Nome do médico:</label>
																<h5 class="card-title" id="nomecompleto" name="nomecompleto">
																	<?php echo $nomemedico; ?>
																</h5>
															</div>
													
															<input type="hidden" id="cpf"              name="cpf"              value="<?php echo $cpfprofissional; ?>">
															<input type="hidden" id="diahorarioinicio" name="diahorarioinicio" value="<?php echo $diahorarioinicio; ?>">
															<input type="hidden" id="diahorariofim"    name="diahorariofim"    value="<?php echo $diahorariofim; ?>">
													
															<div class="form-group">
																<label for="exampleInputEmail1">Especialidade:</label>
																<h6 class="card-text" id="especialidade" name="especialidade">
																	<?php echo $especialidade1; ?>
																</h6>
															</div>
													
															<button type="submit" class="btn btn-primary btn-block">Agendar</button>
														</div>
													</form>	
												</div>
											</div>
											<?php
										}
									}
									else{
										echo 
											'<div class="alert alert-warning">
												<strong>Nenhum médico dessa especialidade cadastrado nesse plantão!</strong>
											</div>';
									}
									break;
								}
								
							}
							else{
								echo 
									'<div class="alert alert-warning">
										<strong>Nenhum profissional cadastrado nesse plantão!</strong>
									</div>';
							}
							break;
						}
			
					}else{
						echo 
							'<div class="alert alert-warning">
								<strong>Nenhum plantão cadastrado nesse horário!</strong>
						    </div>';
					}
				}
			?>
		
		</div>
		
		<div class="col-md-3">
			<?php include 'menuPacienteInclude.php'; ?>
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