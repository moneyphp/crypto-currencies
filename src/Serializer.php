<?php

declare(strict_types=1);

namespace MoneyPHP\CryptoCurrencies;

interface Serializer
{
    /**
     * @param Cryptocurrency[] $cryptocurrencies
     * @return string
     */
    public function serialize(array $cryptocurrencies): string;

    /**
     * @return string
     */
    public function getFileExtension(): string;
}
