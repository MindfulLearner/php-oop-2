<?php
session_start();

$data = json_decode(file_get_contents('php://input'), true);

/*.post to postloginValidator.php*/
/*  usero session anziche post o curl perche e' una roba assurda*/
$_SESSION['successLogin'] = false;
$_SESSION['dataReceivedLog'] = $data;


// .get da posttLOGIN.php
/*$successLogin = true;*/
// se successo login true allora
if ($_SESSION['successLogin'] == true) { 
  header('Content-Type: application/json');
  echo json_encode([
    'status'=> 'success',
    'message' => 'dati ricevuti ti mando la conferma',
  ]);

  if (preg_match('/^\d{4}$/', $data['credit'])) {
    /*echo "il numero di carta e' valido";*/
  } else {
    /*echo "non e'valido";*/
  }
  if (filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
    /*echo "email è valida";*/
  } else {
    /*echo "errore";*/
  }
  $today = new DateTime();
  $Day = $today->format('j');  
  $Month = $today->format('n'); 


  if ($data['month'] > $Month || ($data['month'] == $Month && $data['day'] >= $Day)) {
    /*echo "l giorno e il mese sono validi";*/
  } else {
    /*echo "errore";*/
  }
} else {
  header('Content-Type: application/json');
  echo json_encode([
    'status'=> 'errore',
    'message' => 'dati non validi',
  ]);
}


?>
