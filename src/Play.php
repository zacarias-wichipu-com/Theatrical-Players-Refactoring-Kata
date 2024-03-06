<?php

declare(strict_types=1);

namespace Theatrical;

use Error;
use Stringable;

readonly class Play implements Stringable
{
    protected function __construct(
        private string $title,
        private string $genre
    ) {
    }

    public static function create(string $title, string $genre): self
    {
        if ($genre === 'comedy') {
            return new Comedy($title);
        }
        return new self(title: $title, genre: $genre);
    }

    public function title(): string
    {
        return $this->title;
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
        throw new Error("Unknown genre: {$this->genre}");
    }

    public function __toString(): string
    {
        return (string) $this->title.' : '.$this->genre;
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

}
