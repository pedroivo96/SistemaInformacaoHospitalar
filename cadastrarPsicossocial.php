<?php

	include './conexao.php';
	
	if(!empty($_POST)){
		
		$idanamnese = $_POST['idanamnese'];
		
		$interacaosocial = "";
		if(isset($_POST['interacaosocial1'])){ $interacaosocial = $interacaosocial . $_POST['interacaosocial1']; }
		if(isset($_POST['interacaosocial2'])){ $interacaosocial = $interacaosocial . $_POST['interacaosocial2']; }
		if(isset($_POST['interacaosocial3'])){ $interacaosocial = $interacaosocial . $_POST['interacaosocial3']; }
		if(isset($_POST['interacaosocial4'])){ $interacaosocial = $interacaosocial . $_POST['interacaosocial4']; }
		
		$resolucaoproblemas = "";
		if(isset($_POST['resolucaoproblemas1'])){ $resolucaoproblemas = $resolucaoproblemas . $_POST['resolucaoproblemas1']; }
		if(isset($_POST['resolucaoproblemas2'])){ $resolucaoproblemas = $resolucaoproblemas . $_POST['resolucaoproblemas2']; }
		if(isset($_POST['resolucaoproblemas3'])){ $resolucaoproblemas = $resolucaoproblemas . $_POST['resolucaoproblemas3']; }
		if(isset($_POST['resolucaoproblemas4'])){ $resolucaoproblemas = $resolucaoproblemas . $_POST['resolucaoproblemas4']; }
		
		$apoioespiritual = "";
		if(isset($_POST['apoioespiritual1'])){ $apoioespiritual = $apoioespiritual . $_POST['apoioespiritual1']; }
		if(isset($_POST['apoioespiritual2'])){ $apoioespiritual = $apoioespiritual . $_POST['apoioespiritual2']; }
		if(isset($_POST['apoioespiritual3'])){ $apoioespiritual = $apoioespiritual . $_POST['apoioespiritual3']; }
		if(isset($_POST['apoioespiritual4'])){ $apoioespiritual = $apoioespiritual . $_POST['apoioespiritual4']; }
		
		$suportefinanceiro = "";
		if(isset($_POST['suportefinanceiro1'])){ $suportefinanceiro = $suportefinanceiro . $_POST['suportefinanceiro1']; }
		if(isset($_POST['suportefinanceiro2'])){ $suportefinanceiro = $suportefinanceiro . $_POST['suportefinanceiro2']; }
		if(isset($_POST['suportefinanceiro3'])){ $suportefinanceiro = $suportefinanceiro . $_POST['suportefinanceiro3']; }
		if(isset($_POST['suportefinanceiro4'])){ $suportefinanceiro = $suportefinanceiro . $_POST['suportefinanceiro4']; }
		
		$suportefinanceirooutros = $_POST['suportefinanceirooutros'];
		
		$conhecimentoproblema = "";
		if(isset($_POST['conhecimentoproblema1'])){ $conhecimentoproblema = $conhecimentoproblema . $_POST['conhecimentoproblema1']; }
		if(isset($_POST['conhecimentoproblema2'])){ $conhecimentoproblema = $conhecimentoproblema . $_POST['conhecimentoproblema2']; }
		if(isset($_POST['conhecimentoproblema3'])){ $conhecimentoproblema = $conhecimentoproblema . $_POST['conhecimentoproblema3']; }
		if(isset($_POST['conhecimentoproblema4'])){ $conhecimentoproblema = $conhecimentoproblema . $_POST['conhecimentoproblema4']; }
		
		$conhecimentoproblemaoutros = $_POST['conhecimentoproblemaoutros'];
		
		$condicoesautocuidado = "";
		if(isset($_POST['condicoesautocuidado1'])){ $condicoesautocuidado = $condicoesautocuidado . $_POST['condicoesautocuidado1']; }
		if(isset($_POST['condicoesautocuidado2'])){ $condicoesautocuidado = $condicoesautocuidado . $_POST['condicoesautocuidado2']; }
		if(isset($_POST['condicoesautocuidado3'])){ $condicoesautocuidado = $condicoesautocuidado . $_POST['condicoesautocuidado3']; }
		if(isset($_POST['condicoesautocuidado4'])){ $condicoesautocuidado = $condicoesautocuidado . $_POST['condicoesautocuidado4']; }
		
		$condicoesautocuidadooutros = $_POST['condicoesautocuidadooutros'];
		
		$mudancahumor = "";
		if(isset($_POST['mudancahumor1'])){ $mudancahumor = $mudancahumor . $_POST['mudancahumor1']; }
		if(isset($_POST['mudancahumor2'])){ $mudancahumor = $mudancahumor . $_POST['mudancahumor2']; }
		if(isset($_POST['mudancahumor3'])){ $mudancahumor = $mudancahumor . $_POST['mudancahumor3']; }
		if(isset($_POST['mudancahumor4'])){ $mudancahumor = $mudancahumor . $_POST['mudancahumor4']; }
		
		$mudancahumoroutros = $_POST['mudancahumoroutros'];
		
		$conn = getConnection();
		
		$sql = 'INSERT INTO anamnesehabitos (idanamnese, 
			                                 interacaosocial, 
											 resolucaoproblemas, 
											 apoioespiritual, 
											 suportefinanceiro, 
											 suportefinanceirooutros, 
											 conhecimentoproblema,
											 conhecimentoproblemaoutros,
											 condicoesautocuidado,
											 condicoesautocuidadooutros,
											 mudancahumor,
											 mudancahumoroutros) VALUES(:idanamnese,
											                         :interacaosocial,
																     :resolucaoproblemas,
																     :apoioespiritual,
																     :suportefinanceiro,
																     :suportefinanceirooutros,
																     :conhecimentoproblema,
																     :conhecimentoproblemaoutros,
																     :condicoesautocuidado,
																     :condicoesautocuidadooutros,
																     :mudancahumor,
																     :mudancahumoroutros)';
           
		$stmt = $conn->prepare($sql);
        $stmt->bindParam(':idanamnese'                 , $idanamnese);
		$stmt->bindParam(':interacaosocial'            , $interacaosocial);
		$stmt->bindParam(':resolucaoproblemas'         , $resolucaoproblemas);
		$stmt->bindParam(':apoioespiritual'            , $apoioespiritual);
		$stmt->bindParam(':suportefinanceiro'          , $suportefinanceiro);
		$stmt->bindParam(':suportefinanceirooutros'    , $suportefinanceirooutros);
		$stmt->bindParam(':conhecimentoproblema'       , $conhecimentoproblema);
		$stmt->bindParam(':conhecimentoproblemaoutros' , $conhecimentoproblemaoutros);
		$stmt->bindParam(':condicoesautocuidado'       , $condicoesautocuidado);
		$stmt->bindParam(':condicoesautocuidadooutros' , $condicoesautocuidadooutros);
		$stmt->bindParam(':mudancahumor'               , $mudancahumor);
		$stmt->bindParam(':mudancahumoroutros'         , $mudancahumoroutros);
			
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