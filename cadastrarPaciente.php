<?php

    include './conexao.php';

    if(!empty($_POST)){

        $cpf                    = $_POST['cpf'];
        $rg                     = $_POST['rg'];
		$nomecompleto           = $_POST['nomecompleto'];
		$datanascimento         = $_POST['datanascimento'];
		$sexo                   = $_POST['sexo'];
		$nomemae                = $_POST['nomemae'];
		$naturalidademunicipio  = $_POST['naturalidademunicipio'];
		$naturalidadeestado     = $_POST['naturalidadeestado'];
		$enderecovia            = $_POST['enderecovia'];
		$endereconumero         = $_POST['endereconumero'];
		$enderecocomplemento    = $_POST['enderecocomplemento'];
		$enderecobairrodistrito = $_POST['enderecobairrodistrito'];
		$enderecomunicipio      = $_POST['enderecomunicipio'];
		$enderecoestado         = $_POST['enderecoestado'];
		$nomeusuario            = $_POST['nomeusuario'];
		$senha                  = $_POST['senha'];
		$email                  = $_POST['email'];

        $conn = getConnection();

        $sql = 'SELECT * FROM pacientes WHERE email = :email OR nomeusuario = :nomeusuario OR cpf = :cpf OR rg = :rg';
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':email'      , $email);
        $stmt->bindValue(':nomeusuario', $nomeusuario);
		$stmt->bindValue(':cpf'        , $cpf);
		$stmt->bindValue(':rg'         , $rg);
        $stmt->execute();
        $count = $stmt->rowCount();

        if($count > 0){
            echo '<div class="alert alert-danger">
					<strong>Erro no cadastro!</strong> Email ou Username ou CPF ou RG já cadastrado.
				  </div>';
        }else{
            $sql2 = 'INSERT INTO pacientes (cpf, 
			                                rg, 
											nomecompleto, 
											datanascimento, 
											sexo, 
											nomemae, 
											naturalidademunicipio,
											naturalidadeestado,
											enderecovia,
											endereconumero,
											enderecocomplemento,
											enderecobairrodistrito,
											enderecomunicipio,
											enderecoestado,
											nomeusuario,
											senha,
											email) VALUES(:cpf, 
											              :rg, 
														  :nomecompleto,
														  :datanascimento,
														  :sexo,
														  :nomemae,
														  :naturalidademunicipio,
														  :naturalidadeestado,
														  :enderecovia,
														  :endereconumero,
														  :enderecocomplemento,
														  :enderecobairrodistrito,
														  :enderecomunicipio,
														  :enderecoestado,
														  :nomeusuario,
														  :senha,
														  :email)';
            $stmt2 = $conn->prepare($sql2);
            $stmt2->bindParam(':cpf'                   , $cpf);
			$stmt2->bindParam(':rg'                    , $rg);
			$stmt2->bindParam(':nomecompleto'          , $nomecompleto);
			$stmt2->bindParam(':datanascimento'        , $datanascimento);
			$stmt2->bindParam(':sexo'                  , $sexo);
			$stmt2->bindParam(':nomemae'               , $nomemae);
			$stmt2->bindParam(':naturalidademunicipio' , $naturalidademunicipio);
			$stmt2->bindParam(':naturalidadeestado'    , $naturalidadeestado);
			$stmt2->bindParam(':enderecovia'           , $enderecovia);
			$stmt2->bindParam(':endereconumero'        , $endereconumero);
			$stmt2->bindParam(':enderecocomplemento'   , $enderecocomplemento);
			$stmt2->bindParam(':enderecobairrodistrito', $enderecobairrodistrito);
			$stmt2->bindParam(':enderecomunicipio'     , $enderecomunicipio);
			$stmt2->bindParam(':enderecoestado'        , $enderecoestado);
			$stmt2->bindParam(':nomeusuario'           , $nomeusuario);
			$stmt2->bindParam(':senha'                 , $senha);
			$stmt2->bindParam(':email'                 , $email);

            if($stmt2->execute()){
                echo '<div class="alert alert-success">
						<strong>Cadastrado realizado!</strong> Usuário cadastrado com sucesso.
                      </div>';
					  
					  session_start();
					  $_SESSION['cpf']                    = $cpf;
					  $_SESSION['rg']                     = $rg;
					  $_SESSION['nomecompleto']           = $nomecompleto;
					  $_SESSION['sexo']                   = $sexo;
					  $_SESSION['nomemae']                = $nomemae;
					  $_SESSION['naturalidademunicipio']  = $naturalidademunicipio;
					  $_SESSION['naturalidadeestado']     = $naturalidadeestado;
					  $_SESSION['enderecovia']            = $enderecovia;
					  $_SESSION['endereconumero']         = $endereconumero;
					  $_SESSION['enderecocomplemento']    = $enderecocomplemento;
					  $_SESSION['enderecobairrodistrito'] = $enderecobairrodistrito;
					  $_SESSION['enderecomunicipio']      = $enderecomunicipio;
					  $_SESSION['enderecoestado']         = $enderecoestado;
					  $_SESSION['nomeusuario']            = $nomeusuario;
					  $_SESSION['email']                  = $email;
					  header("Location: menuPaciente.html");
            }else{
                echo '<div class="alert alert-danger">
						<strong>Erro no cadastro!</strong> Falha no banco de dados.
                      </div>';
            }
        }
    }else{
        //header("Location:./");
    }

?>