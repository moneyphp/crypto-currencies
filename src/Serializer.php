<?php

declare(strict_types=1);

namespace MoneyPHP\CryptoCurrencies;

interface Serializer
{
    /**
     * @param Cryptocurrency[] $cryptocurrencies
     */
    public function serialize(array $cryptocurrencies): string;

    public function getFileExtension(): string;
}
