<?php

declare(strict_types=1);

namespace Theatrical;

use Error;
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
            $performanceAmount = $this->performanceAmount(performance: $performance, play: $play);
            $performanceOutput = "  {$play->name}: ";
            $performanceOutput .= "{$this->numberFormatter->formatCurrency($performanceAmount->value() / 100, 'USD')} ";
            $performanceOutput .= "({$performance->audience} seats)\n";
            $invoiceAmount = $invoiceAmount->add(amountToAdd: $performanceAmount);
            $invoiceCredit = $invoiceCredit->add(creditToAdd: $performance->credit($play));
            $invoiceOutput .= $performanceOutput;
        }
        $invoiceOutput .= "Amount owed is {$this->numberFormatter ->formatCurrency($invoiceAmount->value() / 100, 'USD')}\n";
        $invoiceOutput .= "You earned {$invoiceCredit} credits";
        return $invoiceOutput;
    }

    private function performanceAmount(Performance $performance, Play $play): Amount
    {
        if ($play->type === 'tragedy') {
            return $performance->tragedyAmount();
        }
        if ($play->type === 'comedy') {
            return $performance->comedyAmount();
        }
        throw new Error("Unknown type: {$play->type}");
    }

}
