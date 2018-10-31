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
			
			$idprescricao = $conn->lastInsertId();
			
			$sql1 = 'INSERT INTO consultaprescricao (idconsulta, 
									                 idprescricao) VALUES(:idconsulta,
												                          :idprescricao)';
			$stmt1 = $conn->prepare($sql1);
			$stmt1->bindParam(':idconsulta'  , $idconsulta);
			$stmt1->bindParam(':idprescricao', $idprescricao);
			
			if($stmt1->execute()){
				echo "Sucesso3";
			}
        }else{
            echo "Erro3";
        }
	}

?>