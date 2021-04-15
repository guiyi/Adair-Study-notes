<?php
date_default_timezone_set("PRC");
/**
 * 魔术方法3之属性重载
 * 1. 在给不可访问属性赋值时，__set() 会被调用。
 * 2. 读取不可访问属性的值时，__get() 会被调用。
 * 3. 当对不可访问属性调用 isset() 和empty()时，__isset() 会被调用。
 * 4. 当对不可访问属性调用 unset() 时，__unset() 会被调用
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
  // 通过这两个方法可以实现动态的对象属性
  public function __get($name){
    return "Getting the property " . $name;
  }
  public function __set($name, $value){
    echo "Setting the property " . $name . " to value ". $value. "\n<BR \>";
  }

  public function __isset($name){
    echo "__isset invoked\n<BR \>";
    return false;
  }

  public function __unset($name){
    echo "unsetting property " . $name;
  }
}

$obj =  new MagicTest();
echo $obj->name . "\n<BR \>";
$obj->name = "Name Value";
echo '$obj->name is set? '. isset($obj->name) . "\n<BR \>";
echo '$obj->name is empty?' . empty($obj->name) . "\n<BR \>";
unset($obj->name);

/*
Getting the property name
Setting the property name to value Name Value
__isset invoked
$obj->name is set?
__isset invoked
$obj->name is empty?1
unsetting property name
*/