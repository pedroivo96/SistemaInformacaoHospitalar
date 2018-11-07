<?php
	include './conexao.php';
	
	if(!empty($_POST)){
		
		$idanamnese 					= $_POST['idanamnese'];
		$condicoesmoradia 				= $_POST['condicoesmoradia'];
		$condicoesmoradiaoutros 		= $_POST['condicoesmoradiaoutros'];
		$cuidadocorporal 				= $_POST['cuidadocorporal'];
		$periodobanho 					= $_POST['periodobanho'];
		$atividadetrabalho 				= $_POST['atividadetrabalho'];
		$atividadetrabalhooutros 		= $_POST['atividadetrabalhooutros'];
		$sonorepouso 					= $_POST['sonorepouso'];
		$horasdormidas 					= $_POST['horasdormidas'];
		$insoniauti 					= $_POST['insoniauti'];
		$exerciciosprogramados 			= $_POST['exerciciosprogramados'];
		$vezesexercicios 				= $_POST['vezesexercicios'];
		$recreacaolazer 				= $_POST['recreacaolazer'];
		$recreacaolazeroutros 			= $_POST['recreacaolazeroutros'];
		$comerfrequencia 				= $_POST['comerfrequencia'];
		$numerorefeicoes 				= $_POST['numerorefeicoes'];
		$comerfrequenciaoutros 			= $_POST['comerfrequenciaoutros'];
		$eliminacaourinaria 			= $_POST['eliminacaourinaria'];
		$eliminacaointestinal 			= $_POST['eliminacaointestinal'];
		$eliminacaointestinalfrequencia = $_POST['eliminacaointestinalfrequencia'];
		$ciclomenstrual                 = $_POST['ciclomenstrual'];
		$ciclomenstrualoutros           = $_POST['ciclomenstrualoutros'];
		$atividadesexual                = $_POST['atividadesexual'];
		$atividadesexualoutros          = $_POST['atividadesexualoutros'];
		
		$conn = getConnection();
		
		$sql = 'UPDATE anamnesehabitos SET condicoesmoradia = :condicoesmoradia,
										   condicoesmoradiaoutros = :condicoesmoradiaoutros,
										   cuidadocorporal = :cuidadocorporal,
										   periodobanho = :periodobanho,
										   atividadetrabalho = :atividadetrabalho,
										   atividadetrabalhooutros = :atividadetrabalhooutros,
										   sonorepouso = :sonorepouso,
										   horasdormidas = :horasdormidas,
										   insoniauti = :insoniauti,
										   exerciciosprogramados = :exerciciosprogramados,
										   vezesexercicios = :vezesexercicios,
										   recreacaolazer = :recreacaolazer,
										   recreacaolazeroutros = :recreacaolazeroutros,
										   comerfrequencia = :comerfrequencia,
										   numerorefeicoes = :numerorefeicoes,
										   comerfrequenciaoutros = :comerfrequenciaoutros,
										   eliminacaourinaria = :eliminacaourinaria,
										   eliminacaointestinal = :eliminacaointestinal,
										   eliminacaointestinalfrequencia = :eliminacaointestinalfrequencia,
										   ciclomenstrual = :ciclomenstrual,
										   ciclomenstrualoutros = :ciclomenstrualoutros,
										   atividadesexual = :atividadesexual,
										   atividadesexualoutros = :atividadesexualoutros
										   WHERE idanamnese = :idanamnese';
           
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(':idanamnese'                    , $idanamnese);
		$stmt->bindParam(':condicoesmoradia'              , $condicoesmoradia);
		$stmt->bindParam(':condicoesmoradiaoutros'        , $condicoesmoradiaoutros);
		$stmt->bindParam(':cuidadocorporal'               , $cuidadocorporal);
		$stmt->bindParam(':periodobanho'                  , $periodobanho);
		$stmt->bindParam(':atividadetrabalho'             , $atividadetrabalho);
		$stmt->bindParam(':atividadetrabalhooutros'       , $atividadetrabalhooutros);
		$stmt->bindParam(':sonorepouso'                   , $sonorepouso);
		$stmt->bindParam(':horasdormidas'                 , $horasdormidas);
		$stmt->bindParam(':insoniauti'                    , $insoniauti);
		$stmt->bindParam(':exerciciosprogramados'         , $exerciciosprogramados);
		$stmt->bindParam(':vezesexercicios'               , $vezesexercicios);
		$stmt->bindParam(':recreacaolazer'                , $recreacaolazer);
		$stmt->bindParam(':recreacaolazeroutros'          , $recreacaolazeroutros);
		$stmt->bindParam(':comerfrequencia'               , $comerfrequencia);
		$stmt->bindParam(':numerorefeicoes'            	  , $numerorefeicoes);
		$stmt->bindParam(':comerfrequenciaoutros'         , $comerfrequenciaoutros);
		$stmt->bindParam(':eliminacaourinaria'            , $eliminacaourinaria);
		$stmt->bindParam(':eliminacaointestinal'          , $eliminacaointestinal);
		$stmt->bindParam(':eliminacaointestinalfrequencia', $eliminacaointestinalfrequencia);
		$stmt->bindParam(':ciclomenstrual'                , $ciclomenstrual);
		$stmt->bindParam(':ciclomenstrualoutros'          , $ciclomenstrualoutros);
		$stmt->bindParam(':atividadesexual'            	  , $atividadesexual);
		$stmt->bindParam(':atividadesexualoutros'         , $atividadesexualoutros);
			
		if($stmt->execute()){
			//Retorno o ID da Anamnese
			echo $idanamnese;
		}else{
			echo 'ERRO';
		}
	}
?>