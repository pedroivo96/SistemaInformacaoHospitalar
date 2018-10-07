<?php
	include './conexao.php';
	
	if(!empty($_POST)){

		$cpftecnico = $_POST['cpftecnico'];
		$cpfpaciente = $_POST['cpfpaciente'];
		
		$conn = getConnection();
	
		$sql = 'UPDATE internacoes SET cpftecnico = :cpftecnico WHERE cpfpaciente = :cpfpaciente';				 
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':cpftecnico' , $cpftecnico);
		$stmt->bindParam(':cpfpaciente', $cpfpaciente);
		
		if($stmt->execute()){
			echo '<div class="alert alert-success">
					<strong>Associação finalizada com sucesso!</strong>
                  </div>';
				  
			header("Location: consultasMedico.php");
		}
		else{
			echo '<div class="alert alert-danger">
					<strong>Erro!</strong> Falha no banco de dados.
                  </div>';
				  
			header("Location: consultasMedico.php");
		}
	}
?>