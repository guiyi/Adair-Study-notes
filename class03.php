<?php
namespace Study\PHPClass;

require 'composer/vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
// create a log channel
$log = new Logger('Study');
$log->pushHandler(new StreamHandler('/tmp/your.log', Logger::WARNING));

date_default_timezone_set("PRC");
/**
 * 1. 对象引用的概念：对象的引用是访问对象属性和方法的媒介
 * 2. 引用赋值会产生一个新的对象引用
 * 3. 使用&进行引用赋值不会产生新的引用，而是产生了引用的一个复制品
 * 4. 当指向对象的所有引用都被设为null时，对象的析构函数才被自动调用
 *    在PHP 中引用的意思是：不同的名字访问同一个变量内容。
 */

class NbaPlayer
{
    // 类的属性的定义
    public $name="Jordan";// 定义属性
    public $height="198cm";
    public $weight="98kg";
    public $team="Bull";
    public $playerNumber="23";

    // 默认的构造函数，在对象被实例化的时候自动调用
    /*function __construct() {
       print "In NbaPlayer constructor\n";
    }*/

    // 构造函数通常用于初始化对象的属性值
    function __construct($name, $height, $weight, $team, $playerNumber) {
        print $name . ";" . $height . ";" . $weight . ";" . $team . ";" . $playerNumber."\n<BR \>";
       $this->name = $name; // $this是php里面的伪变量，表示对象自身
       $this->height = $height; // 通过$this可以设置对象的属性值
       $this->weight = $weight;
       $this->team = $team;
       $this->playerNumber = $playerNumber;
    }

    // 析构函数，用于清理程序中使用的系统资源，比如释放打开的文件等等
    // 析构函数在该对象不会再被使用的情况下自动调用
    function __destruct() {
       print "Destroying " . $this->name . "\n<BR \>";
    }

    // 类的方法的定义
    public function run() {
        echo "Running\n<BR \>";
    }

    public function jump(){
        echo "Jumping\n<BR \>";
    }
    public function dribble(){
        echo "Dribbling\n<BR \>";
    }
    public function shoot(){
        echo "Shooting\n<BR \>";
    }
    public function dunk(){
        echo "Dunking\n<BR \>";
    }
    public function pass(){
        echo "Passing\n<BR \>";
    }

}

/**
 * 1. 类实例化为对象时使用new关键字，new之后紧跟类的名称和一对括号。
 * 2. 使用对象可以像使用其他值一样进行赋值操作
 */
$jordan = new NbaPlayer("Jordan", "198cm", "98kg", "Bull", "23");
// 访问对象的属性使用的语法是->符号，后面跟着属性的名称
echo $jordan->name."\n<BR \>";
// 调用对象的某个方法使用的语法是->符号，后面跟着方法的名称和一对括号
$jordan->run();
$jordan->pass();

$james = new NbaPlayer("James", "203cm", "120kg", "Heat", "6");
echo $james->name."\n<BR \>";
// 当对象变量被赋值为Null的时候，对象的析构函数会被自动调用
// 同一个类的其他对象不受影响
$james1 = $james; // 引用赋值操作会产生对象的一个新的引用
$james2 = &$james; // 使用&的引用赋值操作不会产生对象的一个新的引用

$james = null; 
echo "From now on James will not be used anymore.\n<BR \>";
// 当程序执行结束时，所有类的对象的析构函数都会自动被调用

// 用一页PPT展示说明对象引用的概念

$a="ABC";
$b =&$a;
echo $a."\n<BR \>";//这里输出:ABC
echo $b."\n<BR \>";//这里输出:ABC
$b="EFG";

$log->error($a);
//echo $a."\n<BR \>";//这里$a的值变为EFG 所以输出EFG
echo $b."\n<BR \>";//这里输出EFG
$a = '123';
echo $a."\n<BR \>";//这里$a的值变为123 所以输出123
echo $b."\n<BR \>";//这里输出123


unset($a);
$log->error($a);
//echo $a."\n<BR \>";//Notice: Undefined variable: a 
echo $b."\n<BR \>";//这里输出123


 
function &test() 
{ 
    static $b = 0;//申明一个静态变量 
    $b = $b+1; 
    echo $b."\n<BR \>"; 
    return $b; 
} 

$a = test();//这条语句会输出　$b的值　为１ 
$a = 5; 
$a = test();//这条语句会输出　$b的值　为2 
$a = &test();//这条语句会输出　$b的值　为3 
$a = 5; 
$a = test();//这条语句会输出　$b的值　为6 


/*
Jordan;198cm;98kg;Bull;23
Jordan
Running
Passing
James;203cm;120kg;Heat;6
James
From now on James will not be used anymore.
Destroying James
Destroying Jordan 
*/

?>
