<?php
session_start();

require_once __DIR__ . '/mysqlLog.php';

function prettyVarDump($var) {
  echo '<pre style="background: #f4f4f4; border: 1px solid #ccc; padding: 10px; border-radius: 5px; font-size: 14px; line-height: 1.5;">';
  var_dump($var);
  echo '</pre>';
}
prettyVarDump($_SESSION['dataReceivedLog']);

// abbimao importato logintest quindi dobbiamo prendere la connessione

$connection = getDBConnection();

// test della carta percentuale serve per matchare eventuali numeri dopo o stringhe
/*$creditCard = '2133%';*/

// qui faremo due controlli uno normale e uno compleo
$creditCard = $_SESSION['dataReceivedLog']['credit'];
prettyVarDump($creditCard);

// preparazione ed esecuzione query
$sql = "SELECT * FROM users WHERE creditcard LIKE ?";
// stmt nomenclatura best practice
$stmt = $connection->prepare($sql);
$stmt->bind_param("s", $creditCard);
$stmt->execute();

//risultato della query ma non da direttamente  tutto
$result = $stmt->get_result();

// con questo si puo fare aanche in altri modi tiriamo fuori il risutlato
$dataQuery = $result->fetch_all(MYSQLI_ASSOC);

prettyVarDump($dataQuery);

if ($dataQuery[0]['creditcard'] == $creditCard) {
  $_SESSION['successLogin'] = true;
  echo 'entrato';
} else {
echo 'nah';
}
  //QUESTO NON ANDRA PIU A FUNZIONARE PERCHE IMMAGINA CHE QUANDO TIRI FUORI E' COME UN BUCKET CHE VIENE SVUOTATO  NON PERSISTE
  //
// Verifica se ci sono risultati e li stampa
/*if ($result->num_rows > 0) {*/
/*    while ($row = $result->fetch_assoc()) {*/
/*        echo "Credit Card: " . $row["creditcard"] . "<br>";*/
/*        echggVGo "Email: " . $row["email"] . "<br>";*/
/*        echo "Day Expire: " . $row["dayexpire"] . "<br>";*/
/*        echo "Year Expire: " . $row["yearexpire"] . "<br>";*/
/*        echo "<hr>";*/
/*    }*/
/*} else {*/
/*    echo "risutalto vuoto!";*/
/*}*/

// non ha senso perche non e' un php json??
/*header('Content-Type: application/json');*/
/*echo json_encode($dataQuery);*/


// Chiudi la connessione
$connection->close();
?>
