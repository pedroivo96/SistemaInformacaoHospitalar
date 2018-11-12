<?php
	include './conexao.php';
	
	if(!empty($_POST)){
		
		$nomeexame          = $_POST['nomeexame'];
		$anotacoesopcionais = $_POST['anotacoesopcionais'];
		$status             = "Solicitado";
		$idconsulta         = $_POST['idconsulta'];
		
		$conn = getConnection();
		
		$sql = 'INSERT INTO exames (nomeexame, 
									status,
									anotacoesopcionais) VALUES(:nomeexame,
												               :status,
													           :anotacoesopcionais)';
        $stmt = $conn->prepare($sql);
		$stmt->bindParam(':nomeexame'          , $nomeexame);
		$stmt->bindParam(':status'             , $status);
		$stmt->bindParam(':anotacoesopcionais' , $anotacoesopcionais);
			
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