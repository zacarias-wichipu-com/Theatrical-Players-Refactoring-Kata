<?php

declare(strict_types=1);

namespace Theatrical;

final readonly class Comedy extends Play
{
    private function __construct(string $title)
    {
        parent::__construct($title, 'comedy');
    }
}
