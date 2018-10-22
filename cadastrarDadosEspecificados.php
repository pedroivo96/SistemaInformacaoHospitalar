<?php
	include './conexao.php';
	
	if(!empty($_POST)){
		
		$idanamnese      = $_POST['idanamnese'];
		$anotacoes       = $_POST['anotacoes'];
		$impressoes      = $_POST['impressoes'];
		$cpfprofissional = $_POST['cpfprofissional'];
		$registro        = $_POST['registro'];
		$data            = $_POST['data'];
		
		$conn = getConnection();
		
		$sql = 'INSERT INTO anamnesedadosespecificados (idanamnese, 
			                                            anotacoes, 
											            impressoes, 
											            cpfprofissional, 
											            registro, 
											            data) VALUES(:idanamnese,
											                         :anotacoes,
																     :impressoes,
																     :cpfprofissional,
																     :registro,
																     :data)';
           
		$stmt = $conn->prepare($sql);
        $stmt->bindParam(':idanamnese'     , $idanamnese);
		$stmt->bindParam(':anotacoes'      , $anotacoes);
		$stmt->bindParam(':impressoes'     , $impressoes);
		$stmt->bindParam(':cpfprofissional', $cpfprofissional);
		$stmt->bindParam(':registro'       , $registro);
		$stmt->bindParam(':data'           , $data);
			
		if($stmt->execute()){
            echo '<div class="alert alert-success">
					<strong>Cadastrado realizado!</strong> Profissional cadastrado com sucesso.
                  </div>';
					  
		    header("Location: admin.php");
        }else{
            echo '<div class="alert alert-danger">
					<strong>Erro no cadastro!</strong> Falha no banco de dados.
                  </div>';
        }
	}
?>