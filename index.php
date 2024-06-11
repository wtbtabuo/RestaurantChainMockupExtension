<?php

require_once __DIR__ . '/vendor/autoload.php';

use RestaurantChain\RestaurantChain;

$min = $_GET['min'] ?? 2;
$max = $_GET['max'] ?? 5;

$min = (int)$min;
$max = (int)$max;

// minとmaxの間でランダムな数を生成し、その数だけRestaurantChainオブジェクトを生成
$restaurantChains = [];
for ($i = 0; $i < rand($min, $max); $i++) {
    $restaurantChains[] = RestaurantChain::RandomGenerator();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>User Profiles</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <?php foreach ($restaurantChains as $restaurantChain): ?>
        <?php echo $restaurantChain->toHTML(); ?>
    <?php endforeach; ?>
</body>
</html>
