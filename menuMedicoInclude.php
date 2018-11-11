<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'menuMedico.php';">Minhas informações</button>

<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'consultasMedico.php';">Minhas consultas</button>
			
<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'examesMedico.php';">Meus exames</button>
			
<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'procedimentosMedico.php';">Meus procedimentos</button>
			
<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'pacientesMedico.php';">Meus pacientes</button>
			
<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'minhasAnamneses.php';">Minhas anamneses</button>
			
<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'minhasEvolucoes.php';">Minhas evoluções</button>
			
<?php
	date_default_timezone_set("America/Sao_Paulo"); 
			
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
			