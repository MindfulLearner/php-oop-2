<?php

define('DB_SERVER', 'mysql-db'); 
define('DB_USERNAME', 'root');  // root per che ho il permesso per le chiamate
define('DB_PASSWORD', 'root_password'); //  questo perche quello impostato da docker
define('DB_NAME', 'user_management');   //  questo db perche '   e' quello che ho creato

$connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// debug connessine
if($connection === false){
    die("Errore di connessione al database: " . mysqli_connect_error());
}


?>
