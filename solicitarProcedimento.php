<?php
	include './conexao.php';
	
	if(!empty($_POST)){
		
		$nomeprocedimento   = $_POST['nomeprocedimento'];
		$anotacoesopcionais = $_POST['anotacoesopcionais'];
		$idconsulta         = $_POST['idconsulta'];
		$status             = "Solicitado";
		
		$conn = getConnection();
		
		$sql = 'INSERT INTO procedimentos (nomeprocedimento, 
									       status,
									       anotacoesopcionais) VALUES(:nomeprocedimento,
												                      :status,
													                  :anotacoesopcionais)';
        $stmt = $conn->prepare($sql);
		$stmt->bindParam(':nomeprocedimento'  , $nomeprocedimento);
		$stmt->bindParam(':status'            , $status);
		$stmt->bindParam(':anotacoesopcionais', $anotacoesopcionais);
			
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