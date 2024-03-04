<?php

declare(strict_types=1);

namespace Theatrical;

use Error;
use Stringable;

class Play implements Stringable
{
    public function __construct(
        public string $name,
        private string $genre
    ) {
    }

    public function __toString(): string
    {
        return (string) $this->name . ' : ' . $this->genre;
    }

    public function credit(int $audience): Credit
    {
        if ($this->genre === 'comedy') {
            return new Credit(credit: (int) floor($audience / 5));
        }
        return new Credit(credit: 0);
    }

    public function amount(int $audience): Amount
    {
        if ($this->genre === 'tragedy') {
            return $this->tragedyAmount($audience);
        }
        if ($this->genre === 'comedy') {
            return $this->comedyAmount($audience);
        }
        throw new Error("Unknown type: {$this->genre}");
    }

    private function tragedyAmount(int $audience): Amount
    {
        $feeAmount = $this->tragedyFeeAmount();
        return $feeAmount->add(
            amountToAdd: $this->tragedyExtraAmountByAudience($audience)
        );
    }

    private function tragedyFeeAmount(): Amount
    {
        return new Amount(amount: 40000);
    }

    private function tragedyExtraAmountByAudience(int $audience): Amount
    {
        if ($audience > 30) {
            return new Amount(amount: 1000 * ($audience - 30));
        }
        return new Amount(0);
    }

    private function comedyAmount(int $audience): Amount
    {
        $feeAmount = $this->comedyFeeAmount($audience);
        return $feeAmount->add(
            amountToAdd: $this->comedyExtraAmountByAudience($audience)
        );
    }

    private function comedyFeeAmount(int $audience): Amount
    {
        $amount = new Amount(amount: 30000);
        return $amount->add(new Amount(amount: 300 * $audience));
    }

    private function comedyExtraAmountByAudience(int $audience): Amount
    {
        if ($audience > 20) {
            return new Amount(amount: 10000 + 500 * ($audience - 20));
        }
        return new Amount(0);
    }
}
