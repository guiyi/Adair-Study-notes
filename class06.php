<?php
date_default_timezone_set("PRC");
/**
 * 静态成员
 * 1. 静态属性用于保存类的公有数据
 * 2. 静态方法里面只能访问静态属性
 * 3. 静态成员不需要实例化对象就可以访问
 * 4. 类内部，可以通过self或者static关键字访问自身的静态成员
 * 5. 可以通过parent关键字访问父类的静态成员
 * 6. 可以通过类名称在外部访问类的静态成员
 * PHP static 关键字的作用和好处
 * 1、static方法就相当于普通的方法一模一样，但是给方法分了个类。语义化代码。
 * 2、实例化class时不会重新将static方法声明第二遍
 * 3、静态方法不需要所在类被实例化就可以直接使用。
 * 4、静态方法效率上要比实例化高，静态方法的缺点是不自动进行销毁，而实例化的则可以做销毁。
 * 5、静态方法和静态变量创建后始终使用同一块内存，而使用实例的方式会创建多个内存。
 */
class Human{
    public $name;
    protected $height; // 只有自身和子类可以访问到
    public $weight;
    private $isHungry=true; // 只有自身可以访问到

    public static $sValue="Static Value in Human";

    public function eat($food){
        echo $this->name . "'s eating ". $food. "\n<BR \>";
    }

    public function info(){
        print "HUMAN: " . $this->name . ";" . $this->height . ";" . $this->weight . ";" . $this->isHungry ."\n<BR \>";
    }
}

// extends关键字用于说明该类继承自某个父类
class NbaPlayer extends Human
{
    // 类的属性的定义
    public $team="Bull";
    public $playerNumber="23";

    private $age="40"; // private 类型的属性不能被对象外部访问，但是可以在对象内部使用

    public static $president="David Stern";

    public static function changePresident($newPrsdt){
        static::$president = $newPrsdt; // self用于表示当前类，"::"操作符用于访问类的静态成员
        self::$president = $newPrsdt; 
        echo "static : ".static::$president," ---  self : ".self::$president. "\n<BR \>";
        // static关键字也可以用于访问当前类的静态成员
        // echo $this->age . "\n<BR \>"; // 不能在静态方法中使用this伪变量，也不能用对象的->方式调用静态成员
        echo parent::$sValue . "\n<BR \>"; // parent用于表示父类，可以用于访问父类的静态成员
    }

    // 构造函数通常用于初始化对象的属性值
    function __construct($name, $height, $weight, $team, $playerNumber) {
       print $name . ";" . $height . ";" . $weight . ";" . $team . ";" . $playerNumber."\n<BR \>";
       $this->name = $name; // $this是php里面的伪变量，表示对象自身
       $this->height = $height; // 通过$this可以设置对象的属性值
       $this->weight = $weight;
       $this->team = $team;
       $this->playerNumber = $playerNumber;
       echo $this->isHungry."\n<BR \>";
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
    public function getAge(){
        echo $this->name . "'s age is " . ($this->age - 2) . "\n<BR \>";
    }
}


// 类名加“::”可以访问类的静态成员
// 静态成员不需要实例化就可以访问
echo "The president is ". NbaPlayer::$president. "\n<BR \>";
NbaPlayer::changePresident("Adam Silver");
echo "The president is changed to ". NbaPlayer::$president. "\n<BR \>";




/*
The president is David Stern
Static Value in Human
The president is changed to Adam Silver

*/