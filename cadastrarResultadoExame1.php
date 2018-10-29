<?php 
	include './conexao.php';

    if(!empty($_POST)){
	
		$id     = $_POST['id'];
		
		$check = getimagesize($_FILES["conteudo"]["tmp_name"]);
		
		if($check !== false){
			$image = $_FILES['conteudo']['tmp_name'];
			$imgContent = addslashes(file_get_contents($image));
			
			$conn = getConnection();
		
			$sql = 'INSERT INTO resultadosexames (id, 
			                                      imagem) VALUES(:id, 
											                     :imagem)';
															
		
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':id'      , $id);
			$stmt->bindParam(':imagem'  , $imgContent);
			
			if($stmt->execute()){
				echo '<div class="alert alert-success">
						<strong>Resultado de exame cadastrado com sucesso!</strong>
					</div>';
				  
				$status = "Resultado";
				  
				$sql1 = 'UPDATE exames SET status = :status
											   WHERE id = :id';
									 
				$stmt1 = $conn->prepare($sql1);
				$stmt1->bindParam(':status', $status);
				$stmt1->bindParam(':id'    , $id);
			
				if($stmt1->execute()){
					echo '<div class="alert alert-success">
							<strong>Atualização de exame finalizada com sucesso!</strong>
						  </div>';
					
					header("Location: admin.php");
				}
			}
			else{
				echo '<div class="alert alert-danger">
						<strong>Erro no cadastro!</strong> Falha no banco de dados.
					  </div>';
			}
		}
	}
?>