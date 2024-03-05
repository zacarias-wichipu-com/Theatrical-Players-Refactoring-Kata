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

    private function comedyAmountTestData(): array
    {
        return [
            [5, 31500],
            [10, 33000],
            [25, 50000],
            [50, 70000],
        ];
    }

}
