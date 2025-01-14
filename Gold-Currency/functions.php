<?php
function getPrice($url, $dataCol) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    $html = curl_exec($ch);
    curl_close($ch);
    preg_match('/<span[^>]*data-col="' . preg_quote($dataCol, '/') . '"[^>]*>(.*?)<\/span>/s', $html, $matches);
    return !empty($matches[1]) ? $matches[1] : "ناموجود";
}
function getAllPrices() {
    return [
        'dollar' => getPrice("https://www.tgju.org/profile/price_dollar_rl", "info.last_trade.PDrCotVal"),
        'euro' => getPrice("https://www.tgju.org/profile/price_eur", "info.last_trade.PDrCotVal"),
        'aed' => getPrice("https://www.tgju.org/profile/price_aed", "info.last_trade.PDrCotVal"),
        'gbp' => getPrice("https://www.tgju.org/profile/price_gbp", "info.last_trade.PDrCotVal"),
        'gold18' => getPrice("https://www.tgju.org/profile/geram18", "info.last_trade.PDrCotVal"),
        'gold24' => getPrice("https://www.tgju.org/profile/geram24", "info.last_trade.PDrCotVal"),
        'coin' => getPrice("https://www.tgju.org/profile/sekeb", "info.last_trade.PDrCotVal"),
        'quarter_coin' => getPrice("https://www.tgju.org/profile/rob", "info.last_trade.PDrCotVal")
    ];
}