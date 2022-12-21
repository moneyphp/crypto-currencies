<?php

declare(strict_types=1);

namespace MoneyPHP\CryptoCurrencies\Fetcher;

use MoneyPHP\CryptoCurrencies\Cryptocurrency;
use MoneyPHP\CryptoCurrencies\Fetcher;

class CoinMarketCapFetcher implements Fetcher
{
    private string $url;

    private string|bool $apiKey;

    public function __construct(string $url)
    {
        $this->apiKey = getenv('COIN_MARKET_CAP_API_KEY', true) ?: getenv('COIN_MARKET_CAP_API_KEY');

        if (empty($this->apiKey)) {
            throw new \InvalidArgumentException('COIN_MARKET_CAP_API_KEY environment variable is not set');
        }

        $this->url = $url . '?CMC_PRO_API_KEY=' . $this->apiKey;
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

        foreach ($json->data as $symbol) {
            if (! in_array($symbol->symbol, $symbols) && $this->containsValidCharacters($symbol->symbol)) {
                $symbols[] = $symbol->symbol;
                $cryptocurrencies[] = new Cryptocurrency($symbol->symbol);
            }
        }

        return $cryptocurrencies;
    }

    /**
     * Few currencies returned by CoinMarketCap are not supported by MoneyPHP.
     * For example, currencies with invalid characters in their symbol, e.g. $ADOGE, .ALPHA or (Δ)
     *
     * @param string $symbol
     * @return bool
     */
    private function containsValidCharacters(string $symbol): bool
    {
        return preg_match('/^[A-Za-z0-9]*$/', $symbol) === 1;
    }
}
