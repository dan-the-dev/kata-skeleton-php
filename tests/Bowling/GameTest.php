<?php
namespace Bowling;

use PHPUnit\Framework\TestCase;

class GameTest extends TestCase
{
    public function testShallPass(): void
    {
        $this->assertEquals(1, 1);
    }
}
