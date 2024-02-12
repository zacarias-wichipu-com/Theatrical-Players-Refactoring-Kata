<?php

declare(strict_types=1);

namespace Theatrical;

use NumberFormatter;

readonly class StatementPrinter
{
    private NumberFormatter $numberFormatter;

    public function __construct()
    {
        $this->numberFormatter = new NumberFormatter('en_US', NumberFormatter::CURRENCY);
    }

    public function print(Invoice $invoice, Plays $plays): string
    {
        $invoiceAmount = new Amount(amount: 0);
        $invoiceCredit = new Credit(credit: 0);
        $invoiceOutput = "Statement for {$invoice->customer}\n";
        foreach ($invoice->performances as $performance) {
            $play = $plays->getById($performance->playId);
            $performanceOutput = $this->performanceOutput($performance, $play);
            $invoiceAmount = $invoiceAmount->add(
                amountToAdd: $performance->amount(play: $play)
            );
            $invoiceCredit = $invoiceCredit->add(creditToAdd: $performance->credit($play));
            $invoiceOutput .= $performanceOutput;
        }
        $invoiceOutput .= "Amount owed is {$this->numberFormatter ->formatCurrency($invoiceAmount->value() / 100, 'USD')}\n";
        $invoiceOutput .= "You earned {$invoiceCredit} credits";
        return $invoiceOutput;
    }

    private function performanceOutput(Performance $performance, Play $play): string
    {
        $performanceOutput = "  {$play->name}: ";
        $performanceOutput .= "{$this->numberFormatter->formatCurrency($performance->amount($play)->value() / 100, 'USD')} ";
        $performanceOutput .= "({$performance->audience} seats)\n";
        return $performanceOutput;
    }

}
