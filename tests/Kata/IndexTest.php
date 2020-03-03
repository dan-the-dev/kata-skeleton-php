<?php

namespace Kata;

use PHPUnit\Framework\TestCase;
use Kata\Index;

class IndexTest extends TestCase
{
    protected function setUp(): void
    {
        $this->index = new Index();
    }

    public function testShallPass(): void
    {
        $this->assertEquals(1, 1);
    }

    public function testHandleReturnTrue(): void
    {
        $this->assertEquals(true, $this->index->handle());
    }
}
