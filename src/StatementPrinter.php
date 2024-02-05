<?php

declare(strict_types=1);

namespace Theatrical;

use Error;
use NumberFormatter;

class StatementPrinter
{
    /**
     * @param array<string, Play> $plays
     */
    public function print(Invoice $invoice, array $plays): string
    {
        $invoiceAmount = new Amount(amount: 0);
        $credit = new Credit(credit: 0);
        $result = "Statement for {$invoice->customer}\n";
        $format = new NumberFormatter('en_US', NumberFormatter::CURRENCY);
        foreach ($invoice->performances as $performance) {
            $play = $plays[$performance->playId];

            switch ($play->type) {
                case 'tragedy':
                    $performanceAmount = new Amount(amount: 40000);
                    $performanceAmount = $performanceAmount->add(
                        amountToAdd: $this->tragedyPerformanceAmount(
                            performance: $performance
                        )
                    );
                    $performanceAmount = $performanceAmount->add(
                        amountToAdd: $this->tragedyPerformanceAudienceAmount(
                            performance: $performance
                        )
                    );
                    break;
                case 'comedy':
                    $performanceAmount = new Amount(amount: 30000);
                    $performanceAmount = $performanceAmount->add(
                        amountToAdd: $this->comedyPerformanceAmount(
                            performance: $performance
                        )
                    );
                    $performanceAmount = $performanceAmount->add(
                        amountToAdd: $this->comedyPerformanceAudienceAmount(
                            performance: $performance
                        )
                    );
                    break;
                default:
                    throw new Error("Unknown type: {$play->type}");
            }
            // add volume credit
            $creditByAudience = new Credit(credit: max($performance->audience - 30, 0));
            $credit = $credit->add($creditByAudience);
            // add extra credit for every ten comedy attendees
            if ($play->type === 'comedy') {
                $creditByType = new Credit(credit: (int)floor($performance->audience / 5));
                $credit = $credit->add($creditByType);
            }
            // print line for this order
            $result .= "  {$play->name}: {$format->formatCurrency($performanceAmount->value() / 100, 'USD')} ";
            $result .= "({$performance->audience} seats)\n";
            $invoiceAmount = $invoiceAmount->add(amountToAdd: $performanceAmount);
        }
        $result .= "Amount owed is {$format ->formatCurrency($invoiceAmount->value() / 100, 'USD')}\n";
        $result .= "You earned {$credit} credits";
        return $result;
    }

    private function tragedyPerformanceAmount(Performance $performance): Amount
    {
        return new Amount(0);
    }

    private function tragedyPerformanceAudienceAmount(Performance $performance): Amount
    {
        return $performance->audience > 30
            ? new Amount(amount: 1000 * ($performance->audience - 30))
            : new Amount(0);
    }

    private function comedyPerformanceAmount(Performance $performance): Amount
    {
        return new Amount(amount: 300 * $performance->audience);
    }

    private function comedyPerformanceAudienceAmount(Performance $performance): Amount
    {
        return $performance->audience > 20
            ? new Amount(amount: 10000 + 500 * ($performance->audience - 20))
            : new Amount(0);
    }
}
