<?php

declare(strict_types=1);

namespace MoneyPHP\Cryptocurrencies;

interface Fetcher
{
    /**
     * @return Cryptocurrency[]
     * @throws \RuntimeException
     */
    public function fetch(): array;
}
