<?php
	include './conexao.php';
	
	if(!empty($_POST)){
		
		session_start();
		
		$cpfpaciente      = $_SESSION['cpf'];
		$cpfmedico        = $_POST['cpf'];
		$diahorarioinicio = $_POST['diahorarioinicio'];
		$diahorariofim    = $_POST['diahorariofim'];
		$status           = "Agendada";
		
		$conn = getConnection();
		
		$sql = 'INSERT INTO consultas (cpfmedico, 
			                           cpfpaciente, 
									   diahorarioinicio, 
									   diahorariofim,
									   status) VALUES(:cpfmedico, 
											          :cpfpaciente, 
												      :diahorarioinicio,
												      :diahorariofim,
													  :status)';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':cpfmedico'        , $cpfmedico);
		$stmt->bindParam(':cpfpaciente'      , $cpfpaciente);
		$stmt->bindParam(':diahorarioinicio' , $diahorarioinicio);
		$stmt->bindParam(':diahorariofim'    , $diahorariofim);
		$stmt->bindParam(':status'           , $status);
			
		if($stmt->execute()){
            echo '<div class="alert alert-success">
					<strong>Consulta agendada com sucesso!</strong>
                  </div>';
					  
			header("Location: consultas.html");
        }else{
            echo '<div class="alert alert-danger">
					<strong>Erro no cadastro!</strong> Falha no banco de dados.
                  </div>';
        }
		
		
	}

?>