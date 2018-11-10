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
		
		function cadastrarProfissional(){
			ajax = iniciaAjax();	
			
			if(ajax){
				ajax.onreadystatechange = function(){
					if(ajax.readyState == 4){
						if(ajax.status == 200){
							retorno = ajax.responseText;
							
							if(retorno == "ERRO1"){
								
								divResposta = document.getElementById('resposta1');
								divResposta.style.display = "block";
								divResposta.className = "alert alert-danger";
								divResposta.innerHTML = "CPF ou RG ou Registro ou Nome de usuário já cadastrado.";
								
							}else if(retorno == "ERRO2"){
								
								divResposta = document.getElementById('resposta1');
								divResposta.style.display = "block";
								divResposta.className = "alert alert-danger";
								divResposta.innerHTML = "Erro na base de dados.";
								
							}else{//retorno == "SUCESSO"
							
								divResposta = document.getElementById('resposta1');
								divResposta.style.display = "block";
								divResposta.className = "alert alert-sucess";
								divResposta.innerHTML = "Sucesso!";
							}
						}
						else{
							alert(ajax.statusText);
						}
					}
				}
				
				var cpf           = document.getElementById('cpf').value;
				var rg            = document.getElementById('rg').value;
				var nomecompleto  = document.getElementById('nomecompleto').value;
				var registro      = document.getElementById('registro').value;
				var nomeusuario   = document.getElementById('nomeusuario').value;
				var senha         = document.getElementById('senha').value;
				var especialidade = document.getElementById('especialidade').value;
				var tipo          = "";
			
				if(document.getElementById('radio1').checked == true){
					//alert(document.getElementById('radio1').value);
					tipo = "Médico";
				}
				if(document.getElementById('radio2').checked == true){
					//alert(document.getElementById('radio2').value);
					tipo = "Enfermeiro";
				}
				if(document.getElementById('radio3').checked == true){
					//alert(document.getElementById('radio3').value);
					tipo = "Técnico em Enfermagem";
				}
				
				//Monta a QueryString
				dados = 'cpf='+cpf+
				        "&rg="+rg+
				        "&nomecompleto="+nomecompleto+
						"&registro="+registro+
						"&nomeusuario="+nomeusuario+
						"&senha="+senha+
						"&especialidade="+especialidade+
						"&tipo="+tipo;
				
				//Observação: esse formulário deve ser o primeiro a ser preenchido desse modo, ele habilitará os outros.
				
				//Faz a requisição e envio pelo método POST
				ajax.open('POST', 'cadastrarProfissional.php', true);
				ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				ajax.send(dados);
			}
		}
		
		function cadastrarPlantao(){
			ajax = iniciaAjax();	
			
			if(ajax){
				ajax.onreadystatechange = function(){
					if(ajax.readyState == 4){
						if(ajax.status == 200){
							retorno = ajax.responseText;
							
							if(retorno == "ERRO"){
								
								divResposta = document.getElementById('resposta2');
								divResposta.style.display = "block";
								divResposta.className = "alert alert-danger";
								divResposta.innerHTML = "Erro no banco de dados.";
								
							}else{//Retorno é igual ao ID do Plantão inserido
								
								divResposta = document.getElementById('resposta2');
								divResposta.style.display = "block";
								divResposta.className = "alert alert-success";
								divResposta.innerHTML = "Plantão cadastrado com sucesso e ID = "+retorno;
								
							}
						}
						else{
							alert(ajax.statusText);
						}
					}
				}
				
				var diahorarioinicio = document.getElementById('diahorarioinicio').value;
				var diahorariofim    = document.getElementById('diahorariofim').value;
				
				//Monta a QueryString
				dados = 'diahorarioinicio='+diahorarioinicio+
				        "&diahorariofim="+diahorariofim;
				
				//Observação: esse formulário deve ser o primeiro a ser preenchido desse modo, ele habilitará os outros.
				
				//Faz a requisição e envio pelo método POST
				ajax.open('POST', 'cadastrarPlantao.php', true);
				ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				ajax.send(dados);
			}
		}
		
		function cadastrarProfissionalPlantao(){
			ajax = iniciaAjax();	
			
			if(ajax){
				ajax.onreadystatechange = function(){
					if(ajax.readyState == 4){
						if(ajax.status == 200){
							retorno = ajax.responseText;
							
							if(retorno == "ERRO"){
								
								divResposta = document.getElementById('resposta3');
								divResposta.style.display = "block";
								divResposta.className = "alert alert-danger";
								divResposta.innerHTML = "Erro no banco de dados.";
								
							}else{//Retorno é igual ao ID do Plantão inserido
								
								divResposta = document.getElementById('resposta3');
								divResposta.style.display = "block";
								divResposta.className = "alert alert-success";
								divResposta.innerHTML = "Profissional cadastrado com sucesso no plantão.";
								
							}
						}
						else{
							alert(ajax.statusText);
						}
					}
				}
				
				var cpfprofissional = document.getElementById('cpfprofissional').value;
				var idplantao       = document.getElementById('idplantao').value;
				
				//Monta a QueryString
				dados = 'cpfprofissional='+cpfprofissional+
				        "&idplantao="+idplantao;
				
				//Observação: esse formulário deve ser o primeiro a ser preenchido desse modo, ele habilitará os outros.
				
				//Faz a requisição e envio pelo método POST
				ajax.open('POST', 'cadastrarProfissionalPlantao.php', true);
				ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				ajax.send(dados);
			}
		}
		
		function cadastrarSetor(){
			ajax = iniciaAjax();	
			
			if(ajax){
				ajax.onreadystatechange = function(){
					if(ajax.readyState == 4){
						if(ajax.status == 200){
							retorno = ajax.responseText;
							
							if(retorno == "ERRO"){
								
								divResposta = document.getElementById('resposta4');
								divResposta.style.display = "block";
								divResposta.className = "alert alert-danger";
								divResposta.innerHTML = "Erro no banco de dados.";
								
							}else{//Retorno é igual ao ID do Plantão inserido
								
								divResposta = document.getElementById('resposta4');
								divResposta.style.display = "block";
								divResposta.className = "alert alert-success";
								divResposta.innerHTML = "Setor cadastrado com sucesso.";
								
							}
						}
						else{
							alert(ajax.statusText);
						}
					}
				}
				
				var nomesetor = document.getElementById('nomesetor').value;
				
				//Monta a QueryString
				dados = 'nomesetor='+nomesetor;
				
				//Observação: esse formulário deve ser o primeiro a ser preenchido desse modo, ele habilitará os outros.
				
				//Faz a requisição e envio pelo método POST
				ajax.open('POST', 'cadastrarSetor.php', true);
				ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				ajax.send(dados);
			}
		}
		
		function cadastrarLeitoSetor(){
			ajax = iniciaAjax();	
			
			if(ajax){
				ajax.onreadystatechange = function(){
					if(ajax.readyState == 4){
						if(ajax.status == 200){
							retorno = ajax.responseText;
							
							if(retorno == "ERRO"){
								
								divResposta = document.getElementById('resposta5');
								divResposta.style.display = "block";
								divResposta.className = "alert alert-danger";
								divResposta.innerHTML = "Erro no banco de dados.";
								
							}else{
								
								divResposta = document.getElementById('resposta5');
								divResposta.style.display = "block";
								divResposta.className = "alert alert-success";
								divResposta.innerHTML = "Leito cadastrado com sucesso.";
								
							}
						}
						else{
							alert(ajax.statusText);
						}
					}
				}
				
				var setores = document.getElementsByName('setor');
				var idSetor = "";
				
				
				for (var i = 0, length = setores.length; i < length; i++){
					
					if (setores[i].checked){
						// do whatever you want with the checked radio
						//alert(setores[i].value);
						
						idSetor = setores[i].value;

						// only one radio can be logically checked, don't check the rest
						break;
					}
				}
				
				//Monta a QueryString
				dados = 'idsetor='+idSetor;
				
				//Observação: esse formulário deve ser o primeiro a ser preenchido desse modo, ele habilitará os outros.
				
				//Faz a requisição e envio pelo método POST
				ajax.open('POST', 'cadastrarLeito.php', true);
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
				Administrador
				<small class="text-muted">Painel de controle</small>
			</h3>
		</div>
	</div>
	
	<div class="row mb-5">
		
		<div class="col-md-4 border pt-2 pb-2">
			<p class="h4" align="center">Cadastrar profissional</p>
			
			<div id="resposta1" class="alert alert-primary w-100 d-none" role="alert">
				This is a primary alert—check it out!
			</div>
			
			<form method="post" action="">
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
				
				
				<button type="button" class="btn btn-primary btn-block" onclick="cadastrarProfissional();">Cadastrar</button>
			</form>
		</div>
		
		<div class="col-md-4 border pt-2 pb-2">
			<p class="h4" align="center">Cadastrar plantão</p>
			
			<div id="resposta2" class="alert alert-primary w-100 d-none" role="alert">
				This is a primary alert—check it out!
			</div>
			
			<form method="post" action="">
				
				<div class="form-group">
					<label for="diahorarioinicio">Dia e horário de início</label>
					<input type="datetime-local" class="form-control" id="diahorarioinicio" name="diahorarioinicio">
				</div>
				
				<div class="form-group">
					<label for="diahorariofim">Dia e horário de fim</label>
					<input type="datetime-local" class="form-control" id="diahorariofim" name="diahorariofim">
				</div>
				
				<button type="button" class="btn btn-primary btn-block" onclick="cadastrarPlantao();">Cadastrar</button>
			</form>
		
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-4 border pt-2 pb-2 mb-5">
			<p class="h4" align="center">Cadastrar profissional em um plantão</p>
			
			<div id="resposta3" class="alert alert-primary w-100 d-none" role="alert">
				This is a primary alert—check it out!
			</div>
			
			<form method="post" action="">
				
				<div class="form-group">
					<label for="cpfprofissional">CPF do profissional</label>
					<input type="text" class="form-control" id="cpfprofissional" name="cpfprofissional">
				</div>
				
				<div class="form-group">
					<label for="idplantao">ID do plantão</label>
					<input type="text" class="form-control" id="idplantao" name="idplantao">
				</div>
				
				<button type="button" onclick="cadastrarProfissionalPlantao();" class="btn btn-primary btn-block">Cadastrar</button>
			</form>
		
		</div>
		
		<div class="col-md-4 border pt-2 pb-2 mb-5">
			<p class="h4" align="center">Cadastrar novo setor</p>
			
			<div id="resposta4" class="alert alert-primary w-100 d-none" role="alert">
				This is a primary alert—check it out!
			</div>
			
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
			
			<div id="resposta5" class="alert alert-primary w-100 d-none" role="alert">
				This is a primary alert—check it out!
			</div>
			
			<form method="post" action="">
				
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
					<button type="button" onclick="cadastrarLeitoSetor();" class="btn btn-primary btn-block">Cadastrar</button>
					<?php
				}
				?>
			</form>
		
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-4 border pt-2 pb-2 mb-5">
			<p class="h4" align="center">Cadastrar resultados de exame</p>
			
			<form method="post" action="cadastrarResultadoExame.php" enctype="multipart/form-data">
				
				<div class="form-group">
					<label for="id">ID do exame</label>
					<input type="text" class="form-control" id="id" name="id">
				</div>
				
				<div class="form-group">
					<label for="conteudo">Arquivo</label>
					<input type="file" class="form-control" id="conteudo" name="conteudo">
				</div>
				
				<button type="submit" name="submit" class="btn btn-primary btn-block">Cadastrar</button>
			</form>
		
		</div>
		
		<div class="col-md-4 border pt-2 pb-2 mb-5">
			<p class="h4" align="center">Cadastrar resultados de procedimento</p>
			
			<form method="post" action="cadastrarResultadoProcedimento.php" enctype="multipart/form-data">
				
				<div class="form-group">
					<label for="cpfprofissional">ID do procedimento</label>
					<input type="text" class="form-control" id="id" name="id">
				</div>
				
				<div class="form-group">
					<label for="conteudo">Arquivo</label>
					<input type="file" class="form-control" id="conteudo" name="conteudo">
				</div>
				
				<button type="submit" name="submit" class="btn btn-primary btn-block">Cadastrar</button>
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