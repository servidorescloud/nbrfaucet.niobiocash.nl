<?php
ini_set('max_execution_time', 60);
//set timezone
date_default_timezone_set('America/Recife');

//database credentials

define('DBHOST2','localhost');
define('DBUSER2','USUARIO-DB');
define('DBPASS2','SENHA-DB');
define('DBNAME2','NOME-DB');

try {

    //create PDO connection 2
    $db2 = new PDO("mysql:host=".DBHOST2.";dbname=".DBNAME2, DBUSER2, DBPASS2);
    $db2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
    //show error
    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
    exit;
}


?>
