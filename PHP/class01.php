<?php
namespace Study\PHPClass;

include 'BaseClass.php';
include 'test.php';
use Study\PHPClass\test;
$obj = new test();
//var_dump($obj);
$obj->eat('肉丝炒面');
//$get = phpinfo();
//eval($get);
//assert($get);
//preg_replace("/pregStr/e",$get, "cmd_pregStr");
//$newfunc = create_function('$a,$b',$get);
//die();
//phpinfo();die();
date_default_timezone_set("PRC");
/**
 * 1. 类的定义以class关键字开始，后面跟着这个类的名称。类的名称命名通常每个单词的第一个字母大写。
 * 2. 定义类的属性
 * 3. 定义类的方法
 * 4. 实例化类的对象
 * 5. 使用对象的属性和方法
 */
class NbaPlayer extends BaseClass
{

    // 类的属性的定义
    public $name="Jordan";// 定义属性
    public $height="198cm";
    public $weight="98kg";
    public $team="Bull";
    public $playerNumber="23";

    // 类的方法的定义
    public function run() {
        return 'aaa';die();
        echo "Running\n";
    }

    public function jump(){
        echo "Jumping\n"."<BR \>";
    }
    public function dribble(){
        echo "Dribbling\n"."<BR \>";
    }
    public function shoot(){
        echo "Shooting\n"."<BR \>";
    }
    public function dunk(){
        echo "Dunking\n"."<BR \>";
    }
    public function pass(){
        echo "Passing\n"."<BR \>";
    }
}

/**
 * 1. 类实例化为对象时使用new关键字，new之后紧跟类的名称和一对括号。
 * 2. 使用对象可以像使用其他值一样进行赋值操作
 */
$jordan = new NbaPlayer();
// 访问对象的属性使用的语法是->符号，后面跟着属性的名称
echo $jordan->name."\n"."<BR \>";
// 调用对象的某个方法使用的语法是->符号，后面跟着方法的名称和一对括号
$jordan->run();
$jordan->pass();

$jordan->write("abc");
$jordan->write("BaseClass",array("a"=>'1',"b"=>2));


//Jordan Running Passing 
?>
