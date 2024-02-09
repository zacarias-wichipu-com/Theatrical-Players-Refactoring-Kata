<?php

declare(strict_types=1);

namespace Theatrical;

use Error;
use NumberFormatter;

class StatementPrinter
{
    public function print(Invoice $invoice, Plays $plays): string
    {
        $invoiceAmount = new Amount(amount: 0);
        $invoiceCredit = new Credit(credit: 0);
        $result = "Statement for {$invoice->customer}\n";
        $format = new NumberFormatter('en_US', NumberFormatter::CURRENCY);
        foreach ($invoice->performances as $performance) {
            $play = $plays->getById($performance->playId);
            $performanceAmount = $this->performanceAmount(performance: $performance, play: $play);
            $performanceCredit = $this->performanceCredit(performance: $performance, play: $play);
            $invoiceAmount = $invoiceAmount->add(amountToAdd: $performanceAmount);
            $invoiceCredit = $invoiceCredit->add(creditToAdd: $performanceCredit);
            $result .= "  {$play->name}: {$format->formatCurrency($performanceAmount->value() / 100, 'USD')} ";
            $result .= "({$performance->audience} seats)\n";
        }
        $result .= "Amount owed is {$format ->formatCurrency($invoiceAmount->value() / 100, 'USD')}\n";
        $result .= "You earned {$invoiceCredit} credits";
        return $result;
    }

    private function performanceAmount(Performance $performance, Play $play): Amount
    {
        if ($play->type === 'tragedy') {
            $performanceAmount = new Amount(amount: 40000);
            $performanceAmount = $performanceAmount->add(amountToAdd: $this->tragedyPerformanceFeeAmount());
            return $performanceAmount->add(
                amountToAdd: $this->tragedyPerformanceExtraAmountByAudience(
                    performance: $performance
                )
            );
        }
        if ($play->type === 'comedy') {
            $performanceAmount = new Amount(amount: 30000);
            $performanceAmount = $performanceAmount->add(
                amountToAdd: $this->comedyPerformanceFeeAmount(
                    performance: $performance
                )
            );
            return $performanceAmount->add(
                amountToAdd: $this->comedyPerformanceExtraAmountByAudience(
                    performance: $performance
                )
            );
        }
        throw new Error("Unknown type: {$play->type}");
    }

    private function tragedyPerformanceFeeAmount(): Amount
    {
        return new Amount(0);
    }

    private function tragedyPerformanceExtraAmountByAudience(Performance $performance): Amount
    {
        if ($performance->audience > 30) {
            return new Amount(amount: 1000 * ($performance->audience - 30));
        }
        return new Amount(0);
    }

    private function comedyPerformanceFeeAmount(Performance $performance): Amount
    {
        return new Amount(amount: 300 * $performance->audience);
    }

    private function comedyPerformanceExtraAmountByAudience(Performance $performance): Amount
    {
        if ($performance->audience > 20) {
            return new Amount(amount: 10000 + 500 * ($performance->audience - 20));
        }
        return new Amount(0);
    }

    private function performanceCredit(Performance $performance, Play $play): Credit
    {
        $performanceCredit = new Credit(credit: max($performance->audience - 30, 0));
        $creditByType = $this->performanceCreditByType($performance, $play);
        return $performanceCredit->add($creditByType);
    }

    private function performanceCreditByType(Performance $performance, Play $play): Credit
    {
        if ($play->type === 'comedy') {
            return new Credit(credit: (int)floor($performance->audience / 5));
        }
        return new Credit(credit: 0);
    }
}
