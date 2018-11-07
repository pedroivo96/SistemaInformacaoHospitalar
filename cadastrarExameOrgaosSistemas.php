<?php
	include './conexao.php';
	
	if(!empty($_POST)){
		
		$idanamnese              = $_POST['idanamnese'];
		$pressao                 = $_POST['pressao'];
		$pulso                   = $_POST['pulso'];
		$frequenciacardiaca      = $_POST['frequenciacardiaca'];
		$temperatura             = $_POST['temperatura'];
		$frequenciarespiratoria  = $_POST['frequenciarespiratoria'];
		$peso                    = $_POST['peso'];
		$altura                  = $_POST['altura'];
		$nutricao                = $_POST['nutricao'];
		$nutricaooutros          = $_POST['nutricaooutros'];
		$consciencia             = $_POST['consciencia'];
		$conscienciaoutros       = $_POST['conscienciaoutros'];
		$movimentacao            = $_POST['movimentacao'];
		$movimentacaooutros      = $_POST['movimentacaooutros'];
		$peletecidos             = $_POST['peletecidos'];
		$peletecidosoutros       = $_POST['peletecidosoutros'];
		$cranio                  = $_POST['cranio'];
		$craniooutros            = $_POST['craniooutros'];
		$olhos                   = $_POST['olhos'];
		$olhosoutros             = $_POST['olhosoutros'];
		$ouvidos                 = $_POST['ouvidos'];
		$ouvidosoutros           = $_POST['ouvidosoutros'];
		$nariz                   = $_POST['nariz'];
		$narizoutros             = $_POST['narizoutros'];
		$boca 					 = $_POST['boca'];
		$bocaoutros              = $_POST['bocaoutros'];
		$pescoco                 = $_POST['pescoco'];
		$pescocooutros           = $_POST['pescocooutros'];
		$torax                   = $_POST['torax'];
		$toraxoutros             = $_POST['toraxoutros'];
		$mamas                   = $_POST['mamas'];
		$mamasoutros             = $_POST['mamasoutros'];
		$ausculta                = $_POST['ausculta'];
		$auscultaoutros          = $_POST['auscultaoutros'];
		$oxigenacao              = $_POST['oxigenacao'];
		$oxigenacaooutros        = $_POST['oxigenacaooutros'];
		$coracao                 = $_POST['coracao'];
		$coracaooutros           = $_POST['coracaooutros'];
		$precordio               = $_POST['precordio'];
		$precordiooutros         = $_POST['precordiooutros'];
		$abdome                  = $_POST['abdome'];
		$abdomeoutros            = $_POST['abdomeoutros'];
		$geniturinario           = $_POST['geniturinario'];
		$geniturinariooutros     = $_POST['geniturinariooutros'];
		$membrossuperiores 		 = $_POST['membrossuperiores'];
		$membrossuperioresoutros = $_POST['membrossuperioresoutros'];
		$membrosinferiores       = $_POST['membrosinferiores'];
		$membrosinferioresoutros = $_POST['membrosinferioresoutros'];
		$medicamentoscasa        = $_POST['medicamentoscasa'];
		$exames                  = $_POST['exames'];
		$outrasqueixas           = $_POST['outrasqueixas'];
		
		
		$sql = 'UPDATE anamnesehabitos SET condicoesmoradia = :condicoesmoradia
										   WHERE idanamnese = :idanamnese';
           
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(':idanamnese', $idanamnese);
			
		if($stmt->execute()){
			//Retorno o ID da Anamnese
			echo $idanamnese;
		}else{
			echo 'ERRO';
		}
	}
?>