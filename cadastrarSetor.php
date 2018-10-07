<?php
	include './conexao.php';

    if(!empty($_POST)){
		
		$nomesetor = $_POST['nomesetor'];
		
		$conn = getConnection();
		
		$sql = 'INSERT INTO setores (nome) VALUES(:nomesetor)';
			
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nomesetor', $nomesetor);
			
		if($stmt->execute()){
			echo   '<div class="alert alert-success">
						<strong>Cadastrado realizado!</strong> Setor cadastrado com sucesso.
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