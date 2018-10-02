<?php
	include './conexao.php';
	
	if(!empty($_POST)){
		
		$nomeusuario = $_POST['nomeusuario'];
        $senha       = $_POST['senha'];
		
		$conn = getConnection();
		
		$sql = 'SELECT * FROM profissionais WHERE nomeusuario = :nomeusuario AND senha = :senha';
		$stmt = $conn->prepare($sql);
        $stmt->bindValue(':nomeusuario', $nomeusuario);
		$stmt->bindValue(':senha'      , $senha);
        $stmt->execute();
        $count = $stmt->rowCount();
		
		if($count > 0){
            $result = $stmt->fetchAll();
			
			foreach($result as $row){
				/*
				echo "<li>{$row['nomecompleto']}</li>";
				echo "<li>{$row['cpf']}</li>";
				echo "<li>{$row['nomemae']}</li>";
				*/
				
				$tipo = $row['tipo'];
				
				session_start();
				$_SESSION['cpf']           = $row['cpf'];
				$_SESSION['nomecompleto']  = $row['nomecompleto'];
				$_SESSION['rg']            = $row['rg'];
				$_SESSION['tipo']          = $row['tipo'];
				$_SESSION['nomeusuario']   = $row['nomeusuario'];
				$_SESSION['registro']      = $row['registro'];
				$_SESSION['especialidade'] = $row['especialidade'];
				
				if($tipo == "Médico"){
					header("Location: menuMedico.php");
				}
				if($tipo == "Enfermeiro"){
					header("Location: menuEnfermeiro.php");
				}
				if($tipo == "Técnico em Enfermagem"){
					header("Location: menuTecnico.php");
				}
			}
        }else{
			echo '<div class="alert alert-danger">
					<strong>Erro!</strong> Nome de usuário não corresponde a um Profissional cadastrado.
				  </div>';
		}
	}
?>