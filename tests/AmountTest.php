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
        $amount = new Amount(amount: 10.5);
        $amountToAdd = new Amount(amount: 2.5);
        $this->assertEquals(expected: new Amount(amount: 13), actual: $amount->add($amountToAdd));
    }
}
