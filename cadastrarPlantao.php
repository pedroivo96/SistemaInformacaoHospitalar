<?php
	include './conexao.php';

    if(!empty($_POST)){
		
		date_default_timezone_set("America/Fortaleza"); 
		
		$diahorarioinicio = $_POST['diahorarioinicio'];
		$diahorariofim    = $_POST['diahorariofim'];
		
		$conn = getConnection();
		
		$sql = 'INSERT INTO plantoes (diahorarioinicio, 
			                          diahorariofim) VALUES(:diahorarioinicio, 
											                :diahorariofim)';
															
		$timeinicio = strtotime($diahorarioinicio);
		$timefim    = strtotime($diahorariofim);
		
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':diahorarioinicio', $timeinicio);
		$stmt->bindParam(':diahorariofim'   , $timefim);
			
		if($stmt->execute()){
			
			$id = $conn->lastInsertId();
			echo $id;
		}
		else{
			echo 'ERRO';
		}
	}
?>