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
		<button type="button" class="btn btn-success btn-lg btn-block" onclick="location.href = 'buscarMedico.php';">Nova consulta</button>
		<?php
	}
			
?>

<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'menuPaciente.php';">
	Minhas informações
</button>

<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'buscarMedico.php';">
	Buscar médico
</button>
			
<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'consultasPaciente.php';">
	Minhas consultas
</button>
			
<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'examesPaciente.php';">
	Meus exames
</button>
			
<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'procedimentosPaciente.php';">
	Meus procedimentos
</button>

<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'gerarProntuario.php';">
	Gerar PDF do Prontuário
</button>
				
<button type="button" class="btn btn-danger btn-lg btn-block" onclick="location.href = 'sair.php';">Sair</button>