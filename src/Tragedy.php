<?php

declare(strict_types=1);

namespace Theatrical;

readonly final class Tragedy extends Play
{
    protected function __construct(private string $title)
    {
        parent::__construct(title: $this->title, genre: 'tragedy');
    }

    #[\Override] public function amount(int $audience): Amount
    {
        $feeAmount = $this->tragedyFeeAmount();
        return $feeAmount->add(
            amountToAdd: $this->tragedyExtraAmountByAudience($audience)
        );
    }

    #[\Override] public function credit(int $audience): Credit
    {
        return new Credit(credit: 0);
    }

    protected function tragedyFeeAmount(): Amount
    {
        return new Amount(amount: 40000);
    }

    protected function tragedyExtraAmountByAudience(int $audience): Amount
    {
        if ($audience > 30) {
            return new Amount(amount: 1000 * ($audience - 30));
        }
        return new Amount(0);
    }
}
