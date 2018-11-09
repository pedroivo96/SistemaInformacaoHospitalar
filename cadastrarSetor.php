<?php
	include './conexao.php';

    if(!empty($_POST)){
		
		$nomesetor = $_POST['nomesetor'];
		
		$conn = getConnection();
		
		$sql = 'INSERT INTO setores (nome) VALUES(:nomesetor)';
			
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nomesetor', $nomesetor);
			
		if($stmt->execute()){
			
			echo "SUCESSO";
		}
		else{
			
			echo "ERRO";
		}
	}
?>