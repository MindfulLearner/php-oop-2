<?php
header('Content-Type: application/json');
$jasonEnCode = file_get_contents('../data/movies.json');
echo $jasonEnCode;
?>
