<?php

declare(strict_types=1);

use MoneyPHP\CryptoCurrencies\Fetcher\BinanceFetcher;
use MoneyPHP\CryptoCurrencies\Fetcher\CoinMarketCapFetcher;
use MoneyPHP\CryptoCurrencies\Serializer\JsonSerializer;
use MoneyPHP\CryptoCurrencies\Serializer\PhpExportSerializer;
use MoneyPHP\CryptoCurrencies\Updater;
use MoneyPHP\CryptoCurrencies\Writer;

require_once __DIR__ . "/../vendor/autoload.php";

$updater = new Updater();

$cryptocurrencies = $updater->fetchWith(new BinanceFetcher('https://api.binance.com/api/v3/exchangeInfo'));
$updater->writeWith(new Writer(), $cryptocurrencies, 'binance', new JsonSerializer());
$updater->writeWith(new Writer(), $cryptocurrencies, 'binance', new PhpExportSerializer());

$cryptocurrencies = $updater->fetchWith(new CoinMarketCapFetcher('https://pro-api.coinmarketcap.com/v1/cryptocurrency/map'));
$updater->writeWith(new Writer(), $cryptocurrencies, 'coinmarketcap', new JsonSerializer());
$updater->writeWith(new Writer(), $cryptocurrencies, 'coinmarketcap', new PhpExportSerializer());
