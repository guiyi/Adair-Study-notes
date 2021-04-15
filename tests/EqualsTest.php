<?php
 
use PHPUnit\Framework\TestCase;
 
class EqualsTest extends TestCase {
    public function testFailure()
    {
        $this->assertEquals(1, 0);
    }
 
    public function testFailure2()
    {
        $this->assertEquals('bar', 'baz');
    }
 
    public function testFailure3()
    {
        $this->assertEquals("foo\nbar\nbaz\n", "foo\nbah\nbaz\n");
    }
}
