<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use Theatrical\Credit;

class CreditTest extends TestCase
{
    /**
     * @test
     * Be Able Add Credit
     * be_able_add_credit
     * @group credits
     */
    public function itShouldBeAbleAddCredit(): void
    {
        $credit = new Credit(credit: 10);
        $creditToAdd = new Credit(credit: 3);
        $this->assertEquals(expected: new Credit(13), actual: $credit->add($creditToAdd));
    }
}
