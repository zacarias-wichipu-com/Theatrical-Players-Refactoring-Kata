<?php

declare(strict_types=1);

namespace Theatrical;

final class Statement
{
    public function fillCustomer(string $customer): void
    {
    }

    public function fillLine(string $name, Amount $amount, int $audience): void
    {
    }

    public function fillAmount(Amount $invoiceAmount): void
    {
    }

    public function fillCredit(Credit $invoiceCredit): void
    {
    }

    public function print(): void
    {
    }
}
