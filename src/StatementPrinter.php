<?php

declare(strict_types=1);

namespace Theatrical;

readonly class StatementPrinter
{
    public function print(Invoice $invoice, Plays $plays): string
    {
        $invoiceAmount = new Amount(amount: 0);
        $invoiceCredit = new Credit(credit: 0);
        $statement = new Statement();
        $invoiceOutput = "Statement for {$invoice->customer}\n";
        $statement->fillCustomer($invoice->customer);
        /** @var Performance $performance */
        foreach ($invoice->performances as $performance) {
            $play = $plays->getById($performance->playId);
            $performanceAmount = $performance->amount($play);
            $performanceOutput = "  {$play->name}: ";
            $performanceOutput .= "{$performanceAmount->USDFormatCurrency()} ";
            $performanceOutput .= "({$performance->audience} seats)\n";
            $statement->fillLine($play->name, $performance->amount($play), $performance->audience);
            $invoiceAmount = $invoiceAmount->add(
                amountToAdd: $performance->amount(play: $play)
            );
            $invoiceCredit = $invoiceCredit->add(creditToAdd: $performance->credit($play));
            $invoiceOutput .= $performanceOutput;
        }
        $invoiceOutput .= "Amount owed is {$invoiceAmount->USDFormatCurrency()}\n";
        $statement->fillAmount($invoiceAmount);
        $invoiceOutput .= "You earned {$invoiceCredit} credits";
        $statement->fillCredit($invoiceCredit);
        $statement->print();
        return $invoiceOutput;
    }
}
