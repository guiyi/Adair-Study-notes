<?php
date_default_timezone_set("PRC");
/**
 * 魔术方法2之方法重载
 * 1. 当对象访问不存在的方法名称时，__call()方法会被自动调用
 * 2. 当对象访问不存在的静态方法名称时，__callStatic()方法会被自动调用
 */
class MagicTest{
  public function __tostring(){
    return "This is the Class MagicTest.\n<BR \>";
  }
  public function __invoke($x){
    echo "__invoke called with parameter " . $x . "\n<BR \>";
  }
  public function __call($name, $arguments){
    echo "Calling " . $name . " with parameters: " . implode(', ', $arguments) . "\n<BR \>";
  }

  public static function __callStatic($name, $arguments){
    echo "Static calling " . $name . " with parameters: " . implode(', ', $arguments) . "\n<BR \>";
  }
}

$obj =  new MagicTest();
echo $obj;
$obj->runTest("para1", "para2");
MagicTest::runTest("para3","para4");



/*
rst:
Calling runTest with parameters: para1, para2
Static calling runTest with parameters: para3, para4
*/