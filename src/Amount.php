<?php

declare(strict_types=1);

namespace Theatrical;

final readonly class Amount
{
    public function __construct(
        private int $amount
    ) {
    }

    public function value(): int
    {
        return $this->amount;
    }

    public function add(self $amountToAdd): self
    {
        return new self(amount: $this->amount + $amountToAdd->amount);
    }
}
