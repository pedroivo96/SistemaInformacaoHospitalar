<?php
    
    function getConnection(){
        $dsn = 'mysql:host=localhost;dbname=sistemainformacaohospitalar';
        $user = 'root';
        $pass = '';

        try{
            echo "antes";
            $pdo = new PDO($dsn, $user, $pass, array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
                PDO::ATTR_PERSISTENT => false,
                PDO::ATTR_EMULATE_PREPARES => false,
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
				)
			);
			
            echo "conectou";
            return $pdo;
        }catch(PDOException $ex){
            echo 'Erro: '.$ex->getMessage();
        }
    }
	
?>