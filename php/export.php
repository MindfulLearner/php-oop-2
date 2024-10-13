<?php

require_once __DIR__ . '/instances.php';

$productsArray = [];

foreach ($products as $product) {
  $category = $product->getCategory();
    $productsArray[] = [
        'label' => $product->getLabel(),
        'images' => $product->getImages(),
        'price' => $product->getPrice(),
        'type' => $product->getType(),
        'category' => [
            'animal' => $category->getAnimal(),
            'icon' => $category->getAnimalIcon() 
        ],
    ];
}

$jsonData = json_encode($productsArray, JSON_PRETTY_PRINT);

file_put_contents('../data/products.json', $jsonData);

$productsDiscountedArray = [];

foreach ($products as $product) {
  $discountedPrice = $product->getPrice() * 0.80;
  $product -> setPrice($discountedPrice);
  $category = $product->getCategory();
    $productsDiscountedArray[] = [
        'label' => $product->getLabel(),
        'images' => $product->getImages(),
        'price' => $product->getPrice(),
        'type' => $product->getType(),
        'category' => [
            'animal' => $category->getAnimal(),
            'icon' => $category->getAnimalIcon() 
        ],
    ];
}
$jsonDiscountedData = json_encode($productsDiscountedArray, JSON_PRETTY_PRINT);
file_put_contents('../data/discountedProducts.json', $jsonDiscountedData);

echo "Dati salvati in products.json e discounted.json";

?>

