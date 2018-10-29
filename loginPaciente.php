<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login paciente</title>

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
			
			if(ajax){
				ajax.onreadystatechange = function(){
					if(ajax.readyState == 4){
						if(ajax.status == 200){
							retorno = ajax.responseText;
							
							if(retorno == "Erro1"){
								
								divErro = document.getElementById("erro");
								divErro.className = "alert alert-danger d-block";
								
							}else if(retorno == "OK"){
								
								window.location = "menuPaciente.php";
								
							}
						}
						else{
							alert(ajax.statusText);
						}
						
					}
				}
				
				nomeUsuario = document.getElementById("nomeusuario").value;
				senha = document.getElementById("senha").value;
				
				//Monta a QueryString
				dados = 'nomeusuario='+nomeUsuario+"&senha="+senha;
				
				//Faz a requisição e envio pelo método POST
				ajax.open('POST', 'logarPaciente.php', true);
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
			<h5 class="display-4">Login paciente</h5>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4">
		</div>
		
		<div class="col-md-4">
		
			<div class="alert alert-danger d-none" role="alert" id="erro">
				As informações não correspondem a um usuário cadastrado.
			</div>
		
		
			<form method="post" action="">
				<div class="form-group">
					<label for="nomeusuario">Nome de usuário</label>
					<input type="text" class="form-control" id="nomeusuario" name="nomeusuario">
				</div>
				
				<div class="form-group">
					<label for="senha">Senha</label>
					<input type="password" class="form-control" id="senha" name="senha">
				</div>
				
				<button type="button" onclick="processa();" class="btn btn-primary btn-block">Login</button>
			</form>
			
			<button type="button" class="btn btn-dark btn-block mt-3" onclick="location.href = 'cadastro.html';">Ainda não é usuário ?</button>
			
		</div>
		<div class="col-md-4">
		</div>
	</div>
	
	<div class="fixed-bottom">
		<?php include 'rodape1.html'; ?>
	</div>
	
</div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
  </body>
</html>