<?php

declare(strict_types=1);

namespace MoneyPHP\CryptoCurrencies;

interface Fetcher
{
    /**
     * @return Cryptocurrency[]
     * @throws \RuntimeException
     */
    public function fetch(): array;
}
