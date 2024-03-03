<?php

declare(strict_types=1);

namespace Theatrical;

final class Statement
{
    private string $customer;
    private array $lines;
    private Amount $amount;
    private Credit $credit;

    public function fillCustomer(string $customer): void
    {
        $this->customer = $customer;
    }

    public function fillLine(string $name, Amount $amount, int $audience): void
    {
        $this->lines[] = [
            'name' => $name,
            'amount' => $amount,
            'audience' => $audience,
        ];
    }

    public function fillAmount(Amount $amount): void
    {
        $this->amount = $amount;
    }

    public function fillCredit(Credit $credit): void
    {
        $this->credit = $credit;
    }

    public function print(): string
    {
        $statement = "Statement for {$this->customer}\n";
        $statement .= $this->printLines();
        $statement .= "Amount owed is {$this->amount->USDFormatCurrency()}\n";
        $statement .= "You earned {$this->credit} credits";
        return $statement;
    }

    public function fill(string $field, mixed $value): void
    {
        $this->fillCustomer($value);
    }

    private function printLines(): string
    {
        return array_reduce(
            array: $this->lines,
            callback: static fn(
                string $carry,
                array $line
            ): string => $carry .= "  {$line['name']}: {$line['amount']->USDFormatCurrency()} ({$line['audience']} seats)\n",
            initial: '');
    }
}
