<?php

declare(strict_types=1);

namespace MoneyPHP\CryptoCurrencies;

final class Cryptocurrency
{
    private int $minorUnit;

    public function __construct(private string $symbol)
    {
        $this->minorUnit = 8;
    }

    public function getSymbol(): string
    {
        return $this->symbol;
    }

    public function getMinorUnit(): int
    {
        return $this->minorUnit;
    }
}
