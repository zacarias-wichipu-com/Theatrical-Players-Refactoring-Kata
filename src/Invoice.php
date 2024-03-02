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
        $statement->fillCustomer(customer: $this->customer);
        foreach ($this->performances as $performance) {
            $play = $plays->getById($performance->playId);
            $statement->fillLine(name: $play->name, amount: $performance->amount($play), audience: $performance->audience);
        }
        $statement->fillAmount(amount: $this->amount($plays));
        $statement->fillCredit(credit: $this->credit($plays));
    }

    private function amount(Plays $plays): Amount {
        $invoiceAmount = new Amount(amount: 0);
        foreach ($this->performances as $performance) {
            $play = $plays->getById($performance->playId);
            $invoiceAmount = $invoiceAmount->add(amountToAdd: $performance->amount(play: $play));
        }
        return $invoiceAmount;
    }

    private function credit(Plays $plays): Credit
    {
        $invoiceCredit = new Credit(credit: 0);
        foreach ($this->performances as $performance) {
            $play = $plays->getById($performance->playId);
            $invoiceCredit = $invoiceCredit->add(creditToAdd: $performance->credit($play));
        }
        return $invoiceCredit;
    }
}
