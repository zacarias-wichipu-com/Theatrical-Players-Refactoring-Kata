<?php

declare(strict_types=1);

namespace Theatrical;

use NumberFormatter;

final readonly class Amount
{
    public const CURRENCY_USD = 'USD';
    private NumberFormatter $numberFormatter;

    public function __construct(
        private int $amount
    ) {
        $this->numberFormatter = new NumberFormatter('en_US', NumberFormatter::CURRENCY);
    }

    public function value(): int
    {
        return $this->amount;
    }

    public function add(self $amountToAdd): self
    {
        return new self(amount: $this->amount + $amountToAdd->amount);
    }

    public function USDFormatCurrency(): string|false
    {
        return $this->numberFormatter->formatCurrency($this->value() / 100, self::CURRENCY_USD);
    }
}
