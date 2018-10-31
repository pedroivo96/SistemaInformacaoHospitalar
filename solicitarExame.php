<?php
	include './conexao.php';
	
	if(!empty($_POST)){
		
		$idconsulta         = $_POST['idconsulta'];
		$nomeexame          = $_POST['nomeexame'];
		$anotacoesopcionais = $_POST['anotacoesopcionais'];
		$status             = "Solicitado";
		
		$conn = getConnection();
		
		$sql = 'INSERT INTO exames (nomeexame, 
									status,
									anotacoesopcionais,
									idconsulta) VALUES(:nomeexame,
												       :status,
													   :anotacoesopcionais,
													   :idconsulta)';
        $stmt = $conn->prepare($sql);
		$stmt->bindParam(':nomeexame'          , $nomeexame);
		$stmt->bindParam(':status'             , $status);
		$stmt->bindParam(':anotacoesopcionais' , $anotacoesopcionais);
		$stmt->bindParam(':idconsulta'         , $idconsulta);
			
		if($stmt->execute()){
			
			$idexame = $conn->lastInsertId();
			
			$sql1 = 'INSERT INTO consultaexame (idconsulta, 
									            idexame) VALUES(:idconsulta,
												                :idexame)';
			$stmt1 = $conn->prepare($sql1);
			$stmt1->bindParam(':idconsulta', $idconsulta);
			$stmt1->bindParam(':idexame'   , $idexame);
			
			if($stmt1->execute()){
				echo "Sucesso1";
			}
        }else{
            echo "Erro1";
        }
	}

?>