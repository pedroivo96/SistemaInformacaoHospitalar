<?php
	include './conexao.php';
	
	if(!empty($_POST)){
		
		$idconsulta      = $_POST['idconsulta'];
		$cpfmedico       = $_POST['cpfmedico'];
		$cpfpaciente     = $_POST['cpfpaciente'];
		$nomemedico      = $_POST['nomemedico'];
		$nomepaciente    = $_POST['nomepaciente'];
		$nomemedicamento = $_POST['nomemedicamento'];
		$quantidade      = $_POST['quantidade'];
		$vezesaodia      = $_POST['vezesaodia'];;
		
		$conn = getConnection();
		
		$sql = 'INSERT INTO prescricoes (cpfmedico, 
			                             cpfpaciente, 
									     nomemedicamento, 
									     quantidade,
									     vezesaodia,
									     idconsulta) VALUES(:cpfmedico, 
											                :cpfpaciente, 
												            :nomemedicamento,
												            :quantidade,
													        :vezesaodia,
														    :idconsulta)';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':cpfmedico'       , $cpfmedico);
		$stmt->bindParam(':cpfpaciente'     , $cpfpaciente);
		$stmt->bindParam(':nomemedicamento' , $nomemedicamento);
		$stmt->bindParam(':quantidade'      , $quantidade);
		$stmt->bindParam(':vezesaodia'      , $vezesaodia);
		$stmt->bindParam(':idconsulta'      , $idconsulta);
			
		if($stmt->execute()){
            echo '<div class="alert alert-success">
					<strong>Prescrição realizada com sucesso!</strong>
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