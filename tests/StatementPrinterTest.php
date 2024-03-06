<?php

declare(strict_types=1);

namespace Tests;

use ApprovalTests\Approvals;
use Error;
use PHPUnit\Framework\TestCase;
use Theatrical\Invoice;
use Theatrical\Performance;
use Theatrical\Performances;
use Theatrical\Play;
use Theatrical\Plays;
use Theatrical\StatementPrinter;

final class StatementPrinterTest extends TestCase
{
    public function testCanPrintInvoice(): void
    {
        $plays = [
            'hamlet' => Play::create('Hamlet', 'tragedy'),
            'as-like' => Play::create('As You Like It', 'comedy'),
            'othello' => Play::create('Othello', 'tragedy'),
        ];
        $performances = [
            new Performance('hamlet', 55),
            new Performance('as-like', 35),
            new Performance('othello', 40),
        ];
        $invoice = new Invoice(customer: 'BigCo', performances: new Performances($performances));
        $statementPrinter = new StatementPrinter();
        $result = $statementPrinter->print(invoice: $invoice, plays: new Plays($plays));
        Approvals::verifyString($result);
    }

    public function testNewPlayTypes(): void
    {
        $plays = [
            'henry-v' => Play::create('Henry V', 'history'),
            'as-like' => Play::create('As You Like It', 'comedy'),
        ];
        $performances = [
            new Performance('henry-v', 53),
            new Performance('as-like', 55),
        ];
        $invoice = new Invoice(customer: 'BigCo', performances: new Performances($performances));
        $statementPrinter = new StatementPrinter();
        $this->expectException(Error::class);
        $statementPrinter->print(invoice: $invoice, plays: new Plays($plays));
    }
}
