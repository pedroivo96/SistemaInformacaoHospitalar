<?php
	include './conexao.php';
	
	if(!empty($_POST)){
		 
		$idinternacao           = $_POST['idinternacao'];
		$idanamnese             = $_POST['idanamnese'];
		$motivointernacao       = $_POST['motivointernacao'];
		$doencascronicas        = $_POST['doencascronicas'];
		$tratamentosanteriores  = $_POST['tratamentosanteriores'];
		$fatoresrisco           = $_POST['fatoresrisco'];
		$fatoresriscooutros     = $_POST['fatoresriscooutros'];
		$medicamentosuso        = $_POST['medicamentosuso'];
		$antecedentesfamiliares = $_POST['antecedentesfamiliares'];
		
		$data = time();
		
		$conn = getConnection();
		
		if($idanamnese == "NAO"){
			//Significa que nenhuma Anamnese foi inserida relacionada a este idinternacao
			//Inserir uma nova Anamnese e retornar o ID da mesma
			
			$sql = 'INSERT INTO anamnese (idinternacao, 
			                              cpfprofissional, 
										  data) VALUES (:idinternacao,
										                :cpfprofissional,
														:data)';
														
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':idinternacao'   , $idinternacao);
			$stmt->bindParam(':cpfprofissional', $cpfprofissional);
			$stmt->bindParam(':data'           , $data);
			
			if($stmt->execute()){
				//Retorno o ID da Anamnese
				
				$sql1 = 'INSERT INTO anamneseinformacoesdoencatratamento (idanamnese,
																		  motivointernacao, 
			                                                              doencascronicas, 
											                              tratamentosanteriores, 
											                              fatoresrisco, 
											                              fatoresriscooutros, 
											                              medicamentosuso, 
											                              antecedentesfamiliares) VALUES(:idanamnese,
																		                                 :motivointernacao, 
											                                                             :doencascronicas, 
														                                                 :tratamentosanteriores,
														                                                 :fatoresrisco,
														                                                 :fatoresriscooutros,
														                                                 :medicamentosuso,
														                                                 :antecedentesfamiliares)';
           
				$stmt1 = $conn->prepare($sql1);
				$stmt1->bindParam(':idanamnese'            , $idanamnese);
				$stmt1->bindParam(':motivointernacao'      , $motivointernacao);
				$stmt1->bindParam(':doencascronicas'       , $doencascronicas);
				$stmt1->bindParam(':tratamentosanteriores' , $tratamentosanteriores);
				$stmt1->bindParam(':fatoresrisco'          , $fatoresrisco);
				$stmt1->bindParam(':fatoresriscooutros'    , $fatoresriscooutros);
				$stmt1->bindParam(':medicamentosuso'       , $medicamentosuso);
				$stmt1->bindParam(':antecedentesfamiliares', $antecedentesfamiliares);
				$stmt1->bindParam(':idanamnese'            , $idanamnese);
			
				if($stmt1->execute()){
					//Retorno o ID da Anamnese
					
					$idanamnese = $conn->lastInsertId();
					
					//Criar os registros referentes às outras sessões da Anamnese
			
					//Tabelas Hábitos
					$sql2 = 'INSERT INTO anamnesehabitos idanamnese VALUES :idanamnese';
														
					$stmt2 = $conn->prepare($sql2);
					$stmt2->bindParam(':idanamnese', $idanamnese);
			
					if($stmt2->execute()){
				
					}
					else{
						echo 'ERRO';
					}
			
					//Tabela Exame Física, órgãos e sistemas
					$sql3 = 'INSERT INTO anamneseexameorgaossistemas idanamnese VALUES :idanamnese';
														
					$stmt3 = $conn->prepare($sql3);
					$stmt3->bindParam(':idanamnese', $idanamnese);
			
					if($stmt3->execute()){
				
					}
					else{
						echo 'ERRO';
					}
			
					//Tabela Psicossocial
					$sql4 = 'INSERT INTO anamnesepsicossocial idanamnese VALUES :idanamnese';
														
					$stmt4 = $conn->prepare($sql4);
					$stmt4->bindParam(':idanamnese', $idanamnese);
			
					if($stmt4->execute()){
				
					}
					else{
						echo 'ERRO';
					}
			
					//Tabela Dados especificados
					$sql5 = 'INSERT INTO anamnesedadosespecificados idanamnese VALUES :idanamnese';
														
					$stmt5 = $conn->prepare($sql5);
					$stmt5->bindParam(':idanamnese', $idanamnese);
			
					if($stmt5->execute()){
				
					}
					else{
						echo 'ERRO';
					}
					
					echo $idanamnese;
					
				}else{
					echo 'ERRO';
				}
			}else{
				echo 'ERRO';
			}
			
		}else{
			
			//Significa que já há uma Anamnese inserida relacionada a este idinternacao
			//Atualizar os dados
			
			$sql1 = 'UPDATE anamneseinformacoesdoencatratamento SET motivointernacao = :motivointernacao, 
			                                                        doencascronicas = :doencascronicas, 
											                        tratamentosanteriores = :tratamentosanteriores, 
											                        fatoresrisco = :fatoresrisco, 
											                        fatoresriscooutros = :fatoresriscooutros, 
											                        medicamentosuso = :medicamentosuso, 
											                        antecedentesfamiliares = :antecedentesfamiliares
																	WHERE idanamnese = :idanamnese';
           
			$stmt1 = $conn->prepare($sql1);
			$stmt1->bindParam(':idanamnese'            , $idanamnese);
			$stmt1->bindParam(':motivointernacao'      , $motivointernacao);
			$stmt1->bindParam(':doencascronicas'       , $doencascronicas);
			$stmt1->bindParam(':tratamentosanteriores' , $tratamentosanteriores);
			$stmt1->bindParam(':fatoresrisco'          , $fatoresrisco);
			$stmt1->bindParam(':fatoresriscooutros'    , $fatoresriscooutros);
			$stmt1->bindParam(':medicamentosuso'       , $medicamentosuso);
			$stmt1->bindParam(':antecedentesfamiliares', $antecedentesfamiliares);
			$stmt1->bindParam(':idanamnese'            , $idanamnese);
			
			if($stmt1->execute()){
				//Retorno o ID da Anamnese
				echo $idanamnese;
			}else{
				echo 'ERRO';
			}
		}
	}
?>