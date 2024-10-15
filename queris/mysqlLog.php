<?php

define('DB_SERVER', 'mysql-db');  // nome del mio database in docker compose
define('DB_USERNAME', 'root');    // 'root' perché hai il permesso per le chiamate
define('DB_PASSWORD', 'root_password'); // Password impostata da Docker-compose che ho messo io
define('DB_NAME', 'user_management');   // Il database che ho creato tramite query 

// funzione per avere la connessione
function getDBConnection() {

  // sto passando allo stessa variabile
    $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    // Debug della connessione
    if ($connection === false) {
        die("the most swagger error no connection to mysql " . mysqli_connect_error());
    }

    // stessa varianbile
    return $connection;
}
?>

