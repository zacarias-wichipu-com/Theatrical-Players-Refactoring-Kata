<?php

declare(strict_types=1);

namespace Theatrical;

use ArrayIterator;
use IteratorAggregate;
use Override;
use Traversable;

final readonly class Performances implements IteratorAggregate
{
    /**
     * @param array<int,Performance> $performances
     */
    public function __construct(
        private array $performances
    ) {
    }

    /**
     * @return Traversable<int,Performance>
     */
    #[Override]
    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->performances);
    }
}
