<?php
	include './conexao.php';
	
	if(!empty($_POST)){
		
		$idconsulta           = $_POST['idconsulta'];
		$cpfmedico            = $_POST['cpfmedico'];
		$cpfpaciente          = $_POST['cpfpaciente'];
		$nomemedico           = $_POST['nomemedico'];
		$nomepaciente         = $_POST['nomepaciente'];
		
		$queixaprincipal      = $_POST['queixaprincipal'];
		$exameclinico         = $_POST['exameclinico'];
		$diagnosticoprovavel  = $_POST['diagnosticoprovavel'];
		$altainternacao       = $_POST['altainternacao'];
		$status               = "Realizada";
		
		$conn = getConnection();
		
		$sql = 'UPDATE consultas SET queixaprincipal = :queixaprincipal,
		                             exameclinico = :exameclinico,
									 diagnosticoprovavel = :diagnosticoprovavel,
									 altainternacao = :altainternacao,
									 WHERE id = :idconsulta';
									 
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':queixaprincipal'      , $queixaprincipal);
		$stmt->bindParam(':exameclinico'         , $exameclinico);
		$stmt->bindParam(':diagnosticoprovavel'  , $diagnosticoprovavel);
		$stmt->bindParam(':altainternacao'       , $altainternacao);
		$stmt->bindParam(':idconsulta'           , $idconsulta);
			
		if($stmt->execute()){
            echo '<div class="alert alert-success">
					<strong>Consulta finalizada com sucesso!</strong>
                  </div>';
				  
			if($alta != "Alta"){
				//Solicitar internação
				
				$status1 = "Solicitada";
				
				$sql1 = 'INSERT INTO internacoes (cpfmedico, 
			                                      cpfpaciente, 
									              status) VALUES(:cpfmedico, 
											                     :cpfpaciente, 
												                 :status)';
				$stmt1 = $conn->prepare($sql1);
				$stmt1->bindParam(':cpfmedico'       , $cpfmedico);
				$stmt1->bindParam(':cpfpaciente'     , $cpfpaciente);
				$stmt1->bindParam(':status'          , $status1);
			
				if($stmt1->execute()){
					echo '<div class="alert alert-success">
							<strong>Internação solicitada com sucesso!</strong>
						</div>';
				
				}
				
			else{
				//Não solicita internação
			}
				  
			session_start();
				  
			$_SESSION['id']           = $idconsulta;
			$_SESSION['cpfmedico']    = $cpfmedico;
			$_SESSION['cpfpaciente']  = $cpfpaciente;
			$_SESSION['nomemedico']   = $nomemedico;
			$_SESSION['nomepaciente'] = $nomepaciente;	  
					  
			header("Location: consultasMedico.php");
        }else{
            echo '<div class="alert alert-danger">
					<strong>Erro!</strong> Falha no banco de dados.
                  </div>';
        }
	}

?>