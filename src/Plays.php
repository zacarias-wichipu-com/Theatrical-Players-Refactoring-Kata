<?php

declare(strict_types=1);

namespace Theatrical;

final readonly class Plays
{
    /**
     * @param  array<string, Play> $plays
     */
    public function __construct(
        private array $plays
    ) {
    }

    public function getById(string $id): Play
    {
        return $this->plays[$id];
    }
}
