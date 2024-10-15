<?php
session_start();

$data = json_decode(file_get_contents('php://input'), true);
include ../queris/mysqlLog.php;

/*.post to postloginValidator.php*/
/*  usero session anziche post o curl perche e' una roba assurda*/
$_SESSION['successLogin'] = false;
$_SESSION['dataReceivedLog'] = $data;

// ho due idee qui... 
// 1. faccio fare un do prima cosi fa prima tutta la sua cosa con post login...
// 2. o usare include ... che contiene un funzione 

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
