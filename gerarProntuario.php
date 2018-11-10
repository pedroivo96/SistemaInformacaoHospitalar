<?php
	// include autoloader
	require_once 'mpdf-6.0.0/mpdf.php';
	
	include './conexao.php';
	
	if(empty($_POST)){
		
		session_start();
		$cpfpaciente = $_SESSION['cpf'];
		$conn   = getConnection();
		
		$html = '<html>
					<head>
						<link href="css/style1.css" rel="stylesheet">
					</head>
					<body>';
					
					
		$html = $html.'<div class="w-100 topic">Informações do paciente</div>'; 			
					
		//Buscar as informações pessoais do paciente
		$sql = 'SELECT * FROM pacientes WHERE cpf = :cpfpaciente';
		$stmt = $conn->prepare($sql);
		$stmt->bindValue(':cpfpaciente', $cpfpaciente);
		$stmt->execute();
		$count = $stmt->rowCount();
					
		if($count > 0){
						
			$result = $stmt->fetchAll();
						
			foreach($result as $row){
				$cpf                    = $row['cpf'];
				$nomecompleto           = $row['nomecompleto'];
				$datanascimento         = $row['datanascimento'];
				$sexo                   = $row['sexo'];
				$nomemae                = $row['nomemae'];
				$naturalidademunicipio  = $row['naturalidademunicipio'];
				$naturalidadeestado     = $row['naturalidadeestado'];
				$enderecovia            = $row['enderecovia'];
				$endereconumero         = $row['endereconumero'];
				$enderecocomplemento    = $row['enderecocomplemento'];
				$enderecobairrodistrito = $row['enderecobairrodistrito'];
				$enderecomunicipio      = $row['enderecomunicipio'];
				$enderecoestado         = $row['enderecoestado'];
				$rg                     = $row['rg'];
				$nomeusuario            = $row['nomeusuario'];
				$email                  = $row['email'];
				
				$html = $html.'<div class="w-100">';
				
				$html = $html.'<p class="subTopic">Dados pessoais</p>';
				
				$html = $html.'<table class="w-100">';
				
				$html = $html.'<tr><th>Nome completo</th><td>'.$nomecompleto.'</td></tr>';
				$html = $html.'<tr><th>CPF</th><td>'.$cpf.'</td></tr>';
				$html = $html.'<tr><th>RG</th><td>'.$rg.'</td></tr>';
				$html = $html.'<tr><th>Nome de usuário</th><td>'.$nomeusuario.'</td></tr>';
				$html = $html.'<tr><th>Email</th><td>'.$email.'</td></tr>';
				
				$html = $html.'</table>';
				
				$html = $html.'<p class="subTopic">Naturalidade</p>';
				
				$html = $html.'<table class="w-100">';
				
				$html = $html.'<tr><th>Estado</th><td>'.$naturalidadeestado.'</td></tr>';
				$html = $html.'<tr><th>Município</th><td>'.$naturalidademunicipio.'</td></tr>';
				
				$html = $html.'</table>';
				
				$html = $html.'<p class="subTopic">Endereço</p>';
				
				$html = $html.'<table class="w-100">';
				
				$html = $html.'<tr><th>Estado</th><td>'.$enderecoestado.'</td></tr>';
				$html = $html.'<tr><th>Município</th><td>'.$enderecomunicipio.'</td></tr>';
				$html = $html.'<tr><th>Bairro/Distrito</th><td>'.$enderecobairrodistrito.'</td></tr>';
				$html = $html.'<tr><th>Via</th><td>'.$enderecovia.'</td></tr>';
				$html = $html.'<tr><th>Número</th><td>'.$endereconumero.'</td></tr>';
				$html = $html.'<tr><th>Complemento</th><td>'.$enderecocomplemento.'</td></tr>';
				
				$html = $html.'</table>';
				
				$html = $html.'</div>';
			}
		}
		
		$html = $html.'<div class="w-100 margin-t5 topic" style="page-break-before: always">Histórico de consultas</div>'; 
					
		//Buscar as informações pessoais do paciente
		$sql1 = 'SELECT * FROM consultas WHERE cpfpaciente = :cpfpaciente';
		$stmt1 = $conn->prepare($sql1);
		$stmt1->bindValue(':cpfpaciente', $cpfpaciente);
		$stmt1->execute();
		$count1 = $stmt1->rowCount();
					
		if($count1 > 0){
						
			$result1 = $stmt1->fetchAll();
						
			foreach($result1 as $row1){
				$idconsulta            = $row1['id'];
				$cpfmedico             = $row1['cpfmedico'];
				$diahorarioatendimento = $row1['diahorarioatendimento'];
				$status                = $row1['status'];
				$queixaprincipal       = $row1['queixaprincipal'];
				$exameclinico          = $row1['exameclinico'];
				$diagnosticoprovavel   = $row1['diagnosticoprovavel'];
				$altainternacao        = $row1['altainternacao'];
				
				$html = $html.'<div class="w-100">';
				
				$html = $html.'<p class="subTopic">Consulta ID '.$idconsulta.'</p>';
				
				$html = $html.'<table class="w-100">';
				
				$html = $html.'<tr><th>CPF do médico</th><td>'.$cpfmedico.'</td></tr>';
				$html = $html.'<tr><th>Nome do médico</th><td>'.obterNomeMedico($cpfmedico).'</td></tr>';
				$html = $html.'<tr><th>Dia e horário de atendimento</th><td>'.date("d/m/y",$diahorarioatendimento).' ás '.date("H:i:s",$diahorarioatendimento).'</td></tr>';
				$html = $html.'<tr><th>Status</th><td>'.$status.'</td></tr>';
				$html = $html.'<tr><th>Queixa principal</th><td>'.$queixaprincipal.'</td></tr>';
				$html = $html.'<tr><th>Exame clínico</th><td>'.$exameclinico.'</td></tr>';
				$html = $html.'<tr><th>Diagnóstico provável</th><td>'.$diagnosticoprovavel.'</td></tr>';
				$html = $html.'<tr><th>Alta/Internação</th><td>'.$altainternacao.'</td></tr>';
				
				$html = $html.'</table>';
				
				$html = $html.'<p style="text-align:center; font-size:18;">Exames solicitados</p>';
				
				//Buscar os IDs dos exames vinculados a esta consulta
				$sql1A = 'SELECT * FROM consultaexame WHERE idconsulta = :idconsulta';
				$stmt1A = $conn->prepare($sql1A);
				$stmt1A->bindValue(':idconsulta', $idconsulta);
				$stmt1A->execute();
				$count1A = $stmt1A->rowCount();
					
				if($count1A > 0){
						
					$result1A = $stmt1A->fetchAll();
						
					foreach($result1A as $row1A){
						$idexame = $row1A['idexame'];
						
						//Busca as informações associadas a este exame
						$sql1AA = 'SELECT * FROM exames WHERE id = :idexame';
						$stmt1AA = $conn->prepare($sql1AA);
						$stmt1AA->bindValue(':idexame', $idexame);
						$stmt1AA->execute();
						$count1AA = $stmt1AA->rowCount();
					
						if($count1AA > 0){
						
							$result1AA = $stmt1AA->fetchAll();
						
							foreach($result1AA as $row1AA){
								
								$nomeexame = $row1AA['nomeexame'];
								$status = $row1AA['status'];
								$anotacoesopcionais = $row1AA['anotacoesopcionais'];
								
								$html = $html.'<div class="margin-l10">';
								
								$html = $html.'<p class="subTopic">Exame ID '.$idexame.'</p>';
								
								$html = $html.'<table class="w-100">';
				
								$html = $html.'<tr><th>Nome do exame</th><td>'.$nomeexame.'</td></tr>';
								$html = $html.'<tr><th>Status</th><td>'.$status.'</td></tr>';
								$html = $html.'<tr><th>Anotações opcionais</th><td>'.$anotacoesopcionais.'</td></tr>';
				
								$html = $html.'</table>';
								
								$html = $html.'</div>';
								
							}
						}
						
						//Busca o resultado do exame, caso esteja disponível
						$sql1AB = 'SELECT * FROM resultadosexames WHERE id = :idexame';
						$stmt1AB = $conn->prepare($sql1AB);
						$stmt1AB->bindValue(':idexame', $idexame);
						$stmt1AB->execute();
						$count1AB = $stmt1AB->rowCount();
					
						if($count1AB > 0){
						
							$result1AB = $stmt1AB->fetchAll();
							
							$html = $html.'<div class=" margin-l10 margin-t5 margin b5">';
						
							foreach($result1AB as $row1AB){
								
								$nomeimagem = $row1AB['nomeimagem'];
								
								$html = $html.'<img class="w-50" src="'.$nomeimagem.'">';
								
							}
							
							$html = $html.'</div>';
						}
						else{
							$html = $html.'<div class="alert bg-warning margin-l10 margin-t5">';
							$html = $html.'<p style="text-align:center;">Não há resultados disponíveis para este exame.</p>';
							$html = $html.'</div>';
						}
					}
				}
				else{
					$html = $html.'<p>Sem exames solicitados</p>';
				}
				
				$html = $html.'<p style="text-align:center; font-size:18;">Procedimentos solicitados</p>';
				
				//Buscar os IDs dos procedimentos vinculados a esta consulta
				$sql1B = 'SELECT * FROM consultaprocedimento WHERE idconsulta = :idconsulta';
				$stmt1B = $conn->prepare($sql1B);
				$stmt1B->bindValue(':idconsulta', $idconsulta);
				$stmt1B->execute();
				$count1B = $stmt1B->rowCount();
					
				if($count1B > 0){
						
					$result1B = $stmt1B->fetchAll();
						
					foreach($result1B as $row1B){
						$idprocedimento = $row1B['idprocedimento'];
						
						//Busca as informações associadas a este procedimento
						$sql1BA = 'SELECT * FROM exames WHERE id = :idprocedimento';
						$stmt1BA = $conn->prepare($sql1BA);
						$stmt1BA->bindValue(':idprocedimento', $idprocedimento);
						$stmt1BA->execute();
						$count1BA = $stmt1BA->rowCount();
					
						if($count1BA > 0){
						
							$result1BA = $stmt1BA->fetchAll();
						
							foreach($result1BA as $row1BA){
								
								$nomeprocedimento   = $row1BA['nomeprocedimento'];
								$status             = $row1BA['status'];
								$anotacoesopcionais = $row1BA['anotacoesopcionais'];
								
								$html = $html.'<div class="margin-l10">';
								
								$html = $html.'<p class="subTopic">Procedimento ID '.$idprocedimento.'</p>';
								
								$html = $html.'<table class="w-100">';
				
								$html = $html.'<tr><th>Nome do procedimento</th><td>'.$nomemedicamento.'</td></tr>';
								$html = $html.'<tr><th>Status</th><td>'.$status.'</td></tr>';
								$html = $html.'<tr><th>Anotações opcionais</th><td>'.$anotacoesopcionais.'</td></tr>';
				
								$html = $html.'</table>';
								
								$html = $html.'</div>';
								
							}
						}
						
						//Busca o resultado do procedimento, caso esteja disponível
						$sql1BB = 'SELECT * FROM resultadosprocedimentos WHERE id = :idprocedimento';
						$stmt1BB = $conn->prepare($sql1BB);
						$stmt1BB->bindValue(':idprocedimento', $idprocedimento);
						$stmt1BB->execute();
						$count1BB = $stmt1BB->rowCount();
					
						if($count1BB > 0){
						
							$result1BB = $stmt1BB->fetchAll();
						
							$html = $html.'<div class=" margin-l10 margin-t5 margin b5">';
						
							foreach($result1BB as $row1BB){
								
								$nomeimagem = $row1BB['nomeimagem'];
								
								$html = $html.'<img class="w-50" src="'.$nomeimagem.'">';
								
							}
							
							$html = $html.'</div>';
						}
						else{
							$html = $html.'<div class="alert bg-warning margin-l10 margin-t5">';
							$html = $html.'<p style="text-align:center;">Não há resultados disponíveis para este exame.</p>';
							$html = $html.'</div>';
						}
					}
				}
				else{
					$html = $html.'<p>Sem procedimentos solicitados</p>';
				}
				
				$html = $html.'<p style="text-align:center; font-size:18;">Medicamentos prescritos</p>';
				
				//Buscar os IDs das prescrições vinculados a esta consulta
				$sql1C = 'SELECT * FROM consultaprescricao WHERE idconsulta = :idconsulta';
				$stmt1C = $conn->prepare($sql1C);
				$stmt1C->bindValue(':idconsulta', $idconsulta);
				$stmt1C->execute();
				$count1C = $stmt1C->rowCount();
					
				if($count1C > 0){
						
					$result1C = $stmt1C->fetchAll();
						
					foreach($result1C as $row1C){
						$idprescricao = $row1C['idprescricao'];
						
						//Busca as informações associadas a esta prescrição
						$sql1CA = 'SELECT * FROM prescricoes WHERE id = :idprescricao';
						$stmt1CA = $conn->prepare($sql1CA);
						$stmt1CA->bindValue(':idprescricao', $idprescricao);
						$stmt1CA->execute();
						$count1CA = $stmt1CA->rowCount();
					
						if($count1CA > 0){
						
							$result1CA = $stmt1CA->fetchAll();
						
							foreach($result1CA as $row1CA){
								
								$nomemedicamento = $row1CA['nomemedicamento'];
								$quantidade      = $row1CA['quantidade'];
								$vezesaodia      = $row1CA['vezesaodia'];
								
								$html = $html.'<div class="margin-l10">';
								
								$html = $html.'<p class="subTopic">Prescrição ID '.$idprescricao.'</p>';
								
								$html = $html.'<table class="w-100">';
				
								$html = $html.'<tr><th>Nome do medicamento</th><td>'.$nomemedicamento.'</td></tr>';
								$html = $html.'<tr><th>Quantidade</th><td>'.$quantidade.'</td></tr>';
								$html = $html.'<tr><th>Vezes ao dia</th><td>'.$vezesaodia.'</td></tr>';
				
								$html = $html.'</table>';
								
								$html = $html.'</div>';
							}
						}
					}
				}
				else{
					$html = $html.'<p>Sem medicamentos prescritos</p>';
				}
				
				$html = $html.'</div>';
			}
		}
		else{
			$html = $html.'<div class="w-100 bg-warning alert margin-t5">';
			$html = $html.'<p style="text-align:center;">Nenhum registro de consulta associado a este cliente.</p>';
			$html = $html.'</div>';
		}
		
		$html = $html.'<div class="w-100 topic margin-b5" style="page-break-before: always">Histórico de internações</div>'; 
		
		//Buscar os registros de internações associadas a este paciente
		$sql2 = 'SELECT * FROM internacoes WHERE cpfpaciente = :cpfpaciente';
		$stmt2 = $conn->prepare($sql2);
		$stmt2->bindValue(':cpfpaciente', $cpfpaciente);
		$stmt2->execute();
		$count2 = $stmt2->rowCount();
					
		if($count2 > 0){
			
			$html = $html.'<div class="w-100">';
			
			$result2 = $stmt2->fetchAll();
						
			foreach($result2 as $row2){
				
				$idinternacao      = $row2['id'];
				$idleito           = $row2['idleito'];
				$diahorarioentrada = $row2['diahorarioentrada'];
				$diahorariosaida   = $row2['diahorariosaida'];
				$cpfmedico         = $row2['cpfmedico'];
				$status            = $row2['status'];
				$cpftecnico        = $row2['cpftecnico'];
				$idsetor           = $row2['idsetor'];
				
				$html = $html.'<table class="w-100">';
				
				$html = $html.'<tr><th>ID da internação</th><td>'.$idinternacao.'</td></tr>';
				$html = $html.'<tr><th>ID do leito</th><td>'.$idleito.'</td></tr>';
				$html = $html.'<tr><th>Dia horário de entrada</th><td>'.date("d/m/Y", $diahorarioentrada)." às ".date("h:i:s", $diahorarioentrada).'</td></tr>';
				$html = $html.'<tr><th>Dia horário de saída</th><td>'.date("d/m/Y", $diahorariosaida)." às ".date("h:i:s", $diahorariosaida).'</td></tr>';
				$html = $html.'<tr><th>CPF do médico solicitante</th><td>'.$cpfmedico.'</td></tr>';
				$html = $html.'<tr><th>Nome do médico solicitante</th><td>'.obterNomeMedico($cpfmedico).'</td></tr>';
				$html = $html.'<tr><th>CPF do técnico responsável</th><td>'.$vezesaodia.'</td></tr>';
				$html = $html.'<tr><th>ID do setor</th><td>'.$vezesaodia.'</td></tr>';
				$html = $html.'<tr><th>Nome do setor</th><td>'.obterNomeSetor($idsetor).'</td></tr>';
				
				$html = $html.'</table>';
				
				$html = $html.'<div class="margin-l10">';
				$html = $html.'<p class="subTopic">Anamnese</p>';
				$html = $html.'</div>';
			}
			
			$html = $html.'</div>';
		}
		else{
			$html = $html.'<div class="w-100 bg-warning alert margin-t5">';
			$html = $html.'<p style="text-align:center;">Nenhum registro de internação associado a este cliente.</p>';
			$html = $html.'</div>';
		}
					
		//Fecha o documento HTML
		$html = $html.'</body>';
		$html = $html.'</html>';
		
		//MPDF
		$mpdf = new mPDF('c', 'A4');
		//$css = file_get_contents('css/style1.css');
		//$mpdf->writeHTML($css, 1); 
		$mpdf->writeHTML($html, 0); 
		$mpdf->Output('prontuario.pdf', 'I');
		
		echo "OK";
	}
	
	function obterNomeMedico($cpfmedico){
		
		$conn = getConnection();
	
		$sql = 'SELECT nomecompleto FROM profissionais WHERE cpf = :cpfmedico AND tipo = :tipo';
		$stmt = $conn->prepare($sql);
		$stmt->bindValue(':cpfmedico', $cpfmedico);
		$stmt->bindValue(':tipo', "Médico");
		$stmt->execute();
		$count = $stmt->rowCount();
					
		if($count > 0){
						
			$result = $stmt->fetchAll();
						
			foreach($result as $row){
				return $row['nomecompleto'];
			}
		}
	}
	
	function obterNomeSetor($idsetor){
		
		$conn = getConnection();
		
		$sql = 'SELECT nome FROM setores WHERE id = :idsetor';
		$stmt = $conn->prepare($sql);
		$stmt->bindValue(':idsetor', $idsetor);
		$stmt->execute();
		$count = $stmt->rowCount();
					
		if($count > 0){
						
			$result = $stmt->fetchAll();
						
			foreach($result as $row){
				return $row['nome'];
			}
		}
	}
	
	function obterNomeTecnico($nometecnico){
		$sql = 'SELECT nomecompleto FROM profissionais WHERE cpf = :cpfmedico AND tipo = :tipo';
		$stmt = $conn->prepare($sql);
		$stmt->bindValue(':cpfmedico', $cpftecnico);
		$stmt->bindValue(':tipo', "Técnico em Enfermagem");
		$stmt->execute();
		$count = $stmt->rowCount();
					
		if($count > 0){
						
			$result = $stmt->fetchAll();
						
			foreach($result as $row){
				return $row['nomecompleto'];
			}
		}
	}
?>