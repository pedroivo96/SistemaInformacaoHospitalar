<?php

	include './conexao.php';
	
	echo "CHAMOU";

    if(!empty($_POST)){

        $cpfpaciente = $_POST['cpfpaciente'];
        $cpftecnico  = $_POST['cpftecnico'];
		$nometecnico = $_POST['nometecnico'];
		
		$conn = getConnection();
		
		$sql = 'UPDATE internacoes SET cpftecnico = :cpftecnico WHERE cpfpaciente = :cpfpaciente';
									 
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':cpftecnico'  , $cpftecnico);
		$stmt->bindParam(':cpfpaciente' , $cpfpaciente);
					
		if($stmt->execute()){
            echo $nometecnico;
        }else{
            echo "Erro";
        }
	}

?>