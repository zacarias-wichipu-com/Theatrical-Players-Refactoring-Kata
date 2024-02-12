<?php

declare(strict_types=1);

namespace Theatrical;

readonly class StatementPrinter
{
    public function print(Invoice $invoice, Plays $plays): string
    {
        $invoiceAmount = new Amount(amount: 0);
        $invoiceCredit = new Credit(credit: 0);
        $invoiceOutput = "Statement for {$invoice->customer}\n";
        /** @var Performance $performance */
        foreach ($invoice->performances as $performance) {
            $play = $plays->getById($performance->playId);
            $performanceAmount = $performance->amount($play);
            $performanceOutput = "  {$play->name}: ";
            $performanceOutput .= "{$performanceAmount->USDFormatCurrency()} ";
            $performanceOutput .= "({$performance->audience} seats)\n";
            $invoiceAmount = $invoiceAmount->add(
                amountToAdd: $performance->amount(play: $play)
            );
            $invoiceCredit = $invoiceCredit->add(creditToAdd: $performance->credit($play));
            $invoiceOutput .= $performanceOutput;
        }
        $invoiceOutput .= "Amount owed is {$invoiceAmount->USDFormatCurrency()}\n";
        $invoiceOutput .= "You earned {$invoiceCredit} credits";
        return $invoiceOutput;
    }
}
