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
		
		$conn = getConnection();
		
		$sql = 'UPDATE anamneseexameorgaossistemas SET 
		                                   pressao = :pressao,
										   pulso = :pulso,
										   frequenciacardiaca = :frequenciacardiaca,
										   temperatura = :temperatura,
										   frequenciarespiratoria = :frequenciarespiratoria,
										   peso = :peso,
										   altura = :altura,
										   nutricao = :nutricao,
										   nutricaooutros = :nutricaooutros,
										   consciencia = :consciencia,
										   conscienciaoutros = :conscienciaoutros,
										   movimentacao = :movimentacao,
										   movimentacaooutros = :movimentacaooutros,
										   peletecidos = :peletecidos,
										   peletecidosoutros = :peletecidosoutros,
										   cranio = :cranio,
										   craniooutros = :craniooutros,
										   olhos = :olhos,
										   olhosoutros = :olhosoutros,
										   ouvidos = :ouvidos,
										   ouvidosoutros = :ouvidosoutros,
										   nariz = :nariz,
										   narizoutros = :narizoutros,
										   boca = :boca,
										   bocaoutros = :bocaoutros,
										   pescoco = :pescoco,
										   pescocooutros = :pescocooutros,
										   torax = :torax,
										   toraxoutros = :toraxoutros,
										   mamas = :mamas,
										   mamasoutros = :mamasoutros,
										   ausculta = :ausculta,
										   auscultaoutros = :auscultaoutros,
										   oxigenacao = :oxigenacao,
										   oxigenacaooutros = :oxigenacaooutros,
										   coracao = :coracao,
										   coracaooutros = :coracaooutros,
										   precordio = :precordio,
										   precordiooutros = :precordiooutros,
										   abdome = :abdome,
										   abdomeoutros = :abdomeoutros,
										   geniturinario = :geniturinario,
										   geniturinariooutros = :geniturinariooutros,
										   membrossuperiores = :membrossuperiores,
										   membrossuperioresoutros = :membrossuperioresoutros,
										   membrosinferiores = :membrosinferiores,
										   membrosinferioresoutros = :membrosinferioresoutros,
										   medicamentoscasa = :medicamentoscasa,
										   exames = :exames,
										   outrasqueixas = :outrasqueixas
										   WHERE idanamnese = :idanamnese';
           
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(':idanamnese'             , $idanamnese);
		$stmt->bindParam(':pressao'                , $pressao);
		$stmt->bindParam(':pulso'                  , $pulso);
		$stmt->bindParam(':frequenciacardiaca'     , $frequenciacardiaca);
		$stmt->bindParam(':temperatura'            , $temperatura);
		$stmt->bindParam(':frequenciarespiratoria' , $frequenciarespiratoria);
		$stmt->bindParam(':peso'                   , $peso);
		$stmt->bindParam(':altura'                 , $altura);
		$stmt->bindParam(':nutricao'               , $nutricao);
		$stmt->bindParam(':nutricaooutros'         , $nutricaooutros);
		$stmt->bindParam(':consciencia'            , $consciencia);
		$stmt->bindParam(':conscienciaoutros'      , $conscienciaoutros);
		$stmt->bindParam(':movimentacao'           , $movimentacao);
		$stmt->bindParam(':movimentacaooutros'     , $movimentacaooutros);
		$stmt->bindParam(':peletecidos'            , $peletecidos);
		$stmt->bindParam(':peletecidosoutros'      , $peletecidosoutros);
		$stmt->bindParam(':cranio'                 , $cranio);
		$stmt->bindParam(':craniooutros'           , $craniooutros);
		$stmt->bindParam(':olhos'                  , $olhos);
		$stmt->bindParam(':olhosoutros'            , $olhosoutros);
		$stmt->bindParam(':ouvidos'                , $ouvidos);
		$stmt->bindParam(':ouvidosoutros'          , $ouvidosoutros);
		$stmt->bindParam(':nariz'                  , $nariz);
		$stmt->bindParam(':narizoutros'            , $narizoutros);
		$stmt->bindParam(':boca'                   , $boca);
		$stmt->bindParam(':bocaoutros'             , $bocaoutros);
		$stmt->bindParam(':pescoco'                , $pescoco);
		$stmt->bindParam(':pescocooutros'          , $pescocooutros);
		$stmt->bindParam(':torax'                  , $torax);
		$stmt->bindParam(':toraxoutros'            , $toraxoutros);
		$stmt->bindParam(':mamas'                  , $mamas);
		$stmt->bindParam(':mamasoutros'            , $mamasoutros);
		$stmt->bindParam(':ausculta'               , $ausculta);
		$stmt->bindParam(':auscultaoutros'         , $auscultaoutros);
		$stmt->bindParam(':oxigenacao'             , $oxigenacao);
		$stmt->bindParam(':oxigenacaooutros'       , $oxigenacaooutros);
		$stmt->bindParam(':coracao'                , $coracao);
		$stmt->bindParam(':coracaooutros'          , $coracaooutros);
		$stmt->bindParam(':precordio'              , $precordio);
		$stmt->bindParam(':precordiooutros'        , $precordiooutros);
		$stmt->bindParam(':abdome'                 , $abdome);
		$stmt->bindParam(':abdomeoutros'           , $abdomeoutros);
		$stmt->bindParam(':geniturinario'          , $geniturinario);
		$stmt->bindParam(':geniturinariooutros'    , $geniturinariooutros);
		$stmt->bindParam(':membrossuperiores'      , $membrossuperiores);
		$stmt->bindParam(':membrossuperioresoutros', $membrossuperioresoutros);
		$stmt->bindParam(':membrosinferiores'      , $membrosinferiores);
		$stmt->bindParam(':membrosinferioresoutros', $membrosinferioresoutros);
		$stmt->bindParam(':medicamentoscasa'       , $medicamentoscasa);
		$stmt->bindParam(':exames'                 , $exames);
		$stmt->bindParam(':outrasqueixas'          , $outrasqueixas);
			
		if($stmt->execute()){
			//Retorno o ID da Anamnese
			echo $idanamnese;
		}else{
			echo 'ERRO';
		}
	}
?>