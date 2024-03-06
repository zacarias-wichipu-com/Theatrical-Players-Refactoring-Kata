<?php

declare(strict_types=1);

namespace Theatrical;

readonly abstract class Play
{
    protected function __construct(
        private string $title,
        protected string $genre
    ) {
    }

    public static function create(string $title, string $genre): self
    {
        return match ($genre) {
            'comedy' => new Comedy(title: $title),
            'tragedy' => new Tragedy(title: $title),
            default => new UnknownGenre($title, $genre)
        };
    }

    abstract public function amount(int $audience): Amount;
    abstract public function credit(int $audience): Credit;
    public function title(): string
    {
        return $this->title;
    }
}
