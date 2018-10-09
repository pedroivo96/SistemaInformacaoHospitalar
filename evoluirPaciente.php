<?php
	include './conexao.php';
	date_default_timezone_set("America/Fortaleza");

	$cpfpaciente     = $_POST['cpfpaciente'];
	$cpfprofissional = $_POST['cpfprofissional'];
	$conteudo        = $_POST['conteudo'];
	$diahorario      = time();
	
	$conn = getConnection();
	
	$sql = 'INSERT INTO evolucoes (cpfpaciente, 
			                       cpfprofissional, 
								   conteudo, 
								   diahorario) VALUES(:cpfpaciente, 
											          :cpfprofissional, 
													  :conteudo,
													  :diahorario)';
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':cpfpaciente'    , $cpfpaciente);
	$stmt->bindParam(':cpfprofissional', $cpfprofissional);
	$stmt->bindParam(':conteudo'       , $conteudo);
	$stmt->bindParam(':diahorario'     , $diahorario);
			
	if($stmt->execute()){
        echo '<div class="alert alert-success">
				<strong>Evolução realizada com sucesso!</strong>.
              </div>';
					  
		header("Location: gerenciamentoInternacoes.php");
    }else{
        echo '<div class="alert alert-danger">
				<strong>Erro no cadastro da evolução!</strong> Falha no banco de dados.
              </div>';
    }
?>