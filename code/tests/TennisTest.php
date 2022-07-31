<?php

use PHPUnit\Framework\TestCase;
use Root\Code\Tennis;

class TennisTest extends TestCase
{
    private Tennis $tennis;

    public function testLoveAll(): void
    {
        $this->scoreShouldBe('Love All');
    }

    public function testFifteenLove(): void
    {
        $this->tennis->firstPlayerScore();
        $this->scoreShouldBe('Fifteen Love');
    }

    public function testThirtyLove(): void
    {
        $this->givenFirstPlayerScoreTimes(2);
        $this->scoreShouldBe('Thirty Love');
    }

    public function testFortyLove(): void
    {
        $this->givenFirstPlayerScoreTimes(3);
        $this->scoreShouldBe('Forty Love');
    }

    public function testLoveFifteen(): void
    {
        $this->tennis->secondPlayerScore();
        $this->scoreShouldBe('Love Fifteen');
    }

    public function testLoveThirty(): void
    {
        $this->givenSecondPlayerScoreTimes(2);
        $this->scoreShouldBe('Love Thirty');
    }

    public function testFifteenAll(): void
    {
        $this->givenFirstPlayerScoreTimes(1);
        $this->givenSecondPlayerScoreTimes(1);
        $this->scoreShouldBe('Fifteen All');
    }

    public function testThirtyAll(): void
    {
        $this->givenFirstPlayerScoreTimes(2);
        $this->givenSecondPlayerScoreTimes(2);
        $this->scoreShouldBe('Thirty All');
    }

    public function testDeuce(): void
    {
        $this->isDeuce();
        $this->scoreShouldBe('Deuce');
    }

    public function testFirstPlayerAdv(): void
    {
        $this->isDeuce();
        $this->givenFirstPlayerScoreTimes(1);
        $this->scoreShouldBe('Murphy Adv');
    }

    public function testSecondPlayerAdv(): void
    {
        $this->isDeuce();
        $this->givenSecondPlayerScoreTimes(1);
        $this->scoreShouldBe('Peter Adv');
    }

    public function testSecondPlayerWin(): void
    {
        $this->isDeuce();
        $this->givenSecondPlayerScoreTimes(2);
        $this->scoreShouldBe('Peter Win');
    }

    /**
     * @param $expected
     * @return void
     */
    private function scoreShouldBe($expected): void
    {
        $this->assertEquals($expected, $this->tennis->score());
    }

    protected function setUp(): void
    {
        $this->tennis = new Tennis('Murphy', 'Peter');
    }

    /**
     * @param $times
     * @return void
     */
    private function givenFirstPlayerScoreTimes($times): void
    {
        for ($i = 0; $i < $times; $i++) {
            $this->tennis->firstPlayerScore();
        }
    }

    /**
     * @param $times
     * @return void
     */
    private function givenSecondPlayerScoreTimes($times): void
    {
        for ($i = 0; $i < $times; $i++) {
            $this->tennis->secondPlayerScore();
        }
    }

    /**
     * @return void
     */
    private function isDeuce(): void
    {
        $this->givenFirstPlayerScoreTimes(3);
        $this->givenSecondPlayerScoreTimes(3);
    }
}
