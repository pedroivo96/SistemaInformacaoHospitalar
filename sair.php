<?php
 
session_start(); //iniciamos a sessão que foi aberta
 
session_destroy(); //destruimos a sessão ;)
 
session_unset(); //limpamos as variaveis globais das sessões
 
 
/*aqui você pode redirecionar para uma determinada página*/
header("Location: index.php");
 
?>