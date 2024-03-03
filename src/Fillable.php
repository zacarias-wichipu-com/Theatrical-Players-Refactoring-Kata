<?php

namespace Theatrical;

interface Fillable
{
    public function fill(string $field, mixed $value): void;
}
