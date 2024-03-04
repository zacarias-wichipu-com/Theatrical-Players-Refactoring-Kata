<?php

declare(strict_types=1);

namespace Theatrical;

class Play implements \Stringable
{
    public function __construct(
        public string $name,
        public string $type
    ) {
    }

    public function __toString(): string
    {
        return (string) $this->name . ' : ' . $this->type;
    }

    public function credit(int $audience): Credit
    {
        if ($this->type === 'comedy') {
            return new Credit(credit: (int) floor($audience / 5));
        }
        return new Credit(credit: 0);
    }
}
