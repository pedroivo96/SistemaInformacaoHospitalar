<?php
	include './conexao.php';

    if(!empty($_POST)){
		
		$cpfprofissional = $_POST['cpfprofissional'];
		$idplantao       = $_POST['idplantao'];
		
		$conn = getConnection();
		
		$sql = 'INSERT INTO profissionaisplantao (cpfprofissional, 
			                                      idplantao) VALUES(:cpfprofissional, 
											                        :idplantao)';
															
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':cpfprofissional', $cpfprofissional);
		$stmt->bindParam(':idplantao'      , $idplantao);
			
		if($stmt->execute()){
			echo '<div class="alert alert-success">
					<strong>Profissional cadastrado em um plantão com sucesso!</strong>
                  </div>';
			header("Location: admin.php");
		}
		else{
			echo '<div class="alert alert-danger">
					<strong>Erro!</strong> Falha no banco de dados.
                  </div>';
		}
	}
?>