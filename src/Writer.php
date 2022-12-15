<?php

namespace MoneyPHP\Cryptocurrencies;

final class Writer
{
    /**
     * @param Cryptocurrency[] $currencies
     * @param string $filename
     * @param Serializer $serializer
     * @return void
     */
    public function write(array $currencies, string $filename, Serializer $serializer): void
    {
        file_put_contents(__DIR__ . '/../resources/' . $filename . '.' . $serializer->getFileExtension(), $serializer->serialize($currencies));
    }
}