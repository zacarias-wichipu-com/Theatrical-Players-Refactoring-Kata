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
        $volumeCredits = 0;
        $credits = new Credits(credits: $volumeCredits);

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

            // add volume credits
            $performanceCreditsByAudience = max($performance->audience - 30, 0);
            $volumeCredits += $performanceCreditsByAudience;
            $credits = $credits->add(new Credits(credits: $performanceCreditsByAudience));
            // add extra credit for every ten comedy attendees
            if ($play->type === 'comedy') {
                $performanceCreditsByType = (int)floor($performance->audience / 5);
                $volumeCredits += $performanceCreditsByType;
                $credits = $credits->add(new Credits(credits: $performanceCreditsByType));
            }

            // print line for this order
            $result .= "  {$play->name}: {$format->formatCurrency($thisAmount / 100, 'USD')} ";
            $result .= "({$performance->audience} seats)\n";

            $totalAmount += $thisAmount;
        }

        $result .= "Amount owed is {$format ->formatCurrency($totalAmount / 100, 'USD')}\n";
        $result .= "You earned {$volumeCredits} credits";

        return $result;
    }
}
