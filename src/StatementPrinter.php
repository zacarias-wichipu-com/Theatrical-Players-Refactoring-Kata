<?php

declare(strict_types=1);

namespace Theatrical;

use NumberFormatter;

readonly class StatementPrinter
{
    public const string CURRENCY_USD = 'USD';
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
        /** @var Performance $performance */
        foreach ($invoice->performances as $performance) {
            $play = $plays->getById($performance->playId);
            $performanceOutput = "  {$play->name}: ";
            $performanceOutput .= "{$this->formatCurrencyAmount($performance->amount($play))} ";
            $performanceOutput .= "({$performance->audience} seats)\n";
            $invoiceAmount = $invoiceAmount->add(
                amountToAdd: $performance->amount(play: $play)
            );
            $invoiceCredit = $invoiceCredit->add(creditToAdd: $performance->credit($play));
            $invoiceOutput .= $performanceOutput;
        }
        $invoiceOutput .= "Amount owed is {$this->formatCurrencyAmount($invoiceAmount)}\n";
        $invoiceOutput .= "You earned {$invoiceCredit} credits";
        return $invoiceOutput;
    }

    private function formatCurrencyAmount(Amount $amount): string|false
    {
        return $this->numberFormatter->formatCurrency($amount->value() / 100, self::CURRENCY_USD);
    }
}
