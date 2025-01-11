<?php
header('Content-Type: text/plain; charset=utf-8');
require_once '../functions.php';
$prices = getAllPrices();
foreach ($prices as $key => $value) {
    echo ucfirst($key) . ": $value\n";
}
