<?php

declare(strict_types=1);

namespace Theatrical;

final class Statement implements Fillable
{
    private array $values = [];

    public function fill(string $field, mixed $value): void
    {
        match ($field) {
            'customer' => $this->values['customer'] = $value,
            'amount' => $this->values['amount'] = $value->USDFormatCurrency(),
            'credit' => $this->values['credit'] = $value,
            'line' => $this->values['lines'][] = [
                'name' => $value['name'],
                'amount' => $value['amount']->USDFormatCurrency(),
                'audience' => $value['audience'],
            ],
        };
    }

    public function print(): string
    {
        $statement = "Statement for {$this->values['customer']}\n";
        $statement .= $this->printLines();
        $statement .= "Amount owed is {$this->values['amount']}\n";
        $statement .= "You earned {$this->values['credit']} credits";
        return $statement;
    }

    private function printLines(): string
    {
        return array_reduce(
            array: $this->values['lines'],
            callback: static fn (
                string $carry,
                array $line
            ): string => $carry .= "  {$line['name']}: {$line['amount']} ({$line['audience']} seats)\n",
            initial: ''
        );
    }
}
