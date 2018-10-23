<?php
	include './conexao.php';

    if(!empty($_POST)){
	
		$id       = $_POST['id'];
		$conteudo = $_POST['conteudo'];
		
		$conn = getConnection();
		
		$sql = 'INSERT INTO resultadosprocedimentos (id, 
			                                         conteudo) VALUES(:id, 
											                          :conteudo)';
															
		
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id'      , $id);
		$stmt->bindParam(':conteudo', $conteudo);
			
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