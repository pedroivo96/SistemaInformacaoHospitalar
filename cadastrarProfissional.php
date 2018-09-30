<?php
	include './conexao.php';

    if(!empty($_POST)){
		
		$cpf           = $_POST['cpf'];
		$rg            = $_POST['rg'];
		$nomecompleto  = $_POST['nomecompleto'];
		$tipo          = $_POST['tipo'];
		$registro      = $_POST['registro'];
		$especialidade = $_POST['especialidade'];
		$nomeusuario   = $_POST['nomeusuario'];
		$senha         = $_POST['senha'];
		
		$conn = getConnection();
		
		$sql = 'SELECT * FROM profissionais WHERE cpf = :cpf OR rg = :rg OR registro = :registro OR nomeusuario = :nomeusuario';
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':cpf'         , $cpf);
        $stmt->bindValue(':rg'          , $rg);
		$stmt->bindValue(':registro'    , $registro);
		$stmt->bindValue(':nomeusuario' , $nomeusuario);
        $stmt->execute();
        $count = $stmt->rowCount();

        if($count > 0){
            echo '<div class="alert alert-danger">
					<strong>Erro no cadastro!</strong> CPF ou RG ou Registro ou Nome de usuário já cadastrado.
				  </div>';
        }else{
			
			$sql2 = 'INSERT INTO profissionais (cpf, 
			                                    rg, 
											    nomecompleto, 
											    tipo, 
											    registro, 
											    especialidade, 
											    nomeusuario,
											    senha) VALUES(:cpf, 
											                  :rg, 
														      :nomecompleto,
														      :tipo,
														      :registro,
														      :especialidade,
														      :nomeusuario,
														      :senha)';
            $stmt2 = $conn->prepare($sql2);
            $stmt2->bindParam(':cpf'           , $cpf);
			$stmt2->bindParam(':rg'            , $rg);
			$stmt2->bindParam(':nomecompleto'  , $nomecompleto);
			$stmt2->bindParam(':tipo'          , $tipo);
			$stmt2->bindParam(':registro'      , $registro);
			$stmt2->bindParam(':especialidade' , $especialidade);
			$stmt2->bindParam(':nomeusuario'   , $nomeusuario);
			$stmt2->bindParam(':senha'         , $senha);
			
			if($stmt2->execute()){
                echo '<div class="alert alert-success">
						<strong>Cadastrado realizado!</strong> Profissional cadastrado com sucesso.
                      </div>';
					  
					  header("Location: admin.html");
            }else{
                echo '<div class="alert alert-danger">
						<strong>Erro no cadastro!</strong> Falha no banco de dados.
                      </div>';
            }
			
		}
	}

?>