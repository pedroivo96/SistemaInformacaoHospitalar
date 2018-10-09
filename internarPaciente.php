<?php
	include './conexao.php';
	
	date_default_timezone_set("America/Fortaleza"); 
				
	$cpfpaciente = $_POST['cpfpaciente'];
	$cpfmedico   = $_POST['cpfmedico'];
	$idsetor     = $_POST['idsetor'];
	$status      = "Livre";
					
	$conn = getConnection();
					
	$sql = 'SELECT * FROM leitos WHERE status = :status AND idsetor = :idsetor LIMIT 1';
					
	$stmt = $conn->prepare($sql);
	$stmt->bindValue(':status' , $status);
	$stmt->bindValue(':idsetor', $idsetor);
	$stmt->execute();
	$count = $stmt->rowCount();
		
	if($count > 0){
		$result = $stmt->fetchAll();
			
		foreach($result as $row){
			$idleito = $row['id'];
			
			$statusleito      = "Ocupado";
			$statusinternacao = "Realizada";
			
			$sql1 = 'UPDATE leitos SET status = :status
								   WHERE id = :idleito';
									 
			$stmt1 = $conn->prepare($sql1);
			$stmt1->bindParam(':status' , $statusleito);
			$stmt1->bindParam(':idleito', $idleito);
			
			
			if($stmt1->execute()){
				
				$diahorarioentrada = time();
				
				$sql2 = 'UPDATE internacoes SET idleito = :idleito,
				                                diahorarioentrada = :diahorarioentrada,
												status = :status
								            WHERE cpfpaciente = :cpfpaciente';
									 
				$stmt2 = $conn->prepare($sql2);
				$stmt2->bindParam(':idleito'          , $idleito);
				$stmt2->bindParam(':diahorarioentrada', $diahorarioentrada);
				$stmt2->bindParam(':status'           , $statusinternacao);
				$stmt2->bindParam(':cpfpaciente'      , $cpfpaciente);
			
				if($stmt2->execute()){
					echo '<div class="alert alert-success">
							<strong>Internação realizada!</strong>.
						</div>';
						
					header("Location: gerenciamentoInternacoes.php");
				}
				else{
					echo '<div class="alert alert-danger">
							<strong>Erro!</strong> Erro no banco de dados.
						</div>';
				}
			}
			else{
				echo '<div class="alert alert-danger">
						<strong>Erro!</strong> Erro no banco de dados.
			          </div>';
			}
		}
	}
	else{
		echo '<div class="alert alert-danger">
				<strong>Erro!</strong> Não existem leitos livres.
			  </div>';
	}
?>