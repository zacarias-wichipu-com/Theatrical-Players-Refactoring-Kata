<?php

declare(strict_types=1);

namespace Theatrical;

readonly class StatementPrinter
{
    public function print(Invoice $invoice, Plays $plays): string
    {
        $statement = new Statement();
        $invoice->fill($statement, $plays);
        return $statement->print();
    }
}
