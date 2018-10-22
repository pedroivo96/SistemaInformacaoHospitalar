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

    <title>Anamnese</title>

    <meta name="description" content="Source code generated using layoutit.com">
    <meta name="author" content="LayoutIt!">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
	<link href="css/bootstrap.css" rel="stylesheet">
	
	<script>
	
		function chamaForm1() {
			
			var form1  = document.getElementById('form1');
			
			if(form1.style.display == "none"){
				//Se o formulário não estiver à mostra, então mostrar ele
				form1.style.display = "block";
			}
			else{
				//Se o formulário estiver à mostra, então fazer ele sumir
				form1.style.display = "none";
			}
		}

		function chamaForm2() {
		
			var form2  = document.getElementById('form2');
			
			if(form2.style.display == "none"){
				//Se o formulário não estiver à mostra, então mostrar ele
				form2.style.display = "block";
			}
			else{
				//Se o formulário estiver à mostra, então fazer ele sumir
				form2.style.display = "none";
			}
		}
		
		function chamaForm3() {
		
			var form3  = document.getElementById('form3');
			
			if(form3.style.display == "none"){
				//Se o formulário não estiver à mostra, então mostrar ele
				form3.style.display = "block";
			}
			else{
				//Se o formulário estiver à mostra, então fazer ele sumir
				form3.style.display = "none";
			}
		}
		
		function chamaForm4() {
		
			var form4  = document.getElementById('form4');
			
			if(form4.style.display == "none"){
				//Se o formulário não estiver à mostra, então mostrar ele
				form4.style.display = "block";
			}
			else{
				//Se o formulário estiver à mostra, então fazer ele sumir
				form4.style.display = "none";
			}
		}
		
		function chamaForm5() {
		
			var form5  = document.getElementById('form5');
			
			if(form5.style.display == "none"){
				//Se o formulário não estiver à mostra, então mostrar ele
				form5.style.display = "block";
			}
			else{
				//Se o formulário estiver à mostra, então fazer ele sumir
				form5.style.display = "none";
			}
		}
		
	</script>

  </head>
  <body>

    <div class="container-fluid px-5">
	<div class="row mb-5 mt-5">
		<?php
			
			date_default_timezone_set("America/Fortaleza");
			
			$tipo = $_SESSION['tipo'];
			
			$conn = getConnection();
			
			$idinternacao = $_SESSION['idinternacao'];
			
			if($tipo == "Médico"){
				?>
				<h3>
					Menu do médico
					<small class="text-muted">Anamnese</small>
				</h3>
				<?php
			}
			else{
				?>
				<h3>
					Menu do enfermeiro
					<small class="text-muted">Anamnese</small>
				</h3>
				<?php
			}
			?>
	</div>
	<div class="row">
	
		<div class="col-md-8">
		
			<form>
			
				<h4 align="center">Identificação</h4>
			
				<div class="form-group">
					<label for="nome">Nome</label>
					<input type="text" class="form-control w-50" id="nome" name="nome">
					<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
				</div>
				
				<div class="form-group">
					<label for="nome">Idade</label>
					<input type="text" class="form-control w-50" id="nome" name="nome">
				</div>
				
				<div class="form-group">
					<label for="nome">RG</label>
					<input type="text" class="form-control w-50" id="nome" name="nome">
				</div>
				
				<div class="form-group">
					<label for="nome">Leito</label>
					<input type="text" class="form-control w-50" id="nome" name="nome">
				</div>
				
				<div class="form-group">
					<label for="nome">Profissão</label>
					<input type="text" class="form-control w-50" id="nome" name="nome">
				</div>
				
				<div class="form-group">
					<label for="nome">Estado civil</label>
					<input type="text" class="form-control w-50" id="nome" name="nome">
				</div>
				
				<div class="form-group">
					<label for="nome">Diagnóstico médico</label>
					<input type="text" class="form-control w-50" id="nome" name="nome">
				</div>
				
				
				<button type="submit" class="btn btn-primary">Submit</button>
				
			</form>
		
			<button type="button" class="btn btn-warning btn-block" id="botao1" onclick="chamaForm1();">Informações sobre a doença e o tratamento</button>
			
			<form id="form1" method="post" action="cadastrarInformacoesDoencaTratamento.php">
				<h4 align="center">Informações sobre a doença e o tratamento</h4>
				
				<input type="hidden" id="idanamnese" name="idanamnese" value="<?php echo $idinternacao; ?>">
			
				<div class="form-group">
					<label for="nome">Motivo da internação</label>
					<input type="text" class="form-control w-50" id="motivointernacao" name="motivointernacao">
				</div>
				
				<div class="form-group">
					<label for="nome">Doenças crônicas</label>
					<input type="text" class="form-control w-50" id="doencascronicas" name="doencascronicas">
				</div>
				
				<div class="form-group">
					<label for="nome">Tratamentos anteriores</label>
					<input type="text" class="form-control w-50" id="tratamentosanteriores" name="tratamentosanteriores">
				</div>
				
				
				<div class="form-group w-50 p-2 border">
					<label for="nome">Fatores de risco</label>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="fatoresrisco1" name="fatoresrisco1" value="Tabagismo">
						<label class="form-check-label" for="fatoresrisco1">Tabagismo</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="fatoresrisco2" name="fatoresrisco2" value="Etilismo">
						<label class="form-check-label" for="fatoresrisco2">Etilismo</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="fatoresrisco3" name="fatoresrisco3" value="Obesidade">
						<label class="form-check-label" for="fatoresrisco3">Obesidade</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="fatoresrisco4" name="fatoresrisco4" value="Perfil sanguíneo alterado">
						<label class="form-check-label" for="fatoresrisco4">Perfil sanguíneo alterado</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="fatoresrisco5" name="fatoresrisco5" value="Câncer">
						<label class="form-check-label" for="fatoresrisco5">Câncer</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="fatoresrisco6" name="fatoresrisco6" value="Uso de medicações antineoplásicas ou imunossupressoras">
						<label class="form-check-label" for="fatoresrisco6">Uso de medicações antineoplásicas ou imunossupressoras</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="fatoresrisco7" name="fatoresrisco7" value="Radioterapia">
						<label class="form-check-label" for="fatoresrisco7">Radioterapia</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="exampleCheck1">
						<label class="form-check-label" for="exampleCheck1">Outras</label>
						<input type="text" class="form-control" id="fatoresriscooutros" name="fatoresriscooutros">
					</div>
					
				</div>
				
				<div class="form-group">
					<label for="nome">Medicamentos em uso</label>
					<input type="text" class="form-control w-50" id="medicamentosuso" name="medicamentosuso">
				</div>
				
				<div class="form-group">
					<label for="nome">Antecedentes familiares</label>
					<input type="text" class="form-control w-50" id="antecedentesfamiliares" name="antecedentesfamiliares">
				</div>
				
				<button type="submit" class="btn btn-primary">Submit</button>
				
			</form>
		
			<button type="button" class="btn btn-warning btn-block" id="botao2" onclick="chamaForm2();">Hábitos</button>
			
			<form id="form2" method="post" action="cadastrarHabitos.php">
				<h4 align="center">Hábitos</h4>
				
				<input type="hidden" id="idanamnese" name="idanamnese" value="<?php echo $idinternacao; ?>">
			
				<div class="form-group w-50 p-2 border">
					<label for="nome">Condições de moradia</label>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="condicoesmoradia1" name="condicoesmoradia1" value="Área urbana">
						<label class="form-check-label" for="condicoesmoradia1">Área urbana</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="condicoesmoradia2" name="condicoesmoradia2" value="Rural">
						<label class="form-check-label" for="condicoesmoradia2">Rural</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="condicoesmoradia3" name="condicoesmoradia3" value="Casa">
						<label class="form-check-label" for="condicoesmoradia3">Casa</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="condicoesmoradia4" name="condicoesmoradia4" value="Apartamento">
						<label class="form-check-label" for="condicoesmoradia4">Apartamento</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="condicoesmoradia5" name="condicoesmoradia5" value="Com saneamento básico">
						<label class="form-check-label" for="condicoesmoradia5">Com saneamento básico</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="condicoesmoradia6" name="condicoesmoradia6" value="Sem saneamento básico">
						<label class="form-check-label" for="condicoesmoradia6">Sem saneamento básico</label>
					</div>
					
					<div class="form-group">
						<label for="nome">Outros</label>
						<input type="text" class="form-control" id="condicoesmoradiaoutros" name="condicoesmoradiaoutros">
					</div>
					
				</div>
				
				<div class="form-group w-50 p-2 border">
					<label for="nome">Cuidado corporal</label>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="cuidadocorporal1" name="cuidadocorporal1" value="Asseado">
						<label class="form-check-label" for="cuidadocorporal1">Asseado</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="cuidadocorporal2" name="cuidadocorporal2" value="Com roupas limpas">
						<label class="form-check-label" for="cuidadocorporal2">Com roupas limpas</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="cuidadocorporal3" name="cuidadocorporal3" value="Falta asseio corporal">
						<label class="form-check-label" for="cuidadocorporal3">Falta asseio corporal</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="cuidadocorporal4" name="cuidadocorporal4" value="Cabelo">
						<label class="form-check-label" for="cuidadocorporal4">Cabelo</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="cuidadocorporal5" name="cuidadocorporal5" value="Unhas">
						<label class="form-check-label" for="cuidadocorporal5">Unhas</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="cuidadocorporal6" name="cuidadocorporal6" value="Higiene bucal">
						<label class="form-check-label" for="cuidadocorporal6">Higiene bucal</label>
					</div>
					
				</div>
				
				<div class="form-group w-50 p-2 border">
					<label for="nome">Hábito de tomar banho no período</label>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="periodobanho1" name="periodobanho1" value="Manhã">
						<label class="form-check-label" for="periodobanho1">Manhã</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="periodobanho2" name="periodobanho2" value="Tarde">
						<label class="form-check-label" for="periodobanho2">Tarde</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="periodobanho3" name="periodobanho3" value="Noite">
						<label class="form-check-label" for="periodobanho3">Noite</label>
					</div>
					
				</div>
				
				<div class="form-group w-50 p-2 border">
					<label for="nome">Atividade física no trabalho</label>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="atividadetrabalho1" name="atividadetrabalho1" value="Em pé">
						<label class="form-check-label" for="exampleCheck1">Em pé</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="atividadetrabalho2" name="atividadetrabalho2" value="Sentado">
						<label class="form-check-label" for="exampleCheck1">Sentado</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="atividadetrabalho3" name="atividadetrabalho3" value="Aposentado">
						<label class="form-check-label" for="exampleCheck1">Aposentado</label>
					</div>
					
					<div class="form-group">
						<label for="atividadetrabalhooutros">Outros</label>
						<input type="text" class="form-control" id="atividadetrabalhooutros" name="atividadetrabalhooutros">
					</div>
					
				</div>
				
				<div class="form-group w-50 p-2 border">
					<label for="nome">Sono e repouso</label>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="sonorepouso1" name="sonorepouso1" value="Não tem insônia">
						<label class="form-check-label" for="sonorepouso1">Não tem insônia</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="sonorepouso2" name="sonorepouso2" value="Apresenta dificuldade de conciliar o sono">
						<label class="form-check-label" for="sonorepouso2">Apresenta dificuldade de conciliar o sono</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="sonorepouso3" name="sonorepouso3" value="Acorda várias vezes à noite">
						<label class="form-check-label" for="sonorepouso3">Acorda várias vezes à noite</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="sonorepouso4" name="sonorepouso4" value="Sonolência">
						<label class="form-check-label" for="sonorepouso4">Sonolência</label>
					</div>
					
					<div class="form-group">
						<label for="horasdormidas">Quantidade de horas dormidas por noite</label>
						<input type="text" class="form-control" id="horasdormidas" name="horasdormidas">
					</div>
					
					<div class="form-group">
						<label for="insoniauti">Não tem insônia em casa e acorda várias vezes à noite na UTI</label>
						<input type="text" class="form-control" id="insoniauti" name="insoniauti">
					</div>
					
				</div>

				<div class="form-group w-50 p-2 border">
					<label for="nome">Exercícios físicos programados</label>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="exerciciosprogramados1" name="exerciciosprogramados1" value="Exercícios aeróbicos">
						<label class="form-check-label" for="exerciciosprogramados1">Exercícios aeróbicos</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="exerciciosprogramados2" name="exerciciosprogramados2" value="Musculação">
						<label class="form-check-label" for="exerciciosprogramados2">Musculação</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="exerciciosprogramados3" name="exerciciosprogramados3" value="Natação">
						<label class="form-check-label" for="exerciciosprogramados3">Natação</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="exerciciosprogramados4" name="exerciciosprogramados4" value="Não faz exercício programado">
						<label class="form-check-label" for="exerciciosprogramados4">Não faz exercício programado</label>
					</div>
					
					<div class="form-group">
						<label for="vezesexercicios">Quantidade de vezes, por semana, que faz exercício</label>
						<input type="text" class="form-control" id="vezesexercicios" name="vezesexercicios">
					</div>
					
				</div>
				
				<div class="form-group w-50 p-2 border">
					<label for="nome">Recreação e lazer</label>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="recreacaolazer1" name="recreacaolazer1" value="Viagem">
						<label class="form-check-label" for="recreacaolazer1">Viagem</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="recreacaolazer2" name="recreacaolazer2" value="Cinema">
						<label class="form-check-label" for="recreacaolazer2">Cinema</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="recreacaolazer3" name="recreacaolazer3" value="TV">
						<label class="form-check-label" for="recreacaolazer3">TV</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="recreacaolazer4" name="recreacaolazer4" value="Leitura">
						<label class="form-check-label" for="recreacaolazer4">Leitura</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="recreacaolazer5" name="recreacaolazer5" value="Jogos esportivos">
						<label class="form-check-label" for="recreacaolazer5">Jogos esportivos</label>
					</div>
					
					<div class="form-group">
						<label for="recreacaolazeroutros">Outros</label>
						<input type="text" class="form-control" id="recreacaolazeroutros" name="recreacaolazeroutros">
					</div>
					
				</div>
				
				<div class="form-group w-50 p-2 border">
					<label for="nome">Costuma comer com frequência</label>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="comerfrequencia1" name="comerfrequencia1" value="Frutas, verduras cruas">
						<label class="form-check-label" for="exampleCheck1">Frutas, verduras cruas</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="comerfrequencia2" name="comerfrequencia2" value="Frutas, verduras cozidas">
						<label class="form-check-label" for="exampleCheck1">Frutas, verduras cozidas</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="comerfrequencia3" name="comerfrequencia3" value="Carne: vermelha">
						<label class="form-check-label" for="exampleCheck1">Carne: vermelha</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="comerfrequencia4" name="comerfrequencia4" value="Carne: frango">
						<label class="form-check-label" for="exampleCheck1">Carne: frango</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="comerfrequencia5" name="comerfrequencia5" value="Carne: peixe">
						<label class="form-check-label" for="exampleCheck1">Carne: peixe</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="comerfrequencia6" name="comerfrequencia6" value="Água">
						<label class="form-check-label" for="exampleCheck1">Água</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="comerfrequencia7" name="comerfrequencia7" value="Café">
						<label class="form-check-label" for="exampleCheck1">Café</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="comerfrequencia8" name="comerfrequencia8" value="Chá">
						<label class="form-check-label" for="exampleCheck1">Chá</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="comerfrequencia9" name="comerfrequencia9" value="Leite">
						<label class="form-check-label" for="exampleCheck1">Leite</label>
					</div>
					
					<div class="form-group">
						<label for="numerorefeicoes">Número de refeições diárias</label>
						<input type="text" class="form-control" id="numerorefeicoes" name="numerorefeicoes">
					</div>
					
					<div class="form-group">
						<label for="comerfrequenciaoutros">Outros</label>
						<input type="text" class="form-control" id="comerfrequenciaoutros" name="comerfrequenciaoutros">
					</div>
					
				</div>
				
				<div class="form-group w-50 p-2 border">
					<label for="nome">Eliminação urinária</label>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="eliminacaourinaria1" name="eliminacaourinaria1" value="Normal">
						<label class="form-check-label" for="eliminacaourinaria1">Normal</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="eliminacaourinaria2" name="eliminacaourinaria2" value="Menos de cinco vezes ao dia">
						<label class="form-check-label" for="eliminacaourinaria2">Menos de cinco vezes ao dia</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="eliminacaourinaria3" name="eliminacaourinaria3" value="Polaciúria">
						<label class="form-check-label" for="eliminacaourinaria3">Polaciúria</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="eliminacaourinaria4" name="eliminacaourinaria4" value="Nicturia">
						<label class="form-check-label" for="eliminacaourinaria4">Nicturia</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="eliminacaourinaria5" name="eliminacaourinaria5" value="Urgência miccional">
						<label class="form-check-label" for="eliminacaourinaria5">Urgência miccional</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="eliminacaourinaria6" name="eliminacaourinaria6" value="Incontinência urinária">
						<label class="form-check-label" for="eliminacaourinaria6">Incontinência urinária</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="eliminacaourinaria7" name="eliminacaourinaria7" value="Diminuição do jato urinário">
						<label class="form-check-label" for="eliminacaourinaria7">Diminuição do jato urinário</label>
					</div>
					
				</div>
				
				<div class="form-group w-50 p-2 border">
					<label for="nome">Eliminações intestinais</label>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="eliminacaointestinal1" name="eliminacaointestinal1" value="Normal">
						<label class="form-check-label" for="eliminacaointestinal1">Normal</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="eliminacaointestinal2" name="eliminacaointestinal2" value="Obstipação">
						<label class="form-check-label" for="eliminacaointestinal2">Obstipação</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="eliminacaointestinal3" name="eliminacaointestinal3" value="Diarreia">
						<label class="form-check-label" for="eliminacaointestinal3">Diarreia</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="eliminacaointestinal4" name="eliminacaointestinal4" value="Mudança de hábito intestinal">
						<label class="form-check-label" for="eliminacaointestinal4">Mudança de hábito intestinal</label>
					</div>
					
					<div class="form-group">
						<label for="eliminacaointestinalfrequencia">Frequência</label>
						<input type="text" class="form-control" id="eliminacaointestinalfrequencia" name="eliminacaointestinalfrequencia">
					</div>
					
				</div>
				
				<div class="form-group w-50 p-2 border">
					<label for="nome">Ciclo menstrual</label>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="ciclomenstrual1" name="ciclomenstrual1" value="Sem alterações">
						<label class="form-check-label" for="ciclomenstrual1">Sem alterações</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="ciclomenstrual2" name="ciclomenstrual2" value="Menopausa">
						<label class="form-check-label" for="ciclomenstrual2">Menopausa</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="ciclomenstrual3" name="ciclomenstrual3" value="Dismenorreia">
						<label class="form-check-label" for="ciclomenstrual3">Dismenorreia</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="ciclomenstrual4" name="ciclomenstrual4" value="Amenorreia disfuncional">
						<label class="form-check-label" for="ciclomenstrual4">Amenorreia disfuncional</label>
					</div>
					
					<div class="form-group">
						<label for="ciclomenstrualoutros">Outros</label>
						<input type="text" class="form-control" id="ciclomenstrualoutros" name="ciclomenstrualoutros">
					</div>
					
				</div>
				
				<div class="form-group w-50 p-2 border">
					<label for="nome">Atividade sexual</label>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="atividadesexual1" name="atividadesexual1" value="Desempenho satisfatório">
						<label class="form-check-label" for="atividadesexual1">Desempenho satisfatório</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="atividadesexual2" name="atividadesexual2" value="Não satisfatório">
						<label class="form-check-label" for="atividadesexual2">Não satisfatório</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="atividadesexual3" name="atividadesexual3" value="Não tem relacionamento sexual">
						<label class="form-check-label" for="atividadesexual3">Não tem relacionamento sexual</label>
					</div>
					
					<div class="form-group">
						<label for="atividadesexualoutros">Outros</label>
						<input type="text" class="form-control" id="atividadesexualoutros" name="atividadesexualoutros">
					</div>
					
				</div>
				
				<button type="submit" class="btn btn-primary">Submit</button>
				
			</form>
			
			
			<button type="button" class="btn btn-warning btn-block" id="botao3" onclick="chamaForm3();">Exame físico/Informações sobre órgãos e sistemas</button>
			
			<form id="form3" method="post" action="cadastrarExameOrgaosSistemas.php">
				<h4 align="center">Exame físico/ informações relevantes sobre órgãos e sistemas</h4>
				
				<input type="hidden" id="idanamnese" name="idanamnese" value="<?php echo $idinternacao; ?>">
			
				<div class="form-group w-50 p-2 border">
					<label for="nome"></label>
					
					<div class="form-group">
						<label for="pressao">Pressão arterial (em mmHg)</label>
						<input type="text" class="form-control" id="pressao" name="pressao">
					</div>
					
					<div class="form-group">
						<label for="pulso">Pulso (em batimentos/minuto)</label>
						<input type="text" class="form-control" id="pulso" name="pulso">
					</div>
					
					<div class="form-group">
						<label for="frequenciacardiaca">Frequência cardíaca (em batimentos/minuto)</label>
						<input type="text" class="form-control" id="frequenciacardiaca" name="frequenciacardiaca">
					</div>
					
					<div class="form-group">
						<label for="temperatura">Temperatura (em °C)</label>
						<input type="text" class="form-control" id="temperatura" name="temperatura">
					</div>
					
					<div class="form-group">
						<label for="frequenciarespiratoria">Frequência respiratória (em movimentos/minuto)</label>
						<input type="text" class="form-control" id="frequenciarespiratoria" name="frequenciarespiratoria">
					</div>
					
					<div class="form-group">
						<label for="peso">Peso (em kg)</label>
						<input type="text" class="form-control" id="peso" name="peso">
					</div>
					
					<div class="form-group">
						<label for="altura">Altura (em cm)</label>
						<input type="text" class="form-control" id="altura" name="altura">
					</div>
					
				</div>
				
				<div class="form-group w-50 p-2 border">
					<label for="nome">Estado nutricional</label>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="nutricao1" name="nutricao1" value="Normal">
						<label class="form-check-label" for="nutricao1">Normal</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="nutricao2" name="nutricao2" value="Obeso">
						<label class="form-check-label" for="nutricao2">Obeso</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="nutricao3" name="nutricao3" value="Desnutrido">
						<label class="form-check-label" for="nutricao3">Desnutrido</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="nutricao4" name="nutricao4" value="Relato de perda ponderal">
						<label class="form-check-label" for="nutricao4">Relato de perda ponderal</label>
					</div>
					
					<div class="form-group">
						<label for="nutricaooutros">Outros</label>
						<input type="text" class="form-control" id="nutricaooutros" name="nutricaooutros">
					</div>
					
				</div>
				
				<div class="form-group w-50 p-2 border">
					<label for="nome">Nível de consciência</label>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="consciencia1" name="consciencia1" value="Acordado">
						<label class="form-check-label" for="consciencia1">Acordado</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="consciencia2" name="consciencia2" value="Lúcido">
						<label class="form-check-label" for="consciencia2">Lúcido</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="consciencia3" name="consciencia3" value="Comatoso">
						<label class="form-check-label" for="consciencia3">Comatoso</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="consciencia4" name="consciencia4" value="Torporoso">
						<label class="form-check-label" for="consciencia4">Torporoso</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="consciencia5" name="consciencia5" value="Confuso">
						<label class="form-check-label" for="consciencia5">Confuso</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="consciencia6" name="consciencia6" value="Desorientado">
						<label class="form-check-label" for="consciencia6">Desorientado</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="consciencia7" name="consciencia7" value="Com falhas de memória">
						<label class="form-check-label" for="consciencia7">Com falhas de memória</label>
					</div>
					
					<div class="form-group">
						<label for="conscienciaoutros">Outros</label>
						<input type="text" class="form-control" id="conscienciaoutros" name="conscienciaoutros">
					</div>
					
				</div>
				
				<div class="form-group w-50 p-2 border">
					<label for="nome">Movimentação</label>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="movimentacao1" name="movimentacao1" value="Deambula">
						<label class="form-check-label" for="movimentacao1">Deambula</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="movimentacao2" name="movimentacao2" value="Acamado">
						<label class="form-check-label" for="movimentacao2">Acamado</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="movimentacao3" name="movimentacao3" value="Restrito ao leito">
						<label class="form-check-label" for="movimentacao3">Restrito ao leito</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="movimentacao4" name="movimentacao4" value="Sem movimentação">
						<label class="form-check-label" for="movimentacao4">Sem movimentação</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="movimentacao5" name="movimentacao5" value="Semiacamado">
						<label class="form-check-label" for="movimentacao5">Semiacamado</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="movimentacao6" name="movimentacao6" value="Deambula com ajuda">
						<label class="form-check-label" for="movimentacao6">Deambula com ajuda</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="movimentacao7" name="movimentacao7" value="Movimenta-se com ajuda">
						<label class="form-check-label" for="movimentacao7">Movimenta-se com ajuda</label>
					</div>
					
					<div class="form-group">
						<label for="movimentacaooutros">Outros</label>
						<input type="text" class="form-control" id="movimentacaooutros" name="movimentacaooutros">
					</div>
					
				</div>
				
				<div class="form-group w-50 p-2 border">
					<label for="nome">Pele/tecidos</label>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="peletecidos1" name="peletecidos1" value="Sem alterações">
						<label class="form-check-label" for="peletecidos1">Sem alterações</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="peletecidos2" name="peletecidos2" value="Anasarca">
						<label class="form-check-label" for="peletecidos2">Anasarca</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="peletecidos3" name="peletecidos3" value="Cianose">
						<label class="form-check-label" for="peletecidos3">Cianose</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="peletecidos4" name="peletecidos4" value="Icterícia">
						<label class="form-check-label" for="peletecidos4">Icterícia</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="peletecidos5" name="peletecidos5" value="Descorado">
						<label class="form-check-label" for="peletecidos5">Descorado</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="peletecidos6" name="peletecidos6" value="Reações alérgicas">
						<label class="form-check-label" for="peletecidos6">Reações alérgicas</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="peletecidos7" name="peletecidos7" value="Lesões de pele">
						<label class="form-check-label" for="peletecidos7">Lesões de pele</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="peletecidos8" name="peletecidos8" value="Escaras">
						<label class="form-check-label" for="peletecidos8">Escaras</label>
					</div>
					
					<div class="form-group">
						<label for="peletecidosoutros">Outros</label>
						<input type="text" class="form-control" id="peletecidosoutros" name="peletecidosoutros">
					</div>
					
				</div>

				<div class="form-group w-50 p-2 border">
					<label for="nome">Crânio</label>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="cranio1" name="cranio1" value="Sem anormalidades">
						<label class="form-check-label" for="cranio1">Sem anormalidades</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="cranio2" name="cranio2" value="Incisão">
						<label class="form-check-label" for="cranio2">Incisão</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="cranio3" name="cranio3" value="Drenos">
						<label class="form-check-label" for="cranio3">Drenos</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="cranio4" name="cranio4" value="Cefaleia">
						<label class="form-check-label" for="cranio4">Cefaleia</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="cranio5" name="cranio5" value="Lesões no couro cabeludo">
						<label class="form-check-label" for="cranio5">Lesões no couro cabeludo</label>
					</div>
					
					<div class="form-group">
						<label for="craniooutros">Outros</label>
						<input type="text" class="form-control" id="craniooutros" name="craniooutros">
					</div>
					
				</div>
				
				<div class="form-group w-50 p-2 border">
					<label for="nome">Olhos</label>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="olhos1" name="olhos1" value="Visão normal">
						<label class="form-check-label" for="olhos1">Visão normal</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="olhos2" name="olhos2" value="Diminuição da acuidade visual">
						<label class="form-check-label" for="olhos2">Diminuição da acuidade visual</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="olhos3" name="olhos3" value="Presença de processos inflamatórios/infecciosos">
						<label class="form-check-label" for="olhos3">Presença de processos inflamatórios/infecciosos</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="olhos4" name="olhos4" value="Uso de lentes de contato ou óculos">
						<label class="form-check-label" for="olhos4">Uso de lentes de contato ou óculos</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="olhos5" name="olhos5" value="Exoftalmia">
						<label class="form-check-label" for="olhos5">Exoftalmia</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="olhos6" name="olhos6" value="Pupilas fotorreativas">
						<label class="form-check-label" for="olhos6">Pupilas fotorreativas</label>
					</div>
					
					<div class="form-group">
						<label for="olhosoutros">Outros</label>
						<input type="text" class="form-control" id="olhosoutros" name="olhosoutros">
					</div>
					
				</div>
				
				<div class="form-group w-50 p-2 border">
					<label for="nome">Ouvido</label>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="ouvidos1" name="ouvidos1" value="Audição normal">
						<label class="form-check-label" for="ouvidos1">Audição normal</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="ouvidos2" name="ouvidos2" value="Acuidade diminuída">
						<label class="form-check-label" for="ouvidos2">Acuidade diminuída</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="ouvidos3" name="ouvidos3" value="Zumbido">
						<label class="form-check-label" for="ouvidos3">Zumbido</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="ouvidos4" name="ouvidos4" value="Presença de processo inflamatório/infeccioso">
						<label class="form-check-label" for="ouvidos4">Presença de processo inflamatório/infeccioso</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="ouvidos5" name="ouvidos5" value="Uso de prótese auditiva">
						<label class="form-check-label" for="ouvidos5">Uso de prótese auditiva</label>
					</div>
					
					<div class="form-group">
						<label for="ouvidosoutros">Outros</label>
						<input type="text" class="form-control" id="ouvidosoutros" name="ouvidosoutros">
					</div>
					
				</div>
				
				<div class="form-group w-50 p-2 border">
					<label for="nome">Nariz</label>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="nariz1" name="nariz1" value="Sem anormalidades">
						<label class="form-check-label" for="nariz1">Sem anormalidades</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="nariz2" name="nariz2" value="Coriza">
						<label class="form-check-label" for="nariz2">Coriza</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="nariz3" name="nariz3" value="Alergia">
						<label class="form-check-label" for="nariz3">Alergia</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="nariz4" name="nariz4" value="Epistaxe">
						<label class="form-check-label" for="nariz4">Epistaxe</label>
					</div>
					
					<div class="form-group">
						<label for="narizoutros">Outros</label>
						<input type="text" class="form-control" id="narizoutros" name="narizoutros">
					</div>
					
				</div>
				
				<div class="form-group w-50 p-2 border">
					<label for="nome">Boca</label>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="boca1" name="boca1" value="Sem anormalidades">
						<label class="form-check-label" for="boca1">Sem anormalidades</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="boca2" name="boca2" value="Cáries">
						<label class="form-check-label" for="boca2">Cáries</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="boca3" name="boca3" value="Falhas dentárias">
						<label class="form-check-label" for="boca3">Falhas dentárias</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="boca4" name="boca4" value="Gengivite">
						<label class="form-check-label" for="boca4">Gengivite</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="boca5" name="boca5" value="Prótese">
						<label class="form-check-label" for="boca5">Prótese</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="boca6" name="boca6" value="Outras lesões">
						<label class="form-check-label" for="boca6">Outras lesões</label>
					</div>
					
					<div class="form-group">
						<label for="bocaoutros">Outros</label>
						<input type="text" class="form-control" id="bocaoutros" name="bocaoutros">
					</div>
					
				</div>
				
				<div class="form-group w-50 p-2 border">
					<label for="nome">Pescoço</label>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="pescoco1" name="pescoco1" value="Sem anormalidades">
						<label class="form-check-label" for="pescoco1">Sem anormalidades</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="pescoco2" name="pescoco2" value="Linfonodos">
						<label class="form-check-label" for="pescoco2">Linfonodos</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="pescoco3" name="pescoco3" value="Tireoide aumentada">
						<label class="form-check-label" for="pescoco3">Tireoide aumentada</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="pescoco4" name="pescoco4" value="Estase venosa jugular">
						<label class="form-check-label" for="pescoco4">Estase venosa jugular</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="pescoco5" name="pescoco5" value="Traqueostomia">
						<label class="form-check-label" for="pescoco5">Traqueostomia</label>
					</div>
					
					<div class="form-group">
						<label for="pescocooutros">Outros</label>
						<input type="text" class="form-control" id="pescocooutros" name="pescocooutros">
					</div>
					
				</div>
				
				<div class="form-group w-50 p-2 border">
					<label for="nome">Tórax</label>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="torax1" name="torax1" value="Sem alteração anatômica">
						<label class="form-check-label" for="torax1">Sem alteração anatômica</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="torax2" name="torax2" value="Expansão torácica normal">
						<label class="form-check-label" for="torax2">Expansão torácica normal</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="torax3" name="torax3" value="Com alteração anatômica">
						<label class="form-check-label" for="torax3">Com alteração anatômica</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="torax4" name="torax4" value="Diminuição da expansão torácica">
						<label class="form-check-label" for="torax4">Diminuição da expansão torácica</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="torax5" name="torax5" value="Presença de frêmitos">
						<label class="form-check-label" for="torax5">Presença de frêmitos</label>
					</div>
					
					<div class="form-group">
						<label for="toraxoutros">Outros</label>
						<input type="text" class="form-control" id="toraxoutros" name="toraxoutros">
					</div>
					
				</div>
				
				<div class="form-group w-50 p-2 border">
					<label for="nome">Mamas</label>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="mamas1" name="mamas1" value="Sem alterações">
						<label class="form-check-label" for="mamas1">Sem alterações</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="mamas2" name="mamas2" value="Simétricas">
						<label class="form-check-label" for="mamas2">Simétricas</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="mamas3" name="mamas3" value="Presença de nódulos palpáveis">
						<label class="form-check-label" for="mamas3">Presença de nódulos palpáveis</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="mamas4" name="mamas4" value="Dor">
						<label class="form-check-label" for="mamas4">Dor</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="mamas5" name="mamas5" value="Secreções">
						<label class="form-check-label" for="mamas5">Secreções</label>
					</div>
					
					<div class="form-group">
						<label for="mamasoutros">Outros</label>
						<input type="text" class="form-control" id="mamasoutros" name="mamasoutros">
					</div>
					
				</div>
				
				<div class="form-group w-50 p-2 border">
					<label for="nome">Ausculta pulmonar</label>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="ausculta1" name="ausculta1" value="Normal">
						<label class="form-check-label" for="ausculta1">Normal</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="ausculta2" name="ausculta2" value="Murmúrios vesiculares diminuídos">
						<label class="form-check-label" for="ausculta2">Murmúrios vesiculares diminuídos</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="ausculta3" name="ausculta3" value="Roncos">
						<label class="form-check-label" for="ausculta3">Roncos</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="ausculta4" name="ausculta4" value="Estertores">
						<label class="form-check-label" for="ausculta4">Estertores</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="ausculta5" name="ausculta5" value="Sibilos">
						<label class="form-check-label" for="ausculta5">Sibilos</label>
					</div>
					
					<div class="form-group">
						<label for="auscultaoutros">Outros</label>
						<input type="text" class="form-control" id="auscultaoutros" name="auscultaoutros">
					</div>
					
				</div>
				
				<div class="form-group w-50 p-2 border">
					<label for="nome">Oxigenação</label>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="oxigenacao1" name="oxigenacao1" value="">
						<label class="form-check-label" for="oxigenacao1">Ar ambiente</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="oxigenacao2" name="oxigenacao2" value="">
						<label class="form-check-label" for="oxigenacao2">Oxigenoterapia</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="oxigenacao3" name="oxigenacao3" value="">
						<label class="form-check-label" for="oxigenacao3">Entubado</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="oxigenacao4" name="oxigenacao4" value="">
						<label class="form-check-label" for="oxigenacao4">Traqueostomizado</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="oxigenacao5" name="oxigenacao5" value="">
						<label class="form-check-label" for="oxigenacao5">Sem ventilação mecânica</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="oxigenacao6" name="oxigenacao6" value="">
						<label class="form-check-label" for="oxigenacao6">Com ventilação mecânica</label>
					</div>
					
					<div class="form-group">
						<label for="oxigenacaooutros">Outros</label>
						<input type="text" class="form-control" id="oxigenacaooutros" name="oxigenacaooutros">
					</div>
					
				</div>
				
				<div class="form-group w-50 p-2 border">
					<label for="nome">Coração</label>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="coracao1" name="coracao1" value="Ritmo normal">
						<label class="form-check-label" for="coracao1">Ritmo normal</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="coracao2" name="coracao2" value="Taquicardia">
						<label class="form-check-label" for="coracao2">Taquicardia</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="coracao3" name="coracao3" value="Bradicardia">
						<label class="form-check-label" for="coracao3">Bradicardia</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="coracao4" name="coracao4" value="Galope">
						<label class="form-check-label" for="coracao4">Galope</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="coracao5" name="coracao5" value="Presença de sopros">
						<label class="form-check-label" for="coracao5">Presença de sopros</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="coracao6" name="coracao6" value="Arritmia">
						<label class="form-check-label" for="coracao6">Arritmia</label>
					</div>
					
					<div class="form-group">
						<label for="coracaooutros">Outros</label>
						<input type="text" class="form-control" id="coracaooutros" name="coracaooutros">
					</div>
					
				</div>
				
				<div class="form-group w-50 p-2 border">
					<label for="nome">Precórdio</label>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="precordio1" name="precordio1" value="Sem alteração">
						<label class="form-check-label" for="precordio1">Sem alteração</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="precordio2" name="precordio2" value="Dor">
						<label class="form-check-label" for="precordio2">Dor</label>
					</div>
					
					<div class="form-group">
						<label for="precordiooutros">Outros</label>
						<input type="text" class="form-control" id="precordiooutros" name="precordiooutros">
					</div>
					
				</div>
				
				<div class="form-group w-50 p-2 border">
					<label for="nome">Abdome</label>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="abdome1" name="abdome1" value="Indolor">
						<label class="form-check-label" for="abdome1">Indolor</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="abdome2" name="abdome2" value="Plano">
						<label class="form-check-label" for="abdome2">Plano</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="abdome3" name="abdome3" value="Plano">
						<label class="form-check-label" for="abdome3">Plano</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="abdome4" name="abdome4" value="Globoso">
						<label class="form-check-label" for="abdome4">Globoso</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="abdome5" name="abdome5" value="Flácido à palpação">
						<label class="form-check-label" for="abdome5">Flácido à palpação</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="abdome6" name="abdome6" value="Resistente à palpação">
						<label class="form-check-label" for="abdome6">Resistente à palpação</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="abdome7" name="abdome7" value="Com presença de ruídos hidroaéreos">
						<label class="form-check-label" for="abdome7">Com presença de ruídos hidroaéreos</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="abdome8" name="abdome8" value="Ausência de ruídos hidroaéreos">
						<label class="form-check-label" for="abdome8">Ausência de ruídos hidroaéreos</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="abdome9" name="abdome9" value="Presença de dor">
						<label class="form-check-label" for="abdome9">Presença de dor</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="abdome10" name="abdome10" value="Incisão cirúrgica">
						<label class="form-check-label" for="abdome10">Incisão cirúrgica</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="abdome11" name="abdome11" value="Colostomia">
						<label class="form-check-label" for="abdome11">Colostomia</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="abdome12" name="abdome12" value="Hepato/Esplenomegalia">
						<label class="form-check-label" for="abdome12">Hepato/Esplenomegalia</label>
					</div>
					
					<div class="form-group">
						<label for="abdomeoutros">Outros</label>
						<input type="text" class="form-control" id="abdomeoutros" name="abdomeoutros">
					</div>
					
				</div>
				
				<div class="form-group w-50 p-2 border">
					<label for="nome">Geniturinário</label>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="geniturinario1" name="geniturinario1" value="Sem alterações anatômicas">
						<label class="form-check-label" for="geniturinario1">Sem alterações anatômicas</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="geniturinario2" name="geniturinario2" value="Micção espontânea">
						<label class="form-check-label" for="geniturinario2">Micção espontânea</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="geniturinario3" name="geniturinario3" value="Presença de anomalias">
						<label class="form-check-label" for="geniturinario3">Presença de anomalias</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="geniturinario4" name="geniturinario4" value="Sonda vesical de demora">
						<label class="form-check-label" for="geniturinario4">Sonda vesical de demora</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="geniturinario5" name="geniturinario5" value="Irrigação vesical">
						<label class="form-check-label" for="geniturinario5">Irrigação vesical</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="geniturinario6" name="geniturinario6" value="Lesões nos órgãos genitais">
						<label class="form-check-label" for="geniturinario6">Lesões nos órgãos genitais</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="geniturinario7" name="geniturinario7" value="Incontinência urinária">
						<label class="form-check-label" for="geniturinario7">Incontinência urinária</label>
					</div>
					
					<div class="form-group">
						<label for="geniturinariooutros">Outros</label>
						<input type="text" class="form-control" id="geniturinariooutros" name="geniturinariooutros">
					</div>
					
				</div>
				
				<div class="form-group w-50 p-2 border">
					<label for="nome">Membros superiores</label>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="membrossuperiores1" name="membrossuperiores1" value="Sensibilidade e força motora preservadas em todas as extremidades">
						<label class="form-check-label" for="membrossuperiores1">Sensibilidade e força motora preservadas em todas as extremidades</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="membrossuperiores2" name="membrossuperiores2" value="Pulsos periféricos palpáveis">
						<label class="form-check-label" for="membrossuperiores2">Pulsos periféricos palpáveis</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="membrossuperiores3" name="membrossuperiores3" value="Paresia">
						<label class="form-check-label" for="membrossuperiores3">Paresia</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="membrossuperiores4" name="membrossuperiores4" value="Plegia">
						<label class="form-check-label" for="membrossuperiores4">Plegia</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="membrossuperiores5" name="membrossuperiores5" value="Edema">
						<label class="form-check-label" for="membrossuperiores5">Edema</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="membrossuperiores6" name="membrossuperiores6" value="Amputações">
						<label class="form-check-label" for="membrossuperiores6">Amputações</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="membrossuperiores7" name="membrossuperiores7" value="Gesso">
						<label class="form-check-label" for="membrossuperiores7">Gesso</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="membrossuperiores8" name="membrossuperiores8" value="Tala gessada">
						<label class="form-check-label" for="membrossuperiores8">Tala gessada</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="membrossuperiores9" name="membrossuperiores9" value="Dispositivo venoso">
						<label class="form-check-label" for="membrossuperiores9">Dispositivo venoso</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="membrossuperiores10" name="membrossuperiores10" value="Lesões">
						<label class="form-check-label" for="membrossuperiores10">Lesões</label>
					</div>
					
					<div class="form-group">
						<label for="membrossuperioresoutros">Anotações</label>
						<input type="text" class="form-control" id="membrossuperioresoutros" name="membrossuperioresoutros">
					</div>
					
				</div>
				
				<div class="form-group w-50 p-2 border">
					<label for="nome">Membros inferiores</label>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="membrosinferiores1" name="membrosinferiores1" value="">
						<label class="form-check-label" for="membrosinferiores1">Sensibilidade e força motora preservadas em todas as extremidades</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="membrosinferiores2" name="membrosinferiores2" value="">
						<label class="form-check-label" for="membrosinferiores2">Pulsos periféricos palpáveis</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="membrosinferiores3" name="membrosinferiores3" value="">
						<label class="form-check-label" for="membrosinferiores3">Paresia</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="membrosinferiores4" name="membrosinferiores4" value="">
						<label class="form-check-label" for="membrosinferiores4">Plegia</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="membrosinferiores5" name="membrosinferiores5" value="">
						<label class="form-check-label" for="membrosinferiores5">Edema</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="membrosinferiores6" name="membrosinferiores6" value="">
						<label class="form-check-label" for="membrosinferiores6">Amputações</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="membrosinferiores7" name="membrosinferiores7" value="">
						<label class="form-check-label" for="membrosinferiores7">Gesso</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="membrosinferiores8" name="membrosinferiores8" value="">
						<label class="form-check-label" for="membrosinferiores8">Tala gessada</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="membrosinferiores9" name="membrosinferiores9" value="">
						<label class="form-check-label" for="membrosinferiores9">Dispositivo venoso</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="membrosinferiores10" name="membrosinferiores10" value="">
						<label class="form-check-label" for="membrosinferiores10">Lesões</label>
					</div>
					
					<div class="form-group">
						<label for="membrosinferioresoutros">Outros</label>
						<input type="text" class="form-control" id="membrosinferioresoutros" name="membrosinferioresoutros">
					</div>
					
				</div>
				
				<div class="form-group w-50 p-2 border">
					
					<div class="form-group">
						<label for="nome">Medicamentos que utiliza em casa</label>
						<textarea class="form-control" rows="5" id="medicamentoscasa" name="medicamentoscasa"></textarea>
					</div>
					
					<div class="form-group">
						<label for="nome">Exames de laboratório, diagnóstico por imagem e outros</label>
						<textarea class="form-control" rows="5" id="exames" name="exames"></textarea>
					</div>
					
					<div class="form-group">
						<label for="nome">Outras queixas(não mencionadas no exame físico)</label>
						<textarea class="form-control" rows="5" id="outrasqueixas" name="outrasqueixas"></textarea>
					</div>
					
				</div>
				
				<button type="submit" class="btn btn-primary">Submit</button>
				
			</form>
			
			
			<button type="button" class="btn btn-warning btn-block" id="botao4" onclick="chamaForm4();">Psicossocial</button>
			
			<form id="form4" method="post" action="cadastrarPsicossocial.php">
				<h4 align="center">Psicossocial</h4>
				
				<input type="hidden" id="idanamnese" name="idanamnese" value="<?php echo $idinternacao; ?>">
				
				<div class="form-group w-50 p-2 border">
					<label for="nome">Interação social</label>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="interacaosocial1" name="interacaosocial1" value="Normal">
						<label class="form-check-label" for="interacaosocial1">Normal</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="interacaosocial2" name="interacaosocial2" value="Não faz amizades com facilidade">
						<label class="form-check-label" for="interacaosocial2">Não faz amizades com facilidade</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="interacaosocial3" name="interacaosocial3" value="Prefere ficar sozinho">
						<label class="form-check-label" for="interacaosocial3">Prefere ficar sozinho</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="interacaosocial4" name="interacaosocial4" value="Não se adapta com facilidade a lugares ou situações novas">
						<label class="form-check-label" for="interacaosocial4">Não se adapta com facilidade a lugares ou situações novas</label>
					</div>
					
				</div>
				
				<div class="form-group w-50 p-2 border">
					<label for="nome">Resolução de problemas</label>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="resolucaoproblemas1" name="resolucaoproblemas1" value="Toma decisões rapidamente">
						<label class="form-check-label" for="resolucaoproblemas1">Toma decisões rapidamente</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="resolucaoproblemas2" name="resolucaoproblemas2" value="Demora para tomar decisões">
						<label class="form-check-label" for="resolucaoproblemas2">Demora para tomar decisões</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="resolucaoproblemas3" name="resolucaoproblemas3" value="Costuma pedir ajuda para familiares e amigos">
						<label class="form-check-label" for="resolucaoproblemas3">Costuma pedir ajuda para familiares e amigos</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="resolucaoproblemas4" name="resolucaoproblemas4" value="Não consegue tomar decisões">
						<label class="form-check-label" for="resolucaoproblemas4">Não consegue tomar decisões</label>
					</div>
					
				</div>
				
				<div class="form-group w-50 p-2 border">
					<label for="nome">Apoio espiritual</label>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="apoioespiritual1" name="apoioespiritual1" value="Possui crença religiosa">
						<label class="form-check-label" for="apoioespiritual1">Possui crença religiosa</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="apoioespiritual2" name="apoioespiritual2" value="Procura apoio em sua fé nos momentos difíceis">
						<label class="form-check-label" for="apoioespiritual2">Procura apoio em sua fé nos momentos difíceis</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="apoioespiritual3" name="apoioespiritual3" value="Anda meio descrente ultimamente">
						<label class="form-check-label" for="apoioespiritual3">Anda meio descrente ultimamente</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="apoioespiritual4" name="apoioespiritual4" value="Não possui crença religiosa">
						<label class="form-check-label" for="apoioespiritual4">Não possui crença religiosa</label>
					</div>
					
				</div>
				
				<div class="form-group w-50 p-2 border">
					<label for="nome">Suporte financeiro</label>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="suportefinanceiro1" name="suportefinanceiro1" value="Possui recursos para tratamento médico">
						<label class="form-check-label" for="suportefinanceiro1">Possui recursos para tratamento médico</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="suportefinanceiro2" name="suportefinanceiro2" value="Possui conveniência/seguro de saúde">
						<label class="form-check-label" for="suportefinanceiro2">Possui conveniência/seguro de saúde</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="suportefinanceiro3" name="suportefinanceiro3" value="Conta com a ajuda de familiares">
						<label class="form-check-label" for="suportefinanceiro3">Conta com a ajuda de familiares</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="suportefinanceiro4" name="suportefinanceiro4" value="Utiliza exclusivamente hospitais conveniados do SUS">
						<label class="form-check-label" for="suportefinanceiro4">Utiliza exclusivamente hospitais conveniados do SUS</label>
					</div>
					
					<div class="form-group">
						<label for="suportefinanceirooutros">Outros</label>
						<input type="text" class="form-control" id="suportefinanceirooutros" name="suportefinanceirooutros">
					</div>
					
				</div>

				<div class="form-group w-50 p-2 border">
					<label for="nome">Conhecimento sobre seu problema de saúde</label>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="conhecimentoproblema1" name="conhecimentoproblema1" value="Orientado">
						<label class="form-check-label" for="conhecimentoproblema1">Orientado</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="conhecimentoproblema2" name="conhecimentoproblema2" value="Pouco orientado">
						<label class="form-check-label" for="conhecimentoproblema2">Pouco orientado</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="conhecimentoproblema3" name="conhecimentoproblema3" value="Prefere não falar no assunto">
						<label class="form-check-label" for="conhecimentoproblema3">Prefere não falar no assunto</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="conhecimentoproblema4" name="conhecimentoproblema4" value="Prefere que os familiares sejam orientados">
						<label class="form-check-label" for="conhecimentoproblema4">Prefere que os familiares sejam orientados</label>
					</div>
					
					<div class="form-group">
						<label for="conhecimentoproblemaoutros">Outros</label>
						<input type="text" class="form-control" id="conhecimentoproblemaoutros" name="conhecimentoproblemaoutros">
					</div>
					
				</div>
				
				<div class="form-group w-50 p-2 border">
					<label for="nome">Condições que o paciente apresenta para o seu autocuidado</label>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="condicoesautocuidado1" name="condicoesautocuidado1" value="Independente">
						<label class="form-check-label" for="condicoesautocuidado1">Independente</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="condicoesautocuidado2" name="condicoesautocuidado2" value="Precisa de ajuda para poucas atividades">
						<label class="form-check-label" for="condicoesautocuidado2">Precisa de ajuda para poucas atividades</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="condicoesautocuidado3" name="condicoesautocuidado3" value="Precisa de ajuda para muitas atividades">
						<label class="form-check-label" for="condicoesautocuidado3">Precisa de ajuda para muitas atividades</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="condicoesautocuidado4" name="condicoesautocuidado4" value="É totalmente dependente">
						<label class="form-check-label" for="condicoesautocuidado4">É totalmente dependente</label>
					</div>
					
					<div class="form-group">
						<label for="condicoesautocuidadooutros">Outros</label>
						<input type="text" class="form-control" id="condicoesautocuidadooutros" name="condicoesautocuidadooutros">
					</div>
					
				</div>
				
				<div class="form-group w-50 p-2 border">
					<label for="nome">Mudança percebida no humor ou nos sentimentos após ter tomado conhecimento do seu problema de saúde</label>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="mudancahumor1" name="mudancahumor1" value="Está otimista com o tratamento">
						<label class="form-check-label" for="mudancahumor1">Está otimista com o tratamento</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="mudancahumor2" name="mudancahumor2" value="Refere estar desanimado">
						<label class="form-check-label" for="mudancahumor2">Refere estar desanimado</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="mudancahumor3" name="mudancahumor3" value="Não aceita o problema">
						<label class="form-check-label" for="mudancahumor3">Não aceita o problema</label>
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="mudancahumor4" name="mudancahumor4" value="Nega o problema">
						<label class="form-check-label" for="mudancahumor4">Nega o problema</label>
					</div>
					
					<div class="form-group">
						<label for="mudancahumoroutros">Outros</label>
						<input type="text" class="form-control" id="mudancahumoroutros" name="mudancahumoroutros">
					</div>
					
				</div>
				
				<button type="submit" class="btn btn-primary">Submit</button>
				
			</form>
			
			
			<button type="button" class="btn btn-warning btn-block" id="botao5" onclick="chamaForm5();">Dados especificados de cada área</button>
			
			<form id="form5" method="post" action="cadastrarDadosEspecificados.php">
				<h4 align="center">Dados específicos de cada área</h4>
				
				<input type="hidden" id="idanamnese" name="idanamnese" value="<?php echo $idinternacao; ?>">
				
				<div class="form-group w-50 p-2 border">
					
					<div class="form-group">
						<label for="anotacoes">Anotações</label>
						<textarea class="form-control" rows="5" id="anotacoes" name="anotacoes"></textarea>
					</div>
					
					<div class="form-group">
						<label for="impressoes">Impressões do(a) entrevistador(a)</label>
						<textarea class="form-control" rows="5" id="impressoes" name="impressoes"></textarea>
					</div>
					
					<?php
						$cpfprofissional = $_SESSION["cpf"];
						
						$sql = 'SELECT * FROM profissionais WHERE cpf = :cpf';
						$stmt = $conn->prepare($sql);
						$stmt->bindValue(':cpf', $cpfprofissional);
						$stmt->execute();
						$count = $stmt->rowCount();
			
						if($count > 0){
							$result = $stmt->fetchAll();
			
							foreach($result as $row){
								$nomeprofissional = $row['nomecompleto'];
								$registro         = $row['registro'];
								?>
								<div class="form-group">
									<label for="nomeprofissional">Nome do profissional</label>
									<input type="text" class="form-control" value="<?php echo $nomeprofissional; ?>" readonly>
								</div>
								
								<input type="hidden" id="cpfprofissional" name="cpfprofissional" value="<?php echo $cpfprofissional; ?>">
								
								<div class="form-group">
									<label for="registro">Número de registro</label>
									<input type="text" class="form-control" value="<?php echo $registro; ?>" readonly>
								</div>
								
								<input type="hidden" id="registro" name="registro" value="<?php echo $registro; ?>">
								<?php	
							}
						}
					?>
					
					<?php
						$diahorarioatual = time();
						
						$diahorarioformatado = date("d/m/Y às H:i", $diahorarioatual);
						?>
						<div class="form-group">
							<label for="data">Data e horário</label>
							<input type="text" class="form-control" value="<?php echo $diahorarioformatado; ?>"readonly>
						</div>
						
						<input type="hidden" id="data" name="data" value="<?php echo $diahorarioatual; ?>">
						<?php
					?>
					
				</div>
				
				<button type="submit" class="btn btn-primary">Submit</button>
				
			</form>
			
			
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
							
						$sql1 = 'SELECT * FROM profissionaisplantao WHERE cpfprofissional = :cpfprofissional';
						$stmt1 = $conn->prepare($sql1);
						$stmt1->bindValue(':cpfprofissional', $cpfprofissional);
						$stmt1->execute();
						$count1 = $stmt1->rowCount();
		
						if($count1 > 0){
							$result1 = $stmt1->fetchAll();
			
							foreach($result1 as $row1){
							
								$idplantao = $row1['idplantao'];
								$chefe = $row1['chefe'];
						
								$chefe = 1;
						
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

	<script src="js/popper.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
  </body>
</html>