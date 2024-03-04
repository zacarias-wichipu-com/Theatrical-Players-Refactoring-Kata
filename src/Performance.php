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
        return $play->amountByGenre($this->audience);
    }

    public function fill(Fillable $fillable, Plays $plays): void
    {
        $play = $plays->getById($this->playId);
        $fillable->fill('line', [
            'name' => $play->name,
            'amount' => $this->amount($plays),
            'audience' => $this->audience,
        ]);
    }
}
