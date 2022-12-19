<?php

declare(strict_types=1);

namespace MoneyPHP\CryptoCurrencies\Fetcher;

use MoneyPHP\CryptoCurrencies\Cryptocurrency;
use MoneyPHP\CryptoCurrencies\Fetcher;

class BinanceFetcher implements Fetcher
{
    const FIAT_CURRENCIES = array(
        'AUD',
        'BRL',
        'ERN',
        'EUR',
        'GBP',
        'NGN',
        'PLN',
        'RON',
        'RUB',
        'TRY',
        'UAH',
        'ZAR',
    );

    private string $url;

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    /*
     * @inheritDoc
     */
    public function fetch(): array
    {
        /** @var Cryptocurrency[] $cryptocurrencies */
        $cryptocurrencies = [];

        $content = file_get_contents($this->url);

        if ($content === false) {
            throw new \RuntimeException('Failed to fetch data from ' . $this->url);
        }

        $json = json_decode($content);

        $symbols = [];
        foreach ($json->symbols as $symbol) {
            if ($symbol->isSpotTradingAllowed && $symbol->status === 'TRADING' && ! $this->isFiatCurrency($symbol)) {
                if (! in_array($symbol->baseAsset, $symbols)) {
                    $symbols[] = $symbol->baseAsset;
                    $cryptocurrencies[] = new Cryptocurrency($symbol->baseAsset);
                }

                if (! in_array($symbol->quoteAsset, $symbols)) {
                    $symbols[] = $symbol->quoteAsset;
                    $cryptocurrencies[] = new Cryptocurrency($symbol->quoteAsset);
                }
            }
        }

        return $cryptocurrencies;
    }

    private function isFiatCurrency($symbol): bool
    {
        return in_array($symbol->baseAsset, self::FIAT_CURRENCIES) || in_array($symbol->quoteAsset, self::FIAT_CURRENCIES);
    }
}
