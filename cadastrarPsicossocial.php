<?php

	include './conexao.php';
	
	if(!empty($_POST)){
		
		$idanamnese                 = $_POST['idanamnese'];
		$interacaosocial            = $_POST['interacaosocial'];
		$resolucaoproblemas         = $_POST['resolucaoproblemas'];
		$apoioespiritual            = $_POST['apoioespiritual'];
		$suportefinanceiro          = $_POST['suportefinanceiro'];
		$suportefinanceirooutros    = $_POST['suportefinanceirooutros'];
		$conhecimentoproblema       = $_POST['conhecimentoproblema'];
		$conhecimentoproblemaoutros = $_POST['conhecimentoproblemaoutros'];
		$condicoesautocuidado       = $_POST['condicoesautocuidado'];
		$condicoesautocuidadooutros = $_POST['condicoesautocuidadooutros'];
		$mudancahumor               = $_POST['mudancahumor'];
		$mudancahumoroutros         = $_POST['mudancahumoroutros'];
		
		$conn = getConnection();
		
		$sql = 'UPDATE anamnesepsicossocial SET 
		                                interacaosocial = :interacaosocial,
										resolucaoproblemas = :resolucaoproblemas,
										apoioespiritual = :apoioespiritual,
										suportefinanceiro = :suportefinanceiro,
										suportefinanceirooutros = :suportefinanceirooutros,
										conhecimentoproblema = :conhecimentoproblema,
										conhecimentoproblemaoutros = :conhecimentoproblemaoutros,
										condicoesautocuidado = :condicoesautocuidado,
										condicoesautocuidadooutros = :condicoesautocuidadooutros,
										mudancahumor = :mudancahumor,
										mudancahumoroutros = :mudancahumoroutros
										WHERE idanamnese = :idanamnese';
           
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(':idanamnese'                , $idanamnese);
		$stmt->bindParam(':interacaosocial'           , $interacaosocial);
		$stmt->bindParam(':resolucaoproblemas'        , $resolucaoproblemas);
		$stmt->bindParam(':apoioespiritual'           , $apoioespiritual);
		$stmt->bindParam(':suportefinanceiro'         , $suportefinanceiro);
		$stmt->bindParam(':suportefinanceirooutros'   , $suportefinanceirooutros);
		$stmt->bindParam(':conhecimentoproblema'      , $conhecimentoproblema);
		$stmt->bindParam(':conhecimentoproblemaoutros', $conhecimentoproblemaoutros);
		$stmt->bindParam(':condicoesautocuidado'      , $condicoesautocuidado);
		$stmt->bindParam(':condicoesautocuidadooutros', $condicoesautocuidadooutros);
		$stmt->bindParam(':mudancahumor'              , $mudancahumor);
		$stmt->bindParam(':mudancahumoroutros'        , $mudancahumoroutros);
			
		if($stmt->execute()){
			//Retorno o ID da Anamnese
			echo $idanamnese;
		}else{
			echo 'ERRO';
		}
	}

?>