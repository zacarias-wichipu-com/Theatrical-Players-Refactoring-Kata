<?php

declare(strict_types=1);

namespace Theatrical;

final readonly class Comedy extends Play
{
    protected function __construct(string $title)
    {
        parent::__construct($title, 'comedy');
    }

    public function amount(int $audience): Amount
    {
        return $this->comedyAmount($audience);
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

    public function comedyExtraAmountByAudience(int $audience): Amount
    {
        if ($audience > 20) {
            return new Amount(amount: 10000 + 500 * ($audience - 20));
        }
        return new Amount(0);
    }
}
