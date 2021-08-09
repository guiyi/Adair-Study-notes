<?php
date_default_timezone_set("PRC");

class Human{

public $name;
protected $height; // 只有自身和子类可以访问到
public $weight;
private $isHungry=true; // 只有自身可以访问到

public static $sValue="Static Value in Human". "\n<BR \>";
public const constValue="const Value in Human". "\n<BR \>";
public static $nums= 10;

function getStaticvar(){
	$arr = array(
		'a'=>self::$sValue,
		'b'=>self::constValue,
		'c'=>static::$sValue,
		'd'=>static::constValue,
	);
   return $arr;
}

public function eat($food){
    echo $this->name . "'s eating ". $food. "\n<BR \>";
}

public function info(){
    print "HUMAN: " . $this->name . ";" . $this->height . ";" . $this->weight . ";" . $this->isHungry ."\n<BR \>";
}

public function __destruct(){

	echo "This is __destory function!";

}

public static function getNum(){
    // 静态方法
    // echo $this->age;  // 报错，静态方法里面不能操作非静态属性
    echo '真的吗？'.self::$nums."\n<BR \>";    //静态方法中只能操作静态属性 
}

}

$info = new Human;
//访问静态变量
echo Human::$sValue;// 类可直接访问静态变量
echo Human::constValue;
echo $info::$sValue; // 对象实例可以这样访问静态属性

var_dump($info->getStaticvar()) ;
//访问静态方法
$info::getNum();// 对象实例可以这样访问静态属性
Human::getNum();// 类可直接访问静态方法
$info->getNum();// 对象实例可以这样访问静态方法
$info->eat('apple');