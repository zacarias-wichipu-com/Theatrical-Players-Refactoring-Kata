<?php

declare(strict_types=1);

namespace Theatrical;

final readonly class Credit
{
    public function __construct(private int $credit)
    {
    }

    public function add(Credit $creditToAdd): Credit
    {
        return new Credit(credit: $this->credit + $creditToAdd->credit);
    }

    public function __toString(): string
    {
        return (string)($this->credit);
    }
}
