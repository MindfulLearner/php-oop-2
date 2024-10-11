<?php 

require_once __DIR__.'/classes.php';

$categories = [
  $caneCategory = new Category('cani', 'https://cdn-icons-png.flaticon.com/512/616/616408.png'),
  $gattoCategory = new Category('gatti', 'https://cdn-icons-png.flaticon.com/512/616/616430.png')
];

$products = [
  $croccantini = new Products('Croccantini', 'https://baiuland.it/bianchi/wp-content/uploads/2019/09/croccantini.png', 2.50, 'food', $categories[0]),
  $pallinaGioco = new Products('Pallina Gioco', 'https://m.media-amazon.com/images/I/71AvbGKoyoL._AC_UF894,1000_QL80_.jpg', 1.20, 'toy', $categories[0]),
  $tiragraffi = new Products('Tiragraffi', 'https://merchandising.givovashopping.it/wp-content/uploads/2022/07/Pallone-Custom_Reggina_.jpg', 15.99, 'accessory', $categories[1]),
  $scatoletteUmido = new Products('Scatolette Umido', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRvGPa-L3b9eBHugro-CPkFIObqactv2c_ybg&s', 3.80, 'food', $categories[1]),
  $cucciaMorbida = new Products('Cuccia Morbida', 'https://www.satur.it/media/catalog/product/cache/49dc14e98c54e910c6df568e2d317dc4/c/e/ce52763e7ac9b73f4a3f566ad07ca5cd28cae64e4811eade3656536e91a382f4.jpeg', 25.00, 'bed', $categories[0]),
  $guinzaglio = new Products('Guinzaglio', 'https://www.ilverdemondo.it/public/catalog/product/medium/guinzaglio-per-cani-flexi-000.jpg', 9.50, 'accessory', $categories[0])
];





prettyVarDump($products);



?>
