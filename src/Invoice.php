<?php

declare(strict_types=1);

namespace Theatrical;

class Invoice
{
    public function __construct(
        public string $customer,
        public Performances $performances
    ) {
    }
}
