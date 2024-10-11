<?php

require_once __DIR__ . '/instances.php';

$productsArray = [];

foreach ($products as $product) {
    $productsArray[] = [
        'label' => $product->getLabel(),
        'images' => $product->getImages(),
        'price' => $product->getPrice(),
        'type' => $product->getType(),
        'category' => $product->getCategory(),
    ];
}

$jsonData = json_encode($productsArray, JSON_PRETTY_PRINT);

file_put_contents('../data/products.json', $jsonData);

echo $jsonData;
echo "Dati salvati in products.json";

?>

