<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use Theatrical\Play;

class ComedyPlayTest extends TestCase
{
    /**
     * @dataProvider comedyAmountTestData
     */
    public function testShouldBeAbleToCalculateComedyAmount(int $audience, int $expectedAmount): void
    {
        $play = new Play('My Comedy', 'comedy');
        $amount = $play->amount($audience);
        $this->assertEquals($expectedAmount, $amount->value());
    }
    /**
     * @dataProvider comedyCreditTestData
     */
    public function testShouldBeAbleToCalculateComedyCredit(int $audience, string $expectedCredit): void
    {
        $play = new Play('My Comedy', 'comedy');
        $credit = $play->credit($audience);
        $this->assertEquals($expectedCredit, $credit);
    }

    private function comedyAmountTestData(): array
    {
        return [
            [5, 31500],
            [10, 33000],
            [25, 50000],
            [50, 70000],
        ];
    }

    private function comedyCreditTestData(): array
    {
        return [
            [5, '1'],
            [10, '2'],
            [25, '5'],
            [50, '10'],
        ];
    }
}
