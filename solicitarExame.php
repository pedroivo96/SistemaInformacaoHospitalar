<?php
	include './conexao.php';
	
	if(!empty($_POST)){
		
		$idconsulta         = $_POST['idconsulta'];
		$nomeexame          = $_POST['nomeexame'];
		$anotacoesopcionais = $_POST['anotacoesopcionais'];
		$status             = "Solicitado";
		
		$conn = getConnection();
		
		$sql = 'INSERT INTO exames (nomeexame, 
									status,
									anotacoesopcionais,
									idconsulta) VALUES(:nomeexame,
												       :status,
													   :anotacoesopcionais,
													   :idconsulta)';
        $stmt = $conn->prepare($sql);
		$stmt->bindParam(':nomeexame'          , $nomeexame);
		$stmt->bindParam(':status'             , $status);
		$stmt->bindParam(':anotacoesopcionais' , $anotacoesopcionais);
		$stmt->bindParam(':idconsulta'         , $idconsulta);
			
		if($stmt->execute()){
            echo "Sucesso1";
				  
			session_start();
				  
			$_SESSION['id'] = $idconsulta;	  
					  
			//header("Location: atenderPaciente.php");
        }else{
            echo "Erro1";
        }
	}

?>