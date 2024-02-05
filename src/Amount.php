<?php

declare(strict_types=1);

namespace Theatrical;

final readonly class Amount
{
    public function __construct(private float $amount)
    {
    }

    public function add(Amount $amountToAdd): Amount
    {
        return new Amount(amount: $this->amount + $amountToAdd->amount);
    }
}
