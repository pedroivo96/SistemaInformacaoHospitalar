<?php
	include './conexao.php';

    if(!empty($_POST)){
		
		$diahorarioinicio = $_POST['diahorarioinicio'];
		$diahorariofim    = $_POST['diahorariofim'];
		
		$conn = getConnection();
		
		$sql = 'INSERT INTO plantoes (diahorarioinicio, 
			                          diahorariofim) VALUES(:diahorarioinicio, 
											                :diahorariofim)';
															
		$timeinicio = strtotime(strval($diahorarioinicio));
		$timefim    = strtotime(strval($diahorariofim));
		
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':diahorarioinicio', $timeinicio);
		$stmt->bindParam(':diahorariofim'   , $timefim);
			
		if($stmt->execute()){
			echo '<div class="alert alert-success">
					<strong>Plantão realizado!</strong>
                  </div>';
			header("Location: admin.php");
		}
		else{
			echo '<div class="alert alert-danger">
					<strong>Erro no cadastro!</strong> Falha no banco de dados.
                  </div>';
		}
	}
?>