<?php
require_once 'functions.php';
$prices = getAllPrices();
?>
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>قیمت ارز و طلا</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@33.003/misc/Farsi-Digits/Vazirmatn-FD-font-face.css" rel="stylesheet">
</head>
<style>
    body {
        font-family: Vazirmatn, sans-serif;
    }
    .card {
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border: none;
    }
</style>
<body dir="rtl">
    <div class="container my-5">
        <h1 class="text-center mb-4">قیمت ارز و طلا</h1>
        <div class="row g-4">
            <?php
                $items = [
                    'بیت کوین' => $prices['bitcoin'],
                    'اتریوم' => $prices['ethereum'],
                    'ریپل' => $prices['ripple'],
                    'تتر' => $prices['tether'],
                    'بایننس کوین' => $prices['binance-coin'],
                    'سولانا' => $prices['solana'],
                    'دوج کوین' => $prices['dogecoin'],
                    'کاردانو' => $prices['cardano'],
                    'ترون' => $prices['tron'],
                    'تون کوین' => $prices['toncoin'],
                    'شیبا اینو' => $prices['shiba-inu'],
                    'چین لینک' => $prices['chainlink'],
                    'بیت کوین کش' => $prices['bitcoin-cash'],
                    'یونی سواپ' => $prices['uniswap'],
                    'لایت کوین' => $prices['litecoin'],
                    'پپه' => $prices['pepe'],
                ];
            foreach ($items as $name => $price) {
                echo "
                <div class='col-md-3 col-sm-6'>
                    <div class='card text-center p-3'>
                        <div class='card-body'>
                            <h5 class='card-title'>$name</h5>
                            <p class='card-text fs-4'>" . htmlspecialchars($price) . " ریال</p>
                        </div>
                    </div>
                </div>";
            }
            ?>
        </div>
    </div>
</body>
</html>