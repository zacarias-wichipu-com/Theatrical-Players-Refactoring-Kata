<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use Theatrical\Credits;

class CreditsTest extends TestCase
{
    /**
     * @test
     * Be Able Add Credits
     * be_able_add_credits
     * @group credits
     */
    public function itShouldBeAbleAddCredits(): void
    {
        $credtis = new Credits(credits: 10);
        $otherCredits = new Credits(credits: 3);
        $this->assertEquals(expected: new Credits(13), actual: $credtis->add($otherCredits));
    }
}
