<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'menuEnfermeiro.php';">
	Minhas informações
</button>

<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'minhasEvolucoes.php';">
	Minhas evoluções e anotações
</button>
			
<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'diagnosticoEnfermeiro.php';">
	Meus diagnósticos
</button>
			
<button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'minhasAnamneses.php';">
	Minhas anamneses
</button>

<?php
	$cpfprofissional = $_SESSION['cpf'];
				
	date_default_timezone_set("America/Fortaleza");
							
	$conn = getConnection();
				
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
			$stmt1->bindValue(':idplantao'      , $idplantao);
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
			
<button type="button" class="btn btn-danger btn-lg btn-block" onclick="location.href = 'sair.php';">
	Sair
</button>