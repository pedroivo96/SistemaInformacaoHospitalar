<?php
	include './conexao.php';

    if(!empty($_POST)){
		
		$cpf              = $_POST['cpf'];
        $diahorarioinicio = $_POST['diahorarioinicio'];
		$diahorariofim    = $_POST['diahorariofim'];
		
		$conn = getConnection();
		
		$sql2 = 'INSERT INTO horarios (cpf, 
			                           diahorarioinicio, 
									   diahorariofim) VALUES(:cpf, 
											                 :diahorarioinicio, 
														     :diahorariofim)';
																 
		$timeinicio = strtotime(strval($diahorarioinicio));
		$timefim    = strtotime(strval($diahorariofim));
			
        $stmt2 = $conn->prepare($sql2);
        $stmt2->bindParam(':cpf'              , $cpf);
		$stmt2->bindParam(':diahorarioinicio' , $timeinicio);
		$stmt2->bindParam(':diahorariofim'    , $timefim);
			
		if($stmt2->execute()){
            echo '<div class="alert alert-success">
					<strong>Cadastrado realizado!</strong> Horário cadastrado com sucesso.
                  </div>';
					  
					echo $cpf;
					echo $timeinicio;
					echo $timefim;
					  
					header("Location: admin.html");
        }else{
            echo '<div class="alert alert-danger">
					<strong>Erro no cadastro!</strong> Falha no banco de dados.
                  </div>';
        }
		
	}

?>