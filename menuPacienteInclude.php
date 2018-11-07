<?php
			
	$conn = getConnection();
				
	$cpfpaciente = $_SESSION['cpf'];
		
	$sql = 'SELECT * FROM internacoes WHERE cpfpaciente = :cpfpaciente';
	$stmt = $conn->prepare($sql);
	$stmt->bindValue(':cpfpaciente', $cpfpaciente);
	$stmt->execute();
	$count = $stmt->rowCount();
		
	if($count > 0){
		?>
		<div class="alert alert-primary w-100 text-center" role="alert">
			Você está internado!
		</div>
		<?php
	}
	else{
		?>
		<button type="button" class="btn btn-success btn-lg btn-block" onclick="location.href = 'buscarMedico.html';">Nova consulta</button>
		<?php
	}
			
?>

<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'menuPaciente.php';">Minhas informações</button>
			
<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'consultasPaciente.php';">Minhas consultas</button>
			
<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'examesPaciente.php';">Meus exames</button>
			
<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'procedimentosPaciente.php';">Meus procedimentos</button>
			
<form class="btn btn-primary btn-block" method="POST" action="gerarProntuario.php" class="btn btn-primary">
	<input type="hidden" id="cpfpaciente" name="cpfpaciente" value="<?php echo $_SESSION['cpf']; ?>">
					
	<button class="btn btn-primary btn-block" type="submit">
		Gerar PDF do Prontuário
	</button> 
</form>
				
<button type="button" class="btn btn-danger btn-lg btn-block" onclick="location.href = 'sair.php';">Sair</button>