<?php
	include './conexao.php';
	
	if(!empty($_POST)){
		
		$idanamnese = $_POST['idanamnese'];
		
		$pressao                = $_POST['pressao'];
		$pulso                  = $_POST['pulso'];
		$frequenciacardiaca     = $_POST['frequenciacardiaca'];
		$temperatura            = $_POST['temperatura'];
		$frequenciarespiratoria = $_POST['frequenciarespiratoria'];
		$peso                   = $_POST['peso'];
		$altura                 = $_POST['altura'];
		
		$nutricao = "";
		if(isset($_POST['nutricao1'])){ $nutricao = $nutricao . $_POST['nutricao1']; }
		if(isset($_POST['nutricao2'])){ $nutricao = $nutricao . $_POST['nutricao2']; }
		if(isset($_POST['nutricao3'])){ $nutricao = $nutricao . $_POST['nutricao3']; }
		if(isset($_POST['nutricao4'])){ $nutricao = $nutricao . $_POST['nutricao4']; }
		
		$nutricaooutros = $_POST['nutricaooutros'];
		
		$consciencia = "";
		if(isset($_POST['consciencia1'])){ $consciencia = $consciencia . $_POST['consciencia1']; }
		if(isset($_POST['consciencia2'])){ $consciencia = $consciencia . $_POST['consciencia2']; }
		if(isset($_POST['consciencia3'])){ $consciencia = $consciencia . $_POST['consciencia3']; }
		if(isset($_POST['consciencia4'])){ $consciencia = $consciencia . $_POST['consciencia4']; }
		if(isset($_POST['consciencia5'])){ $consciencia = $consciencia . $_POST['consciencia5']; }
		if(isset($_POST['consciencia6'])){ $consciencia = $consciencia . $_POST['consciencia6']; }
		if(isset($_POST['consciencia7'])){ $consciencia = $consciencia . $_POST['consciencia7']; }
		
		$conscienciaoutros = $_POST['conscienciaoutros'];
		
		$movimentacao = "";
		if(isset($_POST['movimentacao1'])){ $movimentacao = $movimentacao . $_POST['movimentacao1']; }
		if(isset($_POST['movimentacao2'])){ $movimentacao = $movimentacao . $_POST['movimentacao2']; }
		if(isset($_POST['movimentacao3'])){ $movimentacao = $movimentacao . $_POST['movimentacao3']; }
		if(isset($_POST['movimentacao4'])){ $movimentacao = $movimentacao . $_POST['movimentacao4']; }
		if(isset($_POST['movimentacao5'])){ $movimentacao = $movimentacao . $_POST['movimentacao5']; }
		if(isset($_POST['movimentacao6'])){ $movimentacao = $movimentacao . $_POST['movimentacao6']; }
		if(isset($_POST['movimentacao7'])){ $movimentacao = $movimentacao . $_POST['movimentacao7']; }
		
		$movimentacaooutros = $_POST['movimentacaooutros'];
		
		$peletecidos = "";
		if(isset($_POST['peletecidos1'])){ $peletecidos = $peletecidos . $_POST['peletecidos1']; }
		if(isset($_POST['peletecidos2'])){ $peletecidos = $peletecidos . $_POST['peletecidos2']; }
		if(isset($_POST['peletecidos3'])){ $peletecidos = $peletecidos . $_POST['peletecidos3']; }
		if(isset($_POST['peletecidos4'])){ $peletecidos = $peletecidos . $_POST['peletecidos4']; }
		if(isset($_POST['peletecidos5'])){ $peletecidos = $peletecidos . $_POST['peletecidos5']; }
		if(isset($_POST['peletecidos6'])){ $peletecidos = $peletecidos . $_POST['peletecidos6']; }
		if(isset($_POST['peletecidos7'])){ $peletecidos = $peletecidos . $_POST['peletecidos7']; }
		if(isset($_POST['peletecidos8'])){ $peletecidos = $peletecidos . $_POST['peletecidos8']; }
		
		$peletecidosoutros = $_POST['peletecidosoutros'];
		
		$cranio = "";
		if(isset($_POST['cranio1'])){ $cranio = $cranio . $_POST['cranio1']; }
		if(isset($_POST['cranio2'])){ $cranio = $cranio . $_POST['cranio2']; }
		if(isset($_POST['cranio3'])){ $cranio = $cranio . $_POST['cranio3']; }
		if(isset($_POST['cranio4'])){ $cranio = $cranio . $_POST['cranio4']; }
		if(isset($_POST['cranio5'])){ $cranio = $cranio . $_POST['cranio5']; }
		
		$craniooutros = $_POST['craniooutros'];
		
		$olhos = "";
		if(isset($_POST['olhos1'])){ $olhos = $olhos . $_POST['olhos1']; }
		if(isset($_POST['olhos2'])){ $olhos = $olhos . $_POST['olhos2']; }
		if(isset($_POST['olhos3'])){ $olhos = $olhos . $_POST['olhos3']; }
		if(isset($_POST['olhos4'])){ $olhos = $olhos . $_POST['olhos4']; }
		if(isset($_POST['olhos5'])){ $olhos = $olhos . $_POST['olhos5']; }
		if(isset($_POST['olhos6'])){ $olhos = $olhos . $_POST['olhos6']; }
		
		$olhosoutros = $_POST['olhosoutros'];
		
		$ouvidos = "";
		if(isset($_POST['ouvidos1'])){ $ouvidos = $ouvidos . $_POST['ouvidos1']; }
		if(isset($_POST['ouvidos2'])){ $ouvidos = $ouvidos . $_POST['ouvidos2']; }
		if(isset($_POST['ouvidos3'])){ $ouvidos = $ouvidos . $_POST['ouvidos3']; }
		if(isset($_POST['ouvidos4'])){ $ouvidos = $ouvidos . $_POST['ouvidos4']; }
		if(isset($_POST['ouvidos5'])){ $ouvidos = $ouvidos . $_POST['ouvidos5']; }
		
		$ouvidosoutros = $_POST['ouvidosoutros'];
		
		$nariz = "";
		if(isset($_POST['nariz1'])){ $nariz = $nariz . $_POST['nariz1']; }
		if(isset($_POST['nariz2'])){ $nariz = $nariz . $_POST['nariz2']; }
		if(isset($_POST['nariz3'])){ $nariz = $nariz . $_POST['nariz3']; }
		if(isset($_POST['nariz4'])){ $nariz = $nariz . $_POST['nariz4']; }
		
		$narizoutros = $_POST['narizoutros'];
		
		$boca = "";
		if(isset($_POST['boca1'])){ $boca = $boca . $_POST['boca1']; }
		if(isset($_POST['boca2'])){ $boca = $boca . $_POST['boca2']; }
		if(isset($_POST['boca3'])){ $boca = $boca . $_POST['boca3']; }
		if(isset($_POST['boca4'])){ $boca = $boca . $_POST['boca4']; }
		if(isset($_POST['boca5'])){ $boca = $boca . $_POST['boca5']; }
		if(isset($_POST['boca6'])){ $boca = $boca . $_POST['boca6']; }
		
		$bocaoutros = $_POST['bocaoutros'];
		
		$pescoco = "";
		if(isset($_POST['pescoco1'])){ $pescoco = $pescoco . $_POST['pescoco1']; }
		if(isset($_POST['pescoco2'])){ $pescoco = $pescoco . $_POST['pescoco2']; }
		if(isset($_POST['pescoco3'])){ $pescoco = $pescoco . $_POST['pescoco3']; }
		if(isset($_POST['pescoco4'])){ $pescoco = $pescoco . $_POST['pescoco4']; }
		if(isset($_POST['pescoco5'])){ $pescoco = $pescoco . $_POST['pescoco5']; }
		
		$pescocooutros = $_POST['pescocooutros'];
		
		$torax = "";
		if(isset($_POST['torax1'])){ $torax = $torax . $_POST['torax1']; }
		if(isset($_POST['torax2'])){ $torax = $torax . $_POST['torax2']; }
		if(isset($_POST['torax3'])){ $torax = $torax . $_POST['torax3']; }
		if(isset($_POST['torax4'])){ $torax = $torax . $_POST['torax4']; }
		if(isset($_POST['torax5'])){ $torax = $torax . $_POST['torax5']; }
		
		$toraxoutros = $_POST['toraxoutros'];
		
		$mamas = "";
		if(isset($_POST['mamas1'])){ $mamas = $mamas . $_POST['mamas1']; }
		if(isset($_POST['mamas2'])){ $mamas = $mamas . $_POST['mamas2']; }
		if(isset($_POST['mamas3'])){ $mamas = $mamas . $_POST['mamas3']; }
		if(isset($_POST['mamas4'])){ $mamas = $mamas . $_POST['mamas4']; }
		if(isset($_POST['mamas5'])){ $mamas = $mamas . $_POST['mamas5']; }
		
		$mamasoutros = $_POST['mamasoutros'];
		
		$ausculta = "";
		if(isset($_POST['ausculta1'])){ $ausculta = $ausculta . $_POST['ausculta1']; }
		if(isset($_POST['ausculta2'])){ $ausculta = $ausculta . $_POST['ausculta2']; }
		if(isset($_POST['ausculta3'])){ $ausculta = $ausculta . $_POST['ausculta3']; }
		if(isset($_POST['ausculta4'])){ $ausculta = $ausculta . $_POST['ausculta4']; }
		if(isset($_POST['ausculta5'])){ $ausculta = $ausculta . $_POST['ausculta5']; }
		
		$auscultaoutros = $_POST['auscultaoutros'];
		
		$oxigenacao = "";
		if(isset($_POST['oxigenacao1'])){ $oxigenacao = $oxigenacao . $_POST['oxigenacao1']; }
		if(isset($_POST['oxigenacao2'])){ $oxigenacao = $oxigenacao . $_POST['oxigenacao2']; }
		if(isset($_POST['oxigenacao3'])){ $oxigenacao = $oxigenacao . $_POST['oxigenacao3']; }
		if(isset($_POST['oxigenacao4'])){ $oxigenacao = $oxigenacao . $_POST['oxigenacao4']; }
		if(isset($_POST['oxigenacao5'])){ $oxigenacao = $oxigenacao . $_POST['oxigenacao5']; }
		if(isset($_POST['oxigenacao6'])){ $oxigenacao = $oxigenacao . $_POST['oxigenacao6']; }
		
		$oxigenacaooutros = $_POST['oxigenacaooutros'];
		
		$coracao = "";
		if(isset($_POST['coracao1'])){ $coracao = $coracao . $_POST['coracao1']; }
		if(isset($_POST['coracao2'])){ $coracao = $coracao . $_POST['coracao2']; }
		if(isset($_POST['coracao3'])){ $coracao = $coracao . $_POST['coracao3']; }
		if(isset($_POST['coracao4'])){ $coracao = $coracao . $_POST['coracao4']; }
		if(isset($_POST['coracao5'])){ $coracao = $coracao . $_POST['coracao5']; }
		if(isset($_POST['coracao6'])){ $coracao = $coracao . $_POST['coracao6']; }
		
		$coracaooutros = $_POST['coracaooutros'];
		
		$precordio = "";
		if(isset($_POST['precordio1'])){ $precordio = $precordio . $_POST['precordio1']; }
		if(isset($_POST['precordio2'])){ $precordio = $precordio . $_POST['precordio2']; }
		
		$precordiooutros = $_POST['precordiooutros'];
		
		$abdome = "";
		if(isset($_POST['abdome1'])){  $abdome = $abdome . $_POST['abdome1']; }
		if(isset($_POST['abdome2'])){  $abdome = $abdome . $_POST['abdome2']; }
		if(isset($_POST['abdome3'])){  $abdome = $abdome . $_POST['abdome3']; }
		if(isset($_POST['abdome4'])){  $abdome = $abdome . $_POST['abdome4']; }
		if(isset($_POST['abdome5'])){  $abdome = $abdome . $_POST['abdome5']; }
		if(isset($_POST['abdome6'])){  $abdome = $abdome . $_POST['abdome6']; }
		if(isset($_POST['abdome7'])){  $abdome = $abdome . $_POST['abdome7']; }
		if(isset($_POST['abdome8'])){  $abdome = $abdome . $_POST['abdome8']; }
		if(isset($_POST['abdome9'])){  $abdome = $abdome . $_POST['abdome9']; }
		if(isset($_POST['abdome10'])){ $abdome = $abdome . $_POST['abdome10']; }
		if(isset($_POST['abdome11'])){ $abdome = $abdome . $_POST['abdome11']; }
		if(isset($_POST['abdome12'])){ $abdome = $abdome . $_POST['abdome12']; }
		
		$abdomeoutros = $_POST['abdomeoutros'];
		
		$geniturinario = "";
		if(isset($_POST['geniturinario1'])){ $geniturinario = $geniturinario . $_POST['geniturinario1']; }
		if(isset($_POST['geniturinario2'])){ $geniturinario = $geniturinario . $_POST['geniturinario2']; }
		if(isset($_POST['geniturinario3'])){ $geniturinario = $geniturinario . $_POST['geniturinario3']; }
		if(isset($_POST['geniturinario4'])){ $geniturinario = $geniturinario . $_POST['geniturinario4']; }
		if(isset($_POST['geniturinario5'])){ $geniturinario = $geniturinario . $_POST['geniturinario5']; }
		if(isset($_POST['geniturinario6'])){ $geniturinario = $geniturinario . $_POST['geniturinario6']; }
		if(isset($_POST['geniturinario7'])){ $geniturinario = $geniturinario . $_POST['geniturinario7']; }
		
		$geniturinariooutros = $_POST['geniturinariooutros'];
		
		$membrossuperiores = "";
		if(isset($_POST['membrossuperiores1'])){  $membrossuperiores = $membrossuperiores . $_POST['membrossuperiores1']; }
		if(isset($_POST['membrossuperiores2'])){  $membrossuperiores = $membrossuperiores . $_POST['membrossuperiores2']; }
		if(isset($_POST['membrossuperiores3'])){  $membrossuperiores = $membrossuperiores . $_POST['membrossuperiores3']; }
		if(isset($_POST['membrossuperiores4'])){  $membrossuperiores = $membrossuperiores . $_POST['membrossuperiores4']; }
		if(isset($_POST['membrossuperiores5'])){  $membrossuperiores = $membrossuperiores . $_POST['membrossuperiores5']; }
		if(isset($_POST['membrossuperiores6'])){  $membrossuperiores = $membrossuperiores . $_POST['membrossuperiores6']; }
		if(isset($_POST['membrossuperiores7'])){  $membrossuperiores = $membrossuperiores . $_POST['membrossuperiores7']; }
		if(isset($_POST['membrossuperiores8'])){  $membrossuperiores = $membrossuperiores . $_POST['membrossuperiores8']; }
		if(isset($_POST['membrossuperiores9'])){  $membrossuperiores = $membrossuperiores . $_POST['membrossuperiores9']; }
		if(isset($_POST['membrossuperiores10'])){ $membrossuperiores = $membrossuperiores . $_POST['membrossuperiores10']; }
		
		$membrossuperioresoutros = $_POST['membrossuperioresoutros'];
		
		$membrosinferiores = "";
		if(isset($_POST['membrosinferiores1'])){   $membrosinferiores = $membrosinferiores . $_POST['membrosinferiores1']; }
		if(isset($_POST['membrosinferiores2'])){   $membrosinferiores = $membrosinferiores . $_POST['membrosinferiores2']; }
		if(isset($_POST['membrosinferiores3'])){   $membrosinferiores = $membrosinferiores . $_POST['membrosinferiores3']; }
		if(isset($_POST['membrosinferiores4'])){   $membrosinferiores = $membrosinferiores . $_POST['membrosinferiores4']; }
		if(isset($_POST['membrosinferiores5'])){   $membrosinferiores = $membrosinferiores . $_POST['membrosinferiores5']; }
		if(isset($_POST['membrosinferiores6'])){   $membrosinferiores = $membrosinferiores . $_POST['membrosinferiores6']; }
		if(isset($_POST['membrosinferiores7'])){   $membrosinferiores = $membrosinferiores . $_POST['membrosinferiores7']; }
		if(isset($_POST['membrosinferiores8'])){   $membrosinferiores = $membrosinferiores . $_POST['membrosinferiores8']; }
		if(isset($_POST['membrosinferiores9'])){   $membrosinferiores = $membrosinferiores . $_POST['membrosinferiores9']; }
		if(isset($_POST['membrosinferiores10'])){  $membrosinferiores = $membrosinferiores . $_POST['membrosinferiores10']; }
		
		$membrosinferioresoutros = $_POST['membrosinferioresoutros'];
		
		$medicamentoscasa = $_POST['medicamentoscasa'];
		$exames           = $_POST['exames'];
		$outrasqueixas    = $_POST['outrasqueixas'];
		
		$sql = 'INSERT INTO anamnesehabitos (idanamnese,
											 pressao,
											 pulso,
											 frequenciacardiaca,
											 temperatura,
											 frequenciarespiratoria,
											 peso,
											 altura,
											 nutricao,
											 nutricaooutros,
											 consciencia,
											 conscienciaoutros,
											 movimentacao,
											 movimentacaooutros,
											 peletecidos,
											 peletecidosoutros,
											 cranio,
											 craniooutros,
											 olhos,
											 olhosoutros,
											 ouvidos,
											 ouvidosoutros,
											 nariz,
											 narizoutros,
											 boca,
											 bocaoutros,
											 pescoco,
											 pescocooutros,
											 torax,
											 toraxoutros,
											 mamas,
											 mamasoutros,
											 ausculta,
											 auscultaoutros,
											 oxigenacao,
											 oxigenacaooutros,
											 coracao,
											 coracaooutros,
											 precordio,
											 precordiooutros,
											 abdome,
											 abdomeoutros,
											 geniturinario,
											 geniturinariooutros,
											 membrossuperiores,
											 membrossuperioresoutros,
											 membrosinferiores,
											 membrosinferioresoutros,
											 medicamentoscasa,
											 exames,
											 outrasqueixas) VALUES(:idanamnese,
											                    :pressao,
																:pulso,
																:frequenciacardiaca,
																:temperatura,
																:frequenciarespiratoria,
																:peso,
																:altura,
																:nutricao,
																:nutricaooutros,
																:consciencia,
																:conscienciaoutros,
																:movimentacao,
																:movimentacaooutros,
																:peletecidos,
																:peletecidosoutros,
																:cranio,
																:craniooutros,
																:olhos,
																:olhosoutros,
																:ouvidos,
																:ouvidosoutros,
																:nariz,
																:narizoutros,
																:boca,
																:bocaoutros,
																:pescoco,
																:pescocooutros,
																:torax,
																:toraxoutros,
																:mamas,
																:mamasoutros,
																:ausculta,
																:auscultaoutros,
																:oxigenacao,
																:oxigenacaooutros,
																:coracao,
																:coracaooutros,
																:precordio,
																:precordiooutros,
																:abdome,
																:abdomeoutros,
																:geniturinario,
																:geniturinariooutros,
																:membrossuperiores,
																:membrossuperioresoutros,
																:membrosinferiores,
																:membrosinferioresoutros,
																:medicamentoscasa,
																:exames,
																:outrasqueixas)';
           
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