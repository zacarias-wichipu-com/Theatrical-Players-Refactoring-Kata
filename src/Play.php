<?php

declare(strict_types=1);

namespace Theatrical;

use Error;
use Stringable;

readonly class Play implements Stringable
{
    protected function __construct(
        private string $title,
        private string $genre
    ) {
    }

    public static function create(string $title, string $genre): self
    {
        return match ($genre) {
            'comedy' => new Comedy(title: $title),
            'tragedy' => new Tragedy(title: $title),
            default => new self(title: $title, genre: $genre)
        };
    }

    public function title(): string
    {
        return $this->title;
    }
    public function __toString(): string
    {
        return (string) $this->title.' : '.$this->genre;
    }
}
