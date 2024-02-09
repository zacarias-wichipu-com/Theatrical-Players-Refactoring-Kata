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
            $performanceCredit = $performance->credit($play);
            $performanceOutput = "  {$play->name}: ";
            $performanceOutput .= "{$this->numberFormatter->formatCurrency($performanceAmount->value() / 100, 'USD')} ";
            $performanceOutput .= "({$performance->audience} seats)\n";
            $invoiceAmount = $invoiceAmount->add(amountToAdd: $performanceAmount);
            $invoiceCredit = $invoiceCredit->add(creditToAdd: $performanceCredit);
            $invoiceOutput .= $performanceOutput;
        }
        $invoiceOutput .= "Amount owed is {$this->numberFormatter ->formatCurrency($invoiceAmount->value() / 100, 'USD')}\n";
        $invoiceOutput .= "You earned {$invoiceCredit} credits";
        return $invoiceOutput;
    }

    private function performanceAmount(Performance $performance, Play $play): Amount
    {
        if ($play->type === 'tragedy') {
            return $this->tragedyPerformanceAmount($performance);
        }
        if ($play->type === 'comedy') {
            return $this->comedyPerformanceAmount($performance);
        }
        throw new Error("Unknown type: {$play->type}");
    }

    private function tragedyPerformanceAmount(Performance $performance): Amount
    {
        $performanceAmount = $this->tragedyPerformanceFeeAmount();
        return $performanceAmount->add(
            amountToAdd: $this->tragedyPerformanceExtraAmountByAudience(
                performance: $performance
            )
        );
    }

    private function tragedyPerformanceFeeAmount(): Amount
    {
        return new Amount(amount: 40000);
    }

    private function tragedyPerformanceExtraAmountByAudience(Performance $performance): Amount
    {
        if ($performance->audience > 30) {
            return new Amount(amount: 1000 * ($performance->audience - 30));
        }
        return new Amount(0);
    }

    private function comedyPerformanceAmount(Performance $performance): Amount
    {
        $performanceAmount = $this->comedyPerformanceFeeAmount($performance);
        return $performanceAmount->add(
            amountToAdd: $this->comedyPerformanceExtraAmountByAudience(
                performance: $performance
            )
        );
    }

    private function comedyPerformanceFeeAmount(Performance $performance): Amount
    {
        $performanceAmount = new Amount(amount: 30000);
        return $performanceAmount->add(new Amount(amount: 300 * $performance->audience));
    }

    private function comedyPerformanceExtraAmountByAudience(Performance $performance): Amount
    {
        if ($performance->audience > 20) {
            return new Amount(amount: 10000 + 500 * ($performance->audience - 20));
        }
        return new Amount(0);
    }
}
