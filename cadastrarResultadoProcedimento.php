<?php
	include './conexao.php';

    if(!empty($_POST)){
	
		$id       = $_POST['id'];
		//$conteudo = $_FILES['conteudo'];
		
		// File upload path
		$targetDir      = "img/";
		$fileName       = basename($_FILES["conteudo"]["name"]);
		$targetFilePath = $targetDir . $fileName;
		$fileType       = pathinfo($targetFilePath,PATHINFO_EXTENSION);
		
		if(isset($_POST["submit"]) && !empty($_FILES["conteudo"]["name"])){
			// Allow certain file formats
			$allowTypes = array('jpg','png','jpeg','gif','pdf');
			if(in_array($fileType, $allowTypes)){
				// Upload file to server
				if(move_uploaded_file($_FILES["conteudo"]["tmp_name"], $targetFilePath)){
			
					$conn = getConnection();
		
					$sql = 'INSERT INTO resultadosprocedimentos (id, 
			                                                     nomeimagem) VALUES(:id, 
											                                        :nomeimagem)';
															
		
					$stmt = $conn->prepare($sql);
					$stmt->bindParam(':id'      , $id);
					$stmt->bindParam(':nomeimagem', $fileName);
			
					if($stmt->execute()){
						echo '<div class="alert alert-success">
							<strong>Resultado de exame cadastrado com sucesso!</strong>
						</div>';
				  
						$status = "Resultado";
				  
						$sql1 = 'UPDATE procedimentos SET status = :status
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

					if($insert){
						$statusMsg = "The file ".$fileName. " has been uploaded successfully.";
					}else{
						$statusMsg = "File upload failed, please try again.";
					} 
				}else{
					$statusMsg = "Sorry, there was an error uploading your file.";
				}
			}else{
				$statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
			}
		}else{
			$statusMsg = 'Please select a file to upload.';
		}

		// Display status message
		echo $statusMsg;
		
	}
?>