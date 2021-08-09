<?php
$loader = require_once("vendor/autoload.php");
use PHPUnit\Framework\TestCase;

class t1 extends  TestCase {

    public function testPushAndPop() {
        $stack = [];
        $this->assertEquals(0, count($stack));

        array_push($stack, 'foo');
        $this->assertEquals(1, count($stack));
        $this->assertEquals('foo', array_pop($stack));
        $this->assertEquals(0, count($stack));
    }
}


$obj =  new t1();
echo $obj;