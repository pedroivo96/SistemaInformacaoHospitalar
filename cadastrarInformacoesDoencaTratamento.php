<?php
	include './conexao.php';
	
	if(!empty($_POST)){
		 
		$idanamnese             = $_POST['idanamnese'];
		$motivointernacao       = $_POST['motivointernacao'];
		$doencascronicas        = $_POST['doencascronicas'];
		$tratamentosanteriores  = $_POST['tratamentosanteriores'];
		$medicamentosuso        = $_POST['medicamentosuso'];
		$antecedentesfamiliares = $_POST['antecedentesfamiliares'];
		
		$fatoresrisco = "";
		
		$fatoresriscooutros     = $_POST['fatoresriscooutros'];
		
		if(isset($_POST['fatoresrisco1'])){ $fatoresrisco = $fatoresrisco . $_POST['fatoresrisco1'] . ","; }
		
		if(isset($_POST['fatoresrisco2'])){ $fatoresrisco = $fatoresrisco . $_POST['fatoresrisco2'] . ","; }
		
		if(isset($_POST['fatoresrisco3'])){ $fatoresrisco = $fatoresrisco . $_POST['fatoresrisco3'] . ","; }
		
		if(isset($_POST['fatoresrisco4'])){ $fatoresrisco = $fatoresrisco . $_POST['fatoresrisco4'] . ","; }
		
		if(isset($_POST['fatoresrisco5'])){ $fatoresrisco = $fatoresrisco . $_POST['fatoresrisco5'] . ","; }
		
		if(isset($_POST['fatoresrisco6'])){ $fatoresrisco = $fatoresrisco . $_POST['fatoresrisco6'] . ","; }
		
		if(isset($_POST['fatoresrisco7'])){ $fatoresrisco = $fatoresrisco . $_POST['fatoresrisco7'];       }
		
		$conn = getConnection();
		
		$sql1 = 'INSERT INTO anamneseinformacoesdoencatratamento (motivointernacao, 
			                                                      doencascronicas, 
											                      tratamentosanteriores, 
											                      fatoresrisco, 
											                      fatoresriscooutros, 
											                      medicamentosuso, 
											                      antecedentesfamiliares,
											                      idanamnese) VALUES(:motivointernacao, 
											                                         :doencascronicas, 
														                             :tratamentosanteriores,
														                             :fatoresrisco,
														                             :fatoresriscooutros,
														                             :medicamentosuso,
														                             :antecedentesfamiliares,
														                             :idanamnese)';
           
		$stmt1 = $conn->prepare($sql1);
        $stmt1->bindParam(':motivointernacao'      , $motivointernacao);
		$stmt1->bindParam(':doencascronicas'       , $doencascronicas);
		$stmt1->bindParam(':tratamentosanteriores' , $tratamentosanteriores);
		$stmt1->bindParam(':fatoresrisco'          , $fatoresrisco);
		$stmt1->bindParam(':fatoresriscooutros'    , $fatoresriscooutros);
		$stmt1->bindParam(':medicamentosuso'       , $medicamentosuso);
		$stmt1->bindParam(':antecedentesfamiliares', $antecedentesfamiliares);
		$stmt1->bindParam(':idanamnese'            , $idanamnese);
			
		if($stmt1->execute()){
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