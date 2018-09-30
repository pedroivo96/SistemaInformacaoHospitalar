<?php
	include './conexao.php';

    if(!empty($_POST)){
		
		$cpf              = $_POST['cpf'];
        $diahorarioinicio = $_POST['diahorarioinicio'];
		$diahorariofim    = $_POST['diahorariofim'];
		
		$conn = getConnection();
		
		$sql = 'SELECT * FROM horarios WHERE cpf = :cpf';
        $stmt = $conn->prepare($sql);
		$stmt->bindValue(':cpf', $cpf);
        $stmt->execute();
        $count = $stmt->rowCount();

        if($count > 0){
            echo '<div class="alert alert-danger">
					<strong>Erro no cadastro!</strong> Email ou Username ou CPF ou RG já cadastrado.
				  </div>';
        }else{
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
					  
					  //header("Location: admin.html");
            }else{
                echo '<div class="alert alert-danger">
						<strong>Erro no cadastro!</strong> Falha no banco de dados.
                      </div>';
            }
			
		}
		
	}

?>