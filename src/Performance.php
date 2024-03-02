<?php

declare(strict_types=1);

namespace Theatrical;

use Error;

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
        $creditByType = $this->creditByPlayType($play);
        return $performanceCredit->add($creditByType);
    }

    public function amount(Plays $plays): Amount
    {
        $play = $plays->getById($this->playId);
        if ($play->type === 'tragedy') {
            return $this->tragedyAmount();
        }
        if ($play->type === 'comedy') {
            return $this->comedyAmount();
        }
        throw new Error("Unknown type: {$play->type}");
    }

    public function fill(Statement $statement, Plays $plays): void
    {
        $play = $plays->getById($this->playId);
        $statement->fillLine(name: $play->name, amount: $this->amount($plays), audience: $this->audience);
    }

    private function comedyAmount(): Amount
    {
        $performanceAmount = $this->comedyFeeAmount();
        return $performanceAmount->add(
            amountToAdd: $this->comedyExtraAmountByAudience()
        );
    }

    private function tragedyAmount(): Amount
    {
        $performanceAmount = $this->tragedyFeeAmount();
        return $performanceAmount->add(
            amountToAdd: $this->tragedyExtraAmountByAudience()
        );
    }

    private function tragedyFeeAmount(): Amount
    {
        return new Amount(amount: 40000);
    }

    private function tragedyExtraAmountByAudience(): Amount
    {
        if ($this->audience > 30) {
            return new Amount(amount: 1000 * ($this->audience - 30));
        }
        return new Amount(0);
    }

    private function comedyFeeAmount(): Amount
    {
        $performanceAmount = new Amount(amount: 30000);
        return $performanceAmount->add(new Amount(amount: 300 * $this->audience));
    }

    private function comedyExtraAmountByAudience(): Amount
    {
        if ($this->audience > 20) {
            return new Amount(amount: 10000 + 500 * ($this->audience - 20));
        }
        return new Amount(0);
    }

    private function creditByPlayType(Play $play): Credit
    {
        if ($play->type === 'comedy') {
            return new Credit(credit: (int) floor($this->audience / 5));
        }
        return new Credit(credit: 0);
    }
}
