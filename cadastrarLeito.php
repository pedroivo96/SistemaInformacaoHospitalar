<?php
	include './conexao.php';

    if(!empty($_POST)){
		
		$idsetor = $_POST['idsetor'];
		$status  = "Livre";
		
		$conn = getConnection();
		
		$sql = 'INSERT INTO leitos (idsetor, status) VALUES(:idsetor, :status)';
			
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':idsetor', $idsetor);
		$stmt->bindParam(':status' , $status);
			
		if($stmt->execute()){
			
			echo "SUCESSO";
		}
		else{
			
			echo "ERRO";
		}
	}
?>