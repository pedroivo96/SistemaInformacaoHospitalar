<?php
	include './conexao.php';

    if(!empty($_POST)){
		
		$idsetor = $_POST['setor'];
		$status  = "Livre";
		
		$conn = getConnection();
		
		$sql = 'INSERT INTO leitos (idsetor, status) VALUES(:idsetor, :status)';
			
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':idsetor', $idsetor);
		$stmt->bindParam(':status' , $status);
			
		if($stmt->execute()){
			echo   '<div class="alert alert-success">
						<strong>Cadastrado realizado!</strong> Leito cadastrado com sucesso.
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