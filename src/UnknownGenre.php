<?php

declare(strict_types=1);

namespace Theatrical;

use Error;

final readonly class UnknownGenre extends Play
{

    protected function __construct(
        string $title,
        string $genre
    ) {
        parent::__construct(title: $title, genre: $genre);
    }

    #[\Override] public function amount(int $audience): Amount
    {
        throw new Error(sprintf('Unknown <%1$s> genre', $this->genre));
    }

    #[\Override] public function credit(int $audience): Credit
    {
        throw new Error(sprintf('Unknown <%1$s> genre', $this->genre));
    }
}
