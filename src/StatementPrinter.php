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
        $totalAmount = 0;
        $amount = new Amount(amount: $totalAmount);
        $credit = new Credit(credit: 0);

        $result = "Statement for {$invoice->customer}\n";
        $format = new NumberFormatter('en_US', NumberFormatter::CURRENCY);

        foreach ($invoice->performances as $performance) {
            $play = $plays[$performance->playId];

            switch ($play->type) {
                case 'tragedy':
                    $thisAmount = 40000;
                    if ($performance->audience > 30) {
                        $thisAmount += 1000 * ($performance->audience - 30);
                    }
                    break;

                case 'comedy':
                    $thisAmount = 30000;
                    if ($performance->audience > 20) {
                        $thisAmount += 10000 + 500 * ($performance->audience - 20);
                    }
                    $thisAmount += 300 * $performance->audience;
                    break;

                default:
                    throw new Error("Unknown type: {$play->type}");
            }

            // add volume credit
            $performanceCreditByAudience = max($performance->audience - 30, 0);
            $credit = $credit->add(new Credit(credit: $performanceCreditByAudience));
            // add extra credit for every ten comedy attendees
            if ($play->type === 'comedy') {
                $performanceCreditByType = (int)floor($performance->audience / 5);
                $credit = $credit->add(new Credit(credit: $performanceCreditByType));
            }

            // print line for this order
            $result .= "  {$play->name}: {$format->formatCurrency($thisAmount / 100, 'USD')} ";
            $result .= "({$performance->audience} seats)\n";

            $totalAmount += $thisAmount;
            $amount = $amount->add(amountToAdd: new Amount(amount: $thisAmount));
        }

        $result .= "Amount owed is {$format ->formatCurrency($totalAmount / 100, 'USD')}\n";
        $result .= "You earned {$credit} credits";

        return $result;
    }
}
