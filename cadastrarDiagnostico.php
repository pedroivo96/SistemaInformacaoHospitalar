<?php
	include './conexao.php';
	
	if(!empty($_POST)){
		
		$idinternacao  = $_POST['idinternacao'];
		$diagnostico   = $_POST['diagnostico'];
		
		$conn = getConnection();
		
		$sql = 'UPDATE internacoes SET diagnostico = :diagnostico
								   WHERE id = :idinternacao';
									 
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':diagnostico'  , $diagnostico);
		$stmt->bindParam(':idinternacao' , $idinternacao);
			
		if($stmt->execute()){
			echo "OK";
		}
		else{
			echo "ERRO";
		}
	}
?>