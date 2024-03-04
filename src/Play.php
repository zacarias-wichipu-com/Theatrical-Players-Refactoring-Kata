<?php

declare(strict_types=1);

namespace Theatrical;

use Error;
use Stringable;

class Play implements Stringable
{
    public function __construct(
        public string $name,
        public string $type
    ) {
    }

    public function __toString(): string
    {
        return (string) $this->name . ' : ' . $this->type;
    }

    public function credit(int $audience): Credit
    {
        if ($this->type === 'comedy') {
            return new Credit(credit: (int) floor($audience / 5));
        }
        return new Credit(credit: 0);
    }

    public function amountByGenre(int $audience): Amount
    {
        if ($this->type === 'tragedy') {
            return $this->tragedyAmount($audience);
        }
        if ($this->type === 'comedy') {
            return $this->comedyAmount($audience);
        }
        throw new Error("Unknown type: {$this->type}");
    }

    public function tragedyAmount(int $audience): Amount
    {
        $feeAmount = $this->tragedyFeeAmount();
        return $feeAmount->add(
            amountToAdd: $this->tragedyExtraAmountByAudience($audience)
        );
    }

    public function tragedyFeeAmount(): Amount
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

    public function comedyAmount(int $audience): Amount
    {
        $feeAmount = $this->comedyFeeAmount($audience);
        return $feeAmount->add(
            amountToAdd: $this->comedyExtraAmountByAudience($audience)
        );
    }

    public function comedyFeeAmount(int $audience): Amount
    {
        $amount = new Amount(amount: 30000);
        return $amount->add(new Amount(amount: 300 * $audience));
    }

    public function comedyExtraAmountByAudience(int $audience): Amount
    {
        if ($audience > 20) {
            return new Amount(amount: 10000 + 500 * ($audience - 20));
        }
        return new Amount(0);
    }
}
