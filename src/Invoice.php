<?php

declare(strict_types=1);

namespace Theatrical;

class Invoice
{
    public function __construct(
        public string $customer,
        public Performances $performances
    ) {
    }

    public function fill(Statement $statement, Plays $plays): void
    {
        $invoiceAmount = new Amount(amount: 0);
        $invoiceCredit = new Credit(credit: 0);
        $statement->fillCustomer(customer: $this->customer);
        /** @var Performance $performance */
        foreach ($this->performances as $performance) {
            $play = $plays->getById($performance->playId);
            $invoiceAmount = $invoiceAmount->add(amountToAdd: $performance->amount(play: $play));
            $invoiceCredit = $invoiceCredit->add(creditToAdd: $performance->credit($play));
            $statement->fillLine(name: $play->name, amount: $performance->amount($play),
                audience: $performance->audience);
        }
        $statement->fillAmount(amount: $invoiceAmount);
        $statement->fillCredit(credit: $invoiceCredit);
    }
}
