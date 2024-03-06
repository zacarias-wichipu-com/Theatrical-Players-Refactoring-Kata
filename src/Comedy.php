<?php

declare(strict_types=1);

namespace Theatrical;

final readonly class Comedy extends Play
{
    protected function __construct(string $title)
    {
        parent::__construct($title, 'comedy');
    }

    #[\Override] public function amount(int $audience): Amount
    {
        $feeAmount = $this->feeAmount($audience);
        return $feeAmount->add(
            amountToAdd: $this->extraAmountByAudience($audience)
        );
    }

    #[\Override] public function credit(int $audience): Credit
    {
        return new Credit(credit: (int) floor($audience / 5));
    }

    private function feeAmount(int $audience): Amount
    {
        $amount = new Amount(amount: 30000);
        return $amount->add(new Amount(amount: 300 * $audience));
    }

    private function extraAmountByAudience(int $audience): Amount
    {
        if ($audience > 20) {
            return new Amount(amount: 10000 + 500 * ($audience - 20));
        }
        return new Amount(0);
    }
}
