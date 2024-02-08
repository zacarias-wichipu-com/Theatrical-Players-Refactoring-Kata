<?php

declare(strict_types=1);

namespace Theatrical;

use ArrayIterator;
use IteratorAggregate;
use Override;
use Traversable;

final readonly class Performances implements IteratorAggregate
{
    public function __construct(private array $performances)
    {
    }

    #[Override] public function getIterator(): Traversable
    {
        return new ArrayIterator($this->performances);
    }
}
