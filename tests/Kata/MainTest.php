<?php

namespace Kata;

use PHPUnit\Framework\TestCase;
use Kata\Main;

class MainTest extends TestCase
{
    private Main $main;

    protected function setUp(): void
    {
        $this->main = new Main();
    }

    public function testShallPass(): void
    {
        $this->assertEquals(1, 1);
    }

    public function testHandleReturnTrue(): void
    {
        $this->assertEquals(true, $this->main->handle());
    }
}
