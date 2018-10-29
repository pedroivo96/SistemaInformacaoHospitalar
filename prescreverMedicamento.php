<?php
	include './conexao.php';
	
	if(!empty($_POST)){
		
		$idconsulta      = $_POST['idconsulta'];
		$nomemedicamento = $_POST['nomemedicamento'];
		$quantidade      = $_POST['quantidade'];
		$vezesaodia      = $_POST['vezesaodia'];;
		
		$conn = getConnection();
		
		$sql = 'INSERT INTO prescricoes (nomemedicamento, 
									     quantidade,
									     vezesaodia,
									     idconsulta) VALUES(:nomemedicamento,
												            :quantidade,
													        :vezesaodia,
														    :idconsulta)';
        $stmt = $conn->prepare($sql);
		$stmt->bindParam(':nomemedicamento' , $nomemedicamento);
		$stmt->bindParam(':quantidade'      , $quantidade);
		$stmt->bindParam(':vezesaodia'      , $vezesaodia);
		$stmt->bindParam(':idconsulta'      , $idconsulta);
			
		if($stmt->execute()){
            echo "Sucesso3";
					  
			session_start();
				  
			$_SESSION['id']           = $idconsulta;
			$_SESSION['cpfmedico']    = $cpfmedico;
			$_SESSION['cpfpaciente']  = $cpfpaciente;
			$_SESSION['nomemedico']   = $nomemedico;
			$_SESSION['nomepaciente'] = $nomepaciente;	  
					  
			//header("Location: atenderPaciente.php");
        }else{
            echo "Erro3";
        }
	}

?>