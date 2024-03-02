<?php

declare(strict_types=1);

namespace Theatrical;

readonly class StatementPrinter
{
    public function print(Invoice $invoice, Plays $plays): string
    {
        $statement = new Statement();
        $this->fillInvoice($statement, $invoice, $plays);
        return $statement->print();
    }

    private function fillInvoice(Statement $statement, Invoice $invoice, Plays $plays): void
    {
        $invoiceAmount = new Amount(amount: 0);
        $invoiceCredit = new Credit(credit: 0);
        $statement->fillCustomer(customer: $invoice->customer);
        /** @var Performance $performance */
        foreach ($invoice->performances as $performance) {
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
