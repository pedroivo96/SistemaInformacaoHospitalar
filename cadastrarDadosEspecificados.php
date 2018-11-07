<?php
	include './conexao.php';
	
	if(!empty($_POST)){
		
		$idanamnese      = $_POST['idanamnese'];
		$anotacoes       = $_POST['anotacoes'];
		$impressoes      = $_POST['impressoes'];
		
		$conn = getConnection();
		
		$sql = 'UPDATE anamnesedadosespecificados SET anotacoes = :anotacoes,
                           		                      impressoes = :impressoes,
													  WHERE idanamnese = :idanamnese'
		
		$stmt = $conn->prepare($sql);
        $stmt->bindParam(':idanamnese'     , $idanamnese);
		$stmt->bindParam(':anotacoes'      , $anotacoes);
		$stmt->bindParam(':impressoes'     , $impressoes);
			
		if($stmt->execute()){
            echo $idanamnese;
        }else{
            echo 'ERRO';
        }
	}
?>