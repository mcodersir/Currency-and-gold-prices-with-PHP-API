<?php
header('Content-Type: application/json; charset=utf-8');
require_once '../functions.php';
$prices = getAllPrices();
echo json_encode($prices, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);