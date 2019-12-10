<?php

namespace Bowling;

use PHPUnit\Framework\TestCase;
use Bowling\Game;

class GameTest extends TestCase
{
    protected function setUp(): void
    {
        $this->game = new Game();
    }

    protected function getRollsArray(string $rolls): array
    {
        return explode(' ', $rolls);
    }

    protected function executeRolls(string $rolls): void
    {
        $rollsArray = $this->getRollsArray($rolls);
        foreach ($rollsArray as $roll) {
            $this->game->roll($roll);
        }
    }

    public function testShallPass(): void
    {
        $this->assertEquals(1, 1);
    }

    public function test12Strikes(): void
    {
        $rolls = "X X X X X X X X X X X X";
        $this->executeRolls($rolls);

        $this->assertEquals(300, $this->game->score());
    }

    public function test10Pairs(): void
    {
        $rolls = "9- 9- 9- 9- 9- 9- 9- 9- 9- 9-";
        $this->executeRolls($rolls);

        $this->assertEquals(90, $this->game->score());
    }

    public function test5Spare(): void
    {
        $rolls = "5/ 5/ 5/ 5/ 5/ 5/ 5/ 5/ 5/ 5/5";
        $this->executeRolls($rolls);

        $this->assertEquals(150, $this->game->score());
    }
}
