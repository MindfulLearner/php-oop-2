<?php
header('Content-Type: application/json');
$jasonEnCode = file_get_contents('../data/products.json');
echo $jasonEnCode;
?>
