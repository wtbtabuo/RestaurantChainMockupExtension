<?php
require_once 'vendor/autoload.php';
require_once 'src/User/User.php';
require_once 'Interfaces/RandomGenerator.php';

use RandomGenerator\RandomGenerator;

// POSTリクエストからパラメータを取得
$employeeCount = $_POST['employeeCount'] ?? 5;
$minSalary = $_POST['minSalary'] ?? 30000;
$maxSalary = $_POST['maxSalary'] ?? 30000;
$locationNumberRange = $_POST['locationNumberRange'] ?? 5;
$zipCodeRange = $_POST['zipCodeRange'] ?? 5;
$format = $_POST['format'] ?? 'html';

// パラメータが正しい形式であることを確認
$employeeCount = (int)$employeeCount;
$minSalary = (int)$minSalary;
$maxSalary = (int)$maxSalary;
$locationNumberRange = (int)$locationNumberRange;
$zipCodeRange = (int)$zipCodeRange;


// ユーザーを生成
$restaurantChains = RandomGenerator::restaurantChains($employeeCount, $minSalary, $maxSalary, $locationNumberRange, $zipCodeRange, $employees = [], $restaurantLocations= []);   

if ($format === 'markdown') {
    header('Content-Type: text/markdown');
    header('Content-Disposition: attachment; filename="users.md"');
    foreach ($users as $user) {
        echo $user->toMarkdown();
    }
} elseif ($format === 'json') {
    header('Content-Type: application/json');
    header('Content-Disposition: attachment; filename="users.json"');
    $usersArray = array_map(fn($user) => $user->toArray(), $users);
    echo json_encode($usersArray);
} elseif ($format === 'txt') {
    header('Content-Type: text/plain');
    header('Content-Disposition: attachment; filename="users.txt"');
    foreach ($users as $user) {
        echo $user->toString();
    }
} else {
    // HTMLをデフォルトに
    header('Content-Type: text/html');
    for ($i = 0; $i < count($restaurantChains); $i++) {
        echo $restaurantChains[$i]->toHTML();
    }
}