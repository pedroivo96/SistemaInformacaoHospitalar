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
				$_SESSION['cpf']         = $row['cpf'];
				$_SESSION['nomeusuario'] = $row['nomeusuario'];
				
				echo "OK";
			}
        }else{
			echo "Erro1"; //As informações não correspondem a um usuário cadastrado
		}
	}
?>