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

    /**
     * @test
     * Be Able Representing By A String
     * be_able_representing_by_a_string
     * @group credit
     */
    public function itShouldBeAbleRepresentingByAString(): void
    {
        $credit = new Credit(credit: 10);
        $this->assertEquals(expected: '10', actual: (string)($credit));
    }
}
