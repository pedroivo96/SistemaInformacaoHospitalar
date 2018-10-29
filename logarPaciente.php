<?php
	include './conexao.php';
	
	if(!empty($_POST)){
		
		$nomeusuario = $_POST['nomeusuario'];
        $senha       = $_POST['senha'];
		
		$conn = getConnection();
		
		$sql = 'SELECT * FROM pacientes WHERE nomeusuario = :nomeusuario AND senha = :senha';
		$stmt = $conn->prepare($sql);
        $stmt->bindValue(':nomeusuario', $nomeusuario);
		$stmt->bindValue(':senha'      , $senha);
        $stmt->execute();
        $count = $stmt->rowCount();
		
		if($count > 0){
            $result = $stmt->fetchAll();
			
			foreach($result as $row){
				
				session_start();
				$_SESSION['cpf']                    = $row['cpf'];
				$_SESSION['rg']                     = $row['rg'];
				$_SESSION['nomecompleto']           = $row['nomecompleto'];
				$_SESSION['sexo']                   = $row['sexo'];
				$_SESSION['nomemae']                = $row['nomemae'];
				$_SESSION['naturalidademunicipio']  = $row['naturalidademunicipio'];
				$_SESSION['naturalidadeestado']     = $row['naturalidadeestado'];
				$_SESSION['enderecovia']            = $row['enderecovia'];
				$_SESSION['endereconumero']         = $row['endereconumero'];
				$_SESSION['enderecocomplemento']    = $row['enderecocomplemento'];
				$_SESSION['enderecobairrodistrito'] = $row['enderecobairrodistrito'];
				$_SESSION['enderecomunicipio']      = $row['enderecomunicipio'];
				$_SESSION['enderecoestado']         = $row['enderecoestado'];
				$_SESSION['nomeusuario']            = $row['nomeusuario'];
				$_SESSION['email']                  = $row['email'];
				
				//header("Location: menuPaciente.php");
				
				echo "OK";
			}
        }else{
			echo "Erro1"; //As informações não correspondem a um usuário cadastrado
		}
	}
?>