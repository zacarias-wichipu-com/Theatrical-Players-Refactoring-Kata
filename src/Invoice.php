<?php

declare(strict_types=1);

namespace Theatrical;

final readonly class Invoice
{
    public function __construct(
        private string $customer,
        private Performances $performances
    ) {
    }

    public function fill(Statement $statement, Plays $plays): void
    {
        $statement->fill(field: 'customer', value: $this->customer);
        foreach ($this->performances as $performance) {
            $performance->fill($statement, $plays);
        }
        $statement->fill(field: 'amount', value: $this->amount($plays));
        $statement->fill(field: 'credit', value: $this->credit($plays));
    }

    private function amount(Plays $plays): Amount {
        $invoiceAmount = new Amount(amount: 0);
        foreach ($this->performances as $performance) {
            $invoiceAmount = $invoiceAmount->add(amountToAdd: $performance->amount(plays: $plays));
        }
        return $invoiceAmount;
    }

    private function credit(Plays $plays): Credit
    {
        $invoiceCredit = new Credit(credit: 0);
        foreach ($this->performances as $performance) {
            $invoiceCredit = $invoiceCredit->add(creditToAdd: $performance->credit(plays: $plays));
        }
        return $invoiceCredit;
    }
}
