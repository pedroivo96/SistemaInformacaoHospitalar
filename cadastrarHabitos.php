<?php
	include './conexao.php';
	
	if(!empty($_POST)){
		
		$idanamnese = $_POST['idanamnese'];
		
		$condicoesmoradia = "";
		if(isset($_POST['condicoesmoradia1'])){ $condicoesmoradia = $condicoesmoradia . $_POST['condicoesmoradia1']; }
		if(isset($_POST['condicoesmoradia2'])){ $condicoesmoradia = $condicoesmoradia . $_POST['condicoesmoradia2']; }
		if(isset($_POST['condicoesmoradia3'])){ $condicoesmoradia = $condicoesmoradia . $_POST['condicoesmoradia3']; }
		if(isset($_POST['condicoesmoradia4'])){ $condicoesmoradia = $condicoesmoradia . $_POST['condicoesmoradia4']; }
		if(isset($_POST['condicoesmoradia5'])){ $condicoesmoradia = $condicoesmoradia . $_POST['condicoesmoradia5']; }
		if(isset($_POST['condicoesmoradia6'])){ $condicoesmoradia = $condicoesmoradia . $_POST['condicoesmoradia6']; }
		
		$condicoesmoradiaoutros = $_POST['condicoesmoradiaoutros'];
		
		$cuidadocorporal = "";
		if(isset($_POST['cuidadocorporal1'])){ $cuidadocorporal = $cuidadocorporal . $_POST['cuidadocorporal1']; }
		if(isset($_POST['cuidadocorporal2'])){ $cuidadocorporal = $cuidadocorporal . $_POST['cuidadocorporal2']; }
		if(isset($_POST['cuidadocorporal3'])){ $cuidadocorporal = $cuidadocorporal . $_POST['cuidadocorporal3']; }
		if(isset($_POST['cuidadocorporal4'])){ $cuidadocorporal = $cuidadocorporal . $_POST['cuidadocorporal4']; }
		if(isset($_POST['cuidadocorporal5'])){ $cuidadocorporal = $cuidadocorporal . $_POST['cuidadocorporal5']; }
		if(isset($_POST['cuidadocorporal6'])){ $cuidadocorporal = $cuidadocorporal . $_POST['cuidadocorporal6']; }
		
		$periodobanho = "";
		if(isset($_POST['periodobanho1'])){ $periodobanho = $periodobanho . $_POST['periodobanho1']; }
		if(isset($_POST['periodobanho2'])){ $periodobanho = $periodobanho . $_POST['periodobanho2']; }
		if(isset($_POST['periodobanho3'])){ $periodobanho = $periodobanho . $_POST['periodobanho3']; }
		
		$atividadetrabalho = "";
		if(isset($_POST['atividadetrabalho1'])){ $atividadetrabalho = $atividadetrabalho . $_POST['atividadetrabalho1']; }
		if(isset($_POST['atividadetrabalho2'])){ $atividadetrabalho = $atividadetrabalho . $_POST['atividadetrabalho2']; }
		if(isset($_POST['atividadetrabalho3'])){ $atividadetrabalho = $atividadetrabalho . $_POST['atividadetrabalho3']; }
		
		$atividadetrabalhooutros = $_POST['atividadetrabalhooutros'];
		
		$sonorepouso = "";
		if(isset($_POST['sonorepouso1'])){ $sonorepouso = $sonorepouso . $_POST['sonorepouso1']; }
		if(isset($_POST['sonorepouso2'])){ $sonorepouso = $sonorepouso . $_POST['sonorepouso2']; }
		if(isset($_POST['sonorepouso3'])){ $sonorepouso = $sonorepouso . $_POST['sonorepouso3']; }
		if(isset($_POST['sonorepouso4'])){ $sonorepouso = $sonorepouso . $_POST['sonorepouso4']; }
		
		$horasdormidas = $_POST['horasdormidas'];
		$insoniauti    = $_POST['insoniauti'];
		
		$exerciciosprogramados = "";
		if(isset($_POST['exerciciosprogramados1'])){ $exerciciosprogramados = $exerciciosprogramados . $_POST['exerciciosprogramados1']; }
		if(isset($_POST['exerciciosprogramados2'])){ $exerciciosprogramados = $exerciciosprogramados . $_POST['exerciciosprogramados2']; }
		if(isset($_POST['exerciciosprogramados3'])){ $exerciciosprogramados = $exerciciosprogramados . $_POST['exerciciosprogramados3']; }
		if(isset($_POST['exerciciosprogramados4'])){ $exerciciosprogramados = $exerciciosprogramados . $_POST['exerciciosprogramados4']; }
		
		$vezesexercicios = $_POST['vezesexercicios'];
		
		$recreacaolazer = "";
		if(isset($_POST['recreacaolazer1'])){ $recreacaolazer = $recreacaolazer . $_POST['recreacaolazer1']; }
		if(isset($_POST['recreacaolazer2'])){ $recreacaolazer = $recreacaolazer . $_POST['recreacaolazer2']; }
		if(isset($_POST['recreacaolazer3'])){ $recreacaolazer = $recreacaolazer . $_POST['recreacaolazer3']; }
		if(isset($_POST['recreacaolazer4'])){ $recreacaolazer = $recreacaolazer . $_POST['recreacaolazer4']; }
		if(isset($_POST['recreacaolazer5'])){ $recreacaolazer = $recreacaolazer . $_POST['recreacaolazer5']; }
		
		$recreacaolazeroutros = $_POST['recreacaolazeroutros'];
		
		$comerfrequencia = "";
		if(isset($_POST['comerfrequencia1'])){ $comerfrequencia = $comerfrequencia . $_POST['comerfrequencia1']; }
		if(isset($_POST['comerfrequencia2'])){ $comerfrequencia = $comerfrequencia . $_POST['comerfrequencia2']; }
		if(isset($_POST['comerfrequencia3'])){ $comerfrequencia = $comerfrequencia . $_POST['comerfrequencia3']; }
		if(isset($_POST['comerfrequencia4'])){ $comerfrequencia = $comerfrequencia . $_POST['comerfrequencia4']; }
		if(isset($_POST['comerfrequencia5'])){ $comerfrequencia = $comerfrequencia . $_POST['comerfrequencia5']; }
		if(isset($_POST['comerfrequencia6'])){ $comerfrequencia = $comerfrequencia . $_POST['comerfrequencia6']; }
		if(isset($_POST['comerfrequencia7'])){ $comerfrequencia = $comerfrequencia . $_POST['comerfrequencia7']; }
		if(isset($_POST['comerfrequencia8'])){ $comerfrequencia = $comerfrequencia . $_POST['comerfrequencia8']; }
		if(isset($_POST['comerfrequencia9'])){ $comerfrequencia = $comerfrequencia . $_POST['comerfrequencia9']; }
		
		$numerorefeicoes       = $_POST['numerorefeicoes'];
		$comerfrequenciaoutros = $_POST['comerfrequenciaoutros'];
		
		$eliminacaourinaria = "";
		if(isset($_POST['eliminacaourinaria1'])){ $eliminacaourinaria = $eliminacaourinaria . $_POST['eliminacaourinaria1']; }
		if(isset($_POST['eliminacaourinaria2'])){ $eliminacaourinaria = $eliminacaourinaria . $_POST['eliminacaourinaria2']; }
		if(isset($_POST['eliminacaourinaria3'])){ $eliminacaourinaria = $eliminacaourinaria . $_POST['eliminacaourinaria3']; }
		if(isset($_POST['eliminacaourinaria4'])){ $eliminacaourinaria = $eliminacaourinaria . $_POST['eliminacaourinaria4']; }
		if(isset($_POST['eliminacaourinaria5'])){ $eliminacaourinaria = $eliminacaourinaria . $_POST['eliminacaourinaria5']; }
		if(isset($_POST['eliminacaourinaria6'])){ $eliminacaourinaria = $eliminacaourinaria . $_POST['eliminacaourinaria6']; }
		if(isset($_POST['eliminacaourinaria7'])){ $eliminacaourinaria = $eliminacaourinaria . $_POST['eliminacaourinaria7']; }
		
		$eliminacaointestinal = "";
		if(isset($_POST['eliminacaointestinal1'])){ $eliminacaointestinal = $eliminacaointestinal . $_POST['eliminacaointestinal1']; }
		if(isset($_POST['eliminacaointestinal2'])){ $eliminacaointestinal = $eliminacaointestinal . $_POST['eliminacaointestinal2']; }
		if(isset($_POST['eliminacaointestinal3'])){ $eliminacaointestinal = $eliminacaointestinal . $_POST['eliminacaointestinal3']; }
		if(isset($_POST['eliminacaointestinal4'])){ $eliminacaointestinal = $eliminacaointestinal . $_POST['eliminacaointestinal4']; }
		
		$eliminacaointestinalfrequencia = $_POST['eliminacaointestinalfrequencia'];
		
		$ciclomenstrual = "";
		if(isset($_POST['ciclomenstrual1'])){ $ciclomenstrual = $ciclomenstrual . $_POST['ciclomenstrual1']; }
		if(isset($_POST['ciclomenstrual2'])){ $ciclomenstrual = $ciclomenstrual . $_POST['ciclomenstrual2']; }
		if(isset($_POST['ciclomenstrual3'])){ $ciclomenstrual = $ciclomenstrual . $_POST['ciclomenstrual3']; }
		if(isset($_POST['ciclomenstrual4'])){ $ciclomenstrual = $ciclomenstrual . $_POST['ciclomenstrual4']; }
		
		$ciclomenstrualoutros = $_POST['ciclomenstrualoutros'];
		
		$atividadesexual = "";
		if(isset($_POST['atividadesexual1'])){ $atividadesexual = $atividadesexual . $_POST['atividadesexual1']; }
		if(isset($_POST['atividadesexual2'])){ $atividadesexual = $atividadesexual . $_POST['atividadesexual2']; }
		if(isset($_POST['atividadesexual3'])){ $atividadesexual = $atividadesexual . $_POST['atividadesexual3']; }
		
		$atividadesexualoutros = $_POST['atividadesexualoutros'];
		
		$conn = getConnection();
		
		$sql = 'INSERT INTO anamnesehabitos (idanamnese, 
			                                 condicoesmoradia, 
											 condicoesmoradiaoutros, 
											 cuidadocorporal, 
											 periodobanho, 
											 atividadetrabalho, 
											 atividadetrabalhooutros,
											 sonorepouso,
											 horasdormidas,
											 insoniauti,
											 exerciciosprogramados,
											 vezesexercicios,
											 recreacaolazer,
											 recreacaolazeroutros,
											 comerfrequencia,
											 numerorefeicoes,
											 comerfrequenciaoutros,
											 eliminacaourinaria,
											 eliminacaointestinal,
											 eliminacaointestinalfrequencia,
											 ciclomenstrual,
											 ciclomenstrualoutros,
											 atividadesexual,
											 atividadesexualoutros) VALUES(:idanamnese,
											                               :condicoesmoradia,
																		   :condicoesmoradiaoutros,
																           :cuidadocorporal,
																           :periodobanho,
																           :atividadetrabalho,
																           :atividadetrabalhooutros,
																           :sonorepouso,
																           :horasdormidas,
																           :insoniauti,
																           :exerciciosprogramados,
																           :vezesexercicios,
																           :recreacaolazer,
																           :recreacaolazeroutros,
																           :comerfrequencia,
																           :numerorefeicoes,
																           :comerfrequenciaoutros,
																           :eliminacaourinaria,
																           :eliminacaointestinal,
																           :eliminacaointestinalfrequencia,
																           :ciclomenstrual,
																           :ciclomenstrualoutros,
																           :atividadesexual,
																           :atividadesexualoutros)';
           
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
		$stmt->bindParam(':numerorefeicoes'               , $numerorefeicoes);
		$stmt->bindParam(':comerfrequenciaoutros'         , $comerfrequenciaoutros);
		$stmt->bindParam(':eliminacaourinaria'            , $eliminacaourinaria);
		$stmt->bindParam(':eliminacaointestinal'          , $eliminacaointestinal);
		$stmt->bindParam(':eliminacaointestinalfrequencia', $eliminacaointestinalfrequencia);
		$stmt->bindParam(':ciclomenstrual'                , $ciclomenstrual);
		$stmt->bindParam(':ciclomenstrualoutros'          , $ciclomenstrualoutros);
		$stmt->bindParam(':atividadesexual'               , $atividadesexual);
		$stmt->bindParam(':atividadesexualoutros'         , $atividadesexualoutros);
			
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