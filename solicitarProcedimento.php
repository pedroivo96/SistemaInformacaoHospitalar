<?php
	include './conexao.php';
	
	if(!empty($_POST)){
		
		$idconsulta         = $_POST['idconsulta'];
		$nomeprocedimento          = $_POST['nomeprocedimento'];
		$anotacoesopcionais = $_POST['anotacoesopcionais'];
		$status             = "Solicitado";
		
		$conn = getConnection();
		
		$sql = 'INSERT INTO procedimentos (nomeprocedimento, 
									status,
									anotacoesopcionais,
									idconsulta) VALUES(:nomeprocedimento,
												       :status,
													   :anotacoesopcionais,
													   :idconsulta)';
        $stmt = $conn->prepare($sql);
		$stmt->bindParam(':nomeprocedimento'          , $nomeprocedimento);
		$stmt->bindParam(':status'             , $status);
		$stmt->bindParam(':anotacoesopcionais' , $anotacoesopcionais);
		$stmt->bindParam(':idconsulta'         , $idconsulta);
			
		if($stmt->execute()){
			
			$idprocedimento = $conn->lastInsertId();
			
			$sql1 = 'INSERT INTO consultaprocedimento (idconsulta, 
									                   idprocedimento) VALUES(:idconsulta,
												                              :idprocedimento)';
			$stmt1 = $conn->prepare($sql1);
			$stmt1->bindParam(':idconsulta', $idconsulta);
			$stmt1->bindParam(':idprocedimento'   , $idprocedimento);
			
			if($stmt1->execute()){
				echo "Sucesso2";
			}
        }else{
            echo "Erro2";
        }
	}

?>