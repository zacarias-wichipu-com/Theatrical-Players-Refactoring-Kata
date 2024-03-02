<?php

declare(strict_types=1);

namespace Theatrical;

final class Statement
{
    private string $customer;
    private array $lines;

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

    public function fillAmount(Amount $invoiceAmount): void
    {
    }

    public function fillCredit(Credit $invoiceCredit): void
    {
    }

    public function print(): string
    {
        $statement = "Statement for {$this->customer}\n";
        $statement .= $this->printLines();
        return $statement;
    }

    private function printLines(): string
    {
        return array_reduce(
            array: $this->lines,
            callback: fn(string $carry, array $line): string => $carry .= "  {$line['name']}: {$line['amount']->USDFormatCurrency()} ({$line['audience']} seats)\n",
            initial: '');
    }
}
