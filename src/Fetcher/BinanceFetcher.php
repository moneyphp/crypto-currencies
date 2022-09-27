<?php

declare(strict_types=1);

namespace MoneyPHP\CryptoCurrencies\Fetcher;

use MoneyPHP\CryptoCurrencies\Cryptocurrency;
use MoneyPHP\CryptoCurrencies\Fetcher;

class BinanceFetcher implements Fetcher
{
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
            if ($symbol->isSpotTradingAllowed && $symbol->status === 'TRADING') {
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
}
