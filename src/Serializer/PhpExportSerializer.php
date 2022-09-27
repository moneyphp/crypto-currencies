<?php

declare(strict_types=1);

namespace MoneyPHP\CryptoCurrencies\Serializer;

use MoneyPHP\CryptoCurrencies\Serializer;

class PhpExportSerializer extends AbstractSerializer implements Serializer
{
    /**
     * @inheritDoc
     */
    public function serialize(array $cryptocurrencies): string
    {
        $serialized = $this->prepare($cryptocurrencies);

        return '<?php return '.var_export($serialized, true).';';
    }

    /**
     * @inheritDoc
     */
    public function getFileExtension(): string
    {
        return 'php';
    }
}
