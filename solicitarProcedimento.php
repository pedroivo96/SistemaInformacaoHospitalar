<?php
	include './conexao.php';
	
	if(!empty($_POST)){
		
		$idconsulta         = $_POST['idconsulta'];
		$cpfmedico          = $_POST['cpfmedico'];
		$cpfpaciente        = $_POST['cpfpaciente'];
		$nomemedico         = $_POST['nomemedico'];
		$nomepaciente       = $_POST['nomepaciente'];
		$nomeprocedimento   = $_POST['nomeexame'];
		$anotacoesopcionais = $_POST['anotacoesopcionais'];
		$status             = "Solicitado";
		
		$conn = getConnection();
		
		$sql = 'INSERT INTO procedimentos (cpfmedico, 
			                               cpfpaciente, 
									       nomeprocedimento, 
									       status,
									       anotacoesopcionais,
									       idconsulta) VALUES(:cpfmedico, 
											                  :cpfpaciente, 
												              :nomeprocedimento,
												              :status,
													          :anotacoesopcionais,
														      :idconsulta)';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':cpfmedico'          , $cpfmedico);
		$stmt->bindParam(':cpfpaciente'        , $cpfpaciente);
		$stmt->bindParam(':nomeprocedimento'   , $nomeprocedimento);
		$stmt->bindParam(':status'             , $status);
		$stmt->bindParam(':anotacoesopcionais' , $anotacoesopcionais);
		$stmt->bindParam(':idconsulta'         , $idconsulta);
			
		if($stmt->execute()){
            echo '<div class="alert alert-success">
					<strong>Procedimento solicitado com sucesso!</strong>
                  </div>';
					  
			session_start();
				  
			$_SESSION['id']           = $idconsulta;
			$_SESSION['cpfmedico']    = $cpfmedico;
			$_SESSION['cpfpaciente']  = $cpfpaciente;
			$_SESSION['nomemedico']   = $nomemedico;
			$_SESSION['nomepaciente'] = $nomepaciente;	  
					  
			header("Location: atenderPaciente.php");
        }else{
            echo '<div class="alert alert-danger">
					<strong>Erro!</strong> Falha no banco de dados.
                  </div>';
        }
	}

?>