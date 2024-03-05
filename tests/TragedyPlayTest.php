<?php

declare(strict_types=1);


use PHPUnit\Framework\TestCase;
use Theatrical\Play;

class TragedyPlayTest extends TestCase
{
    const string GENRE = 'tragedy';
    const string TITLE = 'My Tragedy';

    /**
     * @dataProvider tragedyAmountTestData
     */
    public function testShouldBeAbleToCalculateTragedyAmount(int $audience, int $expectedAmount): void
    {
        $play = Play::create(self::TITLE, self::GENRE);
        $amount = $play->amount($audience);
        $this->assertEquals($expectedAmount, $amount->value());
    }
    /**
     * @dataProvider tragedyCreditTestData
     */
    public function testShouldBeAbleToCalculateTragedyCredit(int $audience, string $expectedCredit): void
    {
        $play = Play::create(self::TITLE, self::GENRE);
        $credit = $play->credit($audience);
        $this->assertEquals($expectedCredit, $credit);
    }

    private function tragedyAmountTestData(): array
    {
        return [
            [5, 40000],
            [10, 40000],
            [25, 40000],
            [50, 60000],
        ];
    }

    private function tragedyCreditTestData(): array
    {
        return [
            [5, '0'],
            [10, '0'],
            [25, '0'],
            [50, '0'],
        ];
    }
}
