<?php

declare(strict_types=1);

namespace MoneyPHP\CryptoCurrencies;

final class Cryptocurrency
{
    /**
     * @var string $symbol
     */
    private string $symbol;

    /**
     * @var int $minorUnit
     */
    private int $minorUnit;

    public function __construct(string $symbol)
    {
        $this->symbol = $symbol;
        $this->minorUnit = 8;
    }

    /**
     * @return string
     */
    public function getSymbol(): string
    {
        return $this->symbol;
    }

    /**
     * @return int
     */
    public function getMinorUnit(): int
    {
        return $this->minorUnit;
    }
}
