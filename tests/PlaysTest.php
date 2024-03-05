<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use Theatrical\Play;
use Theatrical\Plays;

class PlaysTest extends TestCase
{
    /**
     * @test
     * Be Able To Return An Item By Its Id
     * be_able_to_return_an_item_by_its_id
     * @group plays
     */
    public function itShouldBeAbleToReturnAnItemByItsId(): void
    {
        $plays = new Plays(
            plays: [
                'henry-v' => Play::create('Henry V', 'history'),
                'as-like' => Play::create('As You Like It', 'comedy'),
            ]
        );
        $this->assertEquals(
            expected: Play::create('As You Like It', 'comedy'),
            actual: $plays->getById('as-like')
        );
    }
}
