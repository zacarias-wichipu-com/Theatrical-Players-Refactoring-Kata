<?php

declare(strict_types=1);

namespace Theatrical;

final readonly class Credits
{
    public function __construct(private int $credits)
    {
    }

    public function add(Credits $otherCredits): Credits
    {
        return new Credits(credits: $this->credits + $otherCredits->credits);
    }
}
