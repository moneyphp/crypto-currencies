<?php

declare(strict_types=1);

namespace MoneyPHP\CryptoCurrencies\Serializer;

use MoneyPHP\CryptoCurrencies\Cryptocurrency;

class AbstractSerializer
{
    /**
     * @param Cryptocurrency[] $cryptocurrencies
     * @return array<string, array{symbol: string, minorUnit: int}>
     */
    protected function prepare(array $cryptocurrencies): array
    {
        $serialized = [];
        foreach ($cryptocurrencies as $cryptocurrency) {
            $serialized[$cryptocurrency->getSymbol()] = [
                'symbol' => $cryptocurrency->getSymbol(),
                'minorUnit' => $cryptocurrency->getMinorUnit(),
            ];
        }

        \ksort($serialized);

        return $serialized;
    }
}
