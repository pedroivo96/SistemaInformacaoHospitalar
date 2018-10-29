<?php
	include './conexao.php';
	
	if(!empty($_POST)){
		
		$idconsulta         = $_POST['idconsulta'];
		$nomeprocedimento   = $_POST['nomeexame'];
		$anotacoesopcionais = $_POST['anotacoesopcionais'];
		$status             = "Solicitado";
		
		$conn = getConnection();
		
		$sql = 'INSERT INTO procedimentos (nomeprocedimento, 
									       status,
									       anotacoesopcionais,
									       idconsulta) VALUES(:nomeprocedimento,
												              :status,
													          :anotacoesopcionais,
														      :idconsulta)';
        $stmt = $conn->prepare($sql);
		$stmt->bindParam(':nomeprocedimento'   , $nomeprocedimento);
		$stmt->bindParam(':status'             , $status);
		$stmt->bindParam(':anotacoesopcionais' , $anotacoesopcionais);
		$stmt->bindParam(':idconsulta'         , $idconsulta);
			
		if($stmt->execute()){
            echo "Sucesso2";
					  
			session_start();
				  
			$_SESSION['id']           = $idconsulta;
			$_SESSION['cpfmedico']    = $cpfmedico;
			$_SESSION['cpfpaciente']  = $cpfpaciente;
			$_SESSION['nomemedico']   = $nomemedico;
			$_SESSION['nomepaciente'] = $nomepaciente;	  
					  
			//header("Location: atenderPaciente.php");
        }else{
            echo "Erro2";
        }
	}

?>