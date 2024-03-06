<?php

declare(strict_types=1);

namespace Theatrical;

interface Fillable
{
    public function fill(string $field, mixed $value): void;
}
