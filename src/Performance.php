<?php

declare(strict_types=1);

namespace Theatrical;

class Performance
{
    public function __construct(
        public string $playId,
        public int $audience
    ) {
    }

    public function credit(Play $play): Credit
    {
        $performanceCredit = new Credit(credit: max($this->audience - 30, 0));
        $creditByType = $this->creditByPlayType($play);
        return $performanceCredit->add($creditByType);
    }

    public function comedyAmount(): Amount
    {
        $performanceAmount = $this->comedyFeeAmount();
        return $performanceAmount->add(
            amountToAdd: $this->comedyExtraAmountByAudience()
        );
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
            return new Credit(credit: (int)floor($this->audience / 5));
        }
        return new Credit(credit: 0);
    }
}
