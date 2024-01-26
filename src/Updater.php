<?php

declare(strict_types=1);

namespace MoneyPHP\CryptoCurrencies;

final class Updater
{
    /**
     * @var Cryptocurrency[]
     */
    private array $allCryptocurrencies;

    public function __construct()
    {
        $this->allCryptocurrencies = [];
    }

    /**
     * @return Cryptocurrency[]
     */
    public function fetchWith(Fetcher $fetcher): array
    {
        $cryptocurrencies = $fetcher->fetch();

        $this->allCryptocurrencies = array_merge($this->allCryptocurrencies, $cryptocurrencies);

        return $cryptocurrencies;
    }

    /**
     * @param Cryptocurrency[] $currencies
     */
    public function writeWith(Writer $writer, array $currencies, string $filename, Serializer $serializer): void
    {
        $writer->write($currencies, $filename, $serializer);
    }
}
