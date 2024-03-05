<?php

declare(strict_types=1);

namespace Theatrical;

final readonly class Performance
{
    public function __construct(
        private string $playId,
        private int $audience
    ) {
    }

    public function credit(Plays $plays): Credit
    {
        $play = $plays->getById($this->playId);
        $performanceCredit = new Credit(credit: max($this->audience - 30, 0));
        return $performanceCredit->add($play->credit($this->audience));
    }

    public function amount(Plays $plays): Amount
    {
        $play = $plays->getById($this->playId);
        return $play->amount($this->audience);
    }

    public function fill(Fillable $fillable, Plays $plays): void
    {
        $fillable->fill('line', [
            'name' => $this->playTitle($plays),
            'amount' => $this->amount($plays),
            'audience' => $this->audience,
        ]);
    }

    private function playTitle(Plays $plays): string
    {
        $play = $plays->getById($this->playId);
        return $play->title();
    }
}
