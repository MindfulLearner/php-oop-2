<?php

$data = (file_get_contents('php://input'));

header('Content-Type: application/json');
echo json_encode([
  'status'=> 'success',
  'message' => 'dati ricevuti ti mando la conferma',
]);

echo 'sswa';
?>
