<?php

declare(strict_types=1);

namespace Theatrical;

final readonly class Credit
{
    public function __construct(
        private int $credit
    ) {
    }

    public function __toString(): string
    {
        return (string) ($this->credit);
    }

    public function add(self $creditToAdd): self
    {
        return new self(credit: $this->credit + $creditToAdd->credit);
    }
}
