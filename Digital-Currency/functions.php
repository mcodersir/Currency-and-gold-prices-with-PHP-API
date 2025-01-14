<?php
function getPrice($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    $html = curl_exec($ch);
    curl_close($ch);
    $dataCol = "info.last_trade.PDrCotVal";
    preg_match('/<span[^>]*data-col="' . preg_quote($dataCol, '/') . '"[^>]*>(.*?)<\/span>/s', $html, $matches);
    return !empty($matches[1]) ? $matches[1] : "ناموجود";
}
function getPricesMulti($urls) {
    $multiHandle = curl_multi_init();
    $curlHandles = [];
    $responses = [];
    foreach ($urls as $key => $url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        $curlHandles[$key] = $ch;
        curl_multi_add_handle($multiHandle, $ch);
    }
    do {
        $status = curl_multi_exec($multiHandle, $active);
        curl_multi_select($multiHandle);
    } while ($active && $status == CURLM_OK);
    foreach ($curlHandles as $key => $ch) {
        $responses[$key] = curl_multi_getcontent($ch);
        curl_multi_remove_handle($multiHandle, $ch);
        curl_close($ch);
    }

    curl_multi_close($multiHandle);
    return $responses;
}
function getAllPrices() {
    $urls = [
        'bitcoin' => "https://www.tgju.org/profile/crypto-bitcoin",
        'ethereum' => "https://www.tgju.org/profile/crypto-ethereum",
        'ripple' => "https://www.tgju.org/profile/crypto-ripple",
        'tether' => "https://www.tgju.org/profile/crypto-tether",
        'binance-coin' => "https://www.tgju.org/profile/crypto-binance-coin",
        'solana' => "https://www.tgju.org/profile/crypto-solana",
        'dogecoin' => "https://www.tgju.org/profile/crypto-dogecoin",
        'cardano' => "https://www.tgju.org/profile/crypto-cardano",
        'tron' => "https://www.tgju.org/profile/crypto-tron",
        'toncoin' => "https://www.tgju.org/profile/crypto-toncoin",
        'shiba-inu' => "https://www.tgju.org/profile/crypto-shiba-inu",
        'chainlink' => "https://www.tgju.org/profile/crypto-chainlink",
        'bitcoin-cash' => "https://www.tgju.org/profile/crypto-bitcoin-cash",
        'uniswap' => "https://www.tgju.org/profile/crypto-uniswap",
        'litecoin' => "https://www.tgju.org/profile/crypto-litecoin",
        'pepe' => "https://www.tgju.org/profile/crypto-pepe"
    ];
    $htmlResponses = getPricesMulti($urls);
    $prices = [];
    foreach ($htmlResponses as $key => $html) {
        $prices[$key] = getPriceFromHtml($html);
    }
    return $prices;
}
function getPriceFromHtml($html, $dataCol = "info.last_trade.PDrCotVal") {
    preg_match('/<span[^>]*data-col="' . preg_quote($dataCol, '/') . '"[^>]*>(.*?)<\/span>/s', $html, $matches);
    return !empty($matches[1]) ? $matches[1] : "ناموجود";
}
?>
