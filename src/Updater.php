<?php

declare(strict_types=1);

namespace MoneyPHP\Cryptocurrencies;

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
     * @param Fetcher $fetcher
     * @return Cryptocurrency[]
     */
    public function fetchWith(Fetcher $fetcher): array
    {
        $cryptocurrencies = $fetcher->fetch();

        $this->allCryptocurrencies = array_merge($this->allCryptocurrencies, $cryptocurrencies);

        return $cryptocurrencies;
    }

    /**
     * @param Writer $writer
     * @param Cryptocurrency[] $currencies
     * @param string $filename
     * @param Serializer $serializer
     * @return void
     */
    public function writeWith(Writer $writer, array $currencies, string $filename, Serializer $serializer): void
    {
        $writer->write($currencies, $filename, $serializer);
    }
}
