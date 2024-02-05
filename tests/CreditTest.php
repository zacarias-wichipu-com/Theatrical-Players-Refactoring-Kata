<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use Theatrical\Credit;

class CreditTest extends TestCase
{
    /**
     * Be Able Add Credit
     * be_able_add_credit
     * @group credits
     */
    public function testItShouldBeAbleAddCredit(): void
    {
        $credit = new Credit(credit: 10);
        $creditToAdd = new Credit(credit: 3);
        $this->assertEquals(expected: new Credit(13), actual: $credit->add($creditToAdd));
    }

    /**
     * Be Able Representing By A String
     * be_able_representing_by_a_string
     * @group credit
     */
    public function testItShouldBeAbleRepresentingByAString(): void
    {
        $credit = new Credit(credit: 10);
        $this->assertEquals(expected: '10', actual: (string) ($credit));
    }
}
