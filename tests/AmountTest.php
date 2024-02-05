<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use Theatrical\Amount;

class AmountTest extends TestCase
{
    /**
     * @test
     * Be Able Add Amount
     * be_able_add_amount
     * @group amount
     */
    public function itShouldBeAbleAddAmount(): void
    {
        $amount = new Amount(amount: 10);
        $amountToAdd = new Amount(amount: 2);
        $this->assertEquals(expected: new Amount(amount: 12), actual: $amount->add($amountToAdd));
    }
}
