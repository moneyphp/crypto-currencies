<?php

namespace MoneyPHP\CryptoCurrencies;

final class Writer
{
    /**
     * @param Cryptocurrency[] $currencies
     */
    public function write(array $currencies, string $filename, Serializer $serializer): void
    {
        file_put_contents(__DIR__ . '/../resources/' . $filename . '.' . $serializer->getFileExtension(), $serializer->serialize($currencies));
    }
}
