<?php

declare(strict_types=1);

namespace Theatrical;

readonly final class Tragedy extends Play
{
    public function __construct(private string $title)
    {
        parent::__construct(title: $this->title, genre: 'tragedy');
    }
}
