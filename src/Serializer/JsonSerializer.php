<?php

declare(strict_types=1);

namespace MoneyPHP\CryptoCurrencies\Serializer;

use MoneyPHP\CryptoCurrencies\Serializer;

class JsonSerializer extends AbstractSerializer implements Serializer
{
    /**
     * @inheritDoc
     */
    public function serialize(array $cryptocurrencies): string
    {
        $serialized = $this->prepare($cryptocurrencies);

        $json = json_encode($serialized);

        if ($json === false) {
            throw new \RuntimeException('Failed to serialize cryptocurrencies to JSON');
        }

        return $json;
    }

    /**
     * @inheritDoc
     */
    public function getFileExtension(): string
    {
        return 'json';
    }
}
