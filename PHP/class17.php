<?php
ini_set("display_errors", "On");
//error_reporting(0);
/*trait特性能力的引入
 * php从以前到现在一直都是单继承的语言，无法同时从两个基类中继承属性和方法，为了解决这个问题，
 * php出了Trait这个特性
*/
// trait
trait A{
    function testTrait(){
        echo 'This is Trait A!', PHP_EOL. "\n<BR \>";
    }
}

class B {
    use A;
}

$b = new B();
$b->testTrait();
echo "===========测试===========". "\n<BR \>\n<BR \>";
trait Dog{
    public $name="dog";
    public function bark(){
        echo "This is dog". "\n<BR \>";
    }
}
class Animal{
    public function eat(){
        echo "This is animal eat". "\n<BR \>";
    }
}
class Cat extends Animal{
    use Dog;
    public function drive(){
        echo "This is cat drive". "\n<BR \>";
    }
}
$cat = new Cat();
$cat->drive();
echo "<br/>";
$cat->eat();
echo "<br/>";
$cat->bark();


/*再测试Trait、基类和本类对同名属性或方法的处理
所以：Trait中的方法会覆盖 基类中的同名方法，而本类会覆盖Trait中同名方法
注意点：当trait定义了属性后，类就不能定义同样名称的属性，否则会产生 fatal error，除非是设置成相同可见度、相同默认值。不过在php7之前，即使这样设置，还是会产生E_STRICT 的提醒*/
echo "===========测试Trait、基类和本类对同名属性或方法的处理===========". "\n<BR \>\n<BR \>";

trait Dog1{ //等级2
    public $name="dog";
    public function drive(){
        echo "This is dog drive";
    }
    public function eat(){
        echo "This is dog eat";
    }
}

class Animal1{ //等级3
    public function drive(){
        echo "This is animal drive";
    }
    public function eat(){
        echo "This is animal eat";
    }
}

class Cat1 extends Animal1{  //等级1
    use Dog1;
    public function drive(){
        echo "This is cat drive";
    }
}
$cat = new Cat1();
$cat->drive();
echo "<br/>";
$cat->eat();
echo "<br/><br/>";

echo "===========  一个类可以组合多个Trait，通过逗号相隔===========". "\n<BR \>\n<BR \>";
/*
use trait1,trait2

当不同的trait中，却有着同名的方法或属性，会产生冲突，可以使用insteadof或 as进行解决，insteadof 是进行替代，而as是给它取别名
*/
trait trait1{
    public function eat(){
        echo "This is trait1 eat";
    }
    public function drive(){
        echo "This is trait1 drive";
    }
}
trait trait2{
    public function eat(){
        echo "This is trait2 eat";
    }
    public function drive(){
        echo "This is trait2 drive";
    }
}
class cat2{
    use trait1,trait2{
        trait1::eat insteadof trait2;
        trait1::drive insteadof trait2;
    }
}
class dog2{
    use trait1,trait2{
        trait1::eat insteadof trait2;
        trait1::drive insteadof trait2;
        trait2::eat as eaten;
        trait2::drive as driven;
    }
}
$cat = new cat2();
$cat->eat();
echo "<br/>";
$cat->drive();
echo "<br/>";
echo "<br/>";
echo "<br/>";
$dog = new dog2();
$dog->eat();
echo "<br/>";
$dog->drive();
echo "<br/>";
$dog->eaten();
echo "<br/>";
$dog->driven();
echo "<br/><br/>";

echo "===========as 还可以修改方法的访问控制===========". "\n<BR \>\n<BR \>";
trait Animal3{
    public function eat(){
        echo "This is Animal eat". "\n<BR \>";
    }
}

class Dog3{
    use Animal3{
        eat as protected;
    }
}

class Cat3{
    use Animal3{
        Animal3::eat as private eaten;
    }
}
$dog = new Dog3();
 echo 123;
$dog->eat();//报错，因为已经把eat改成了保护
echo 456;
$err =  error_get_last();
var_dump($err);
$cat = new Cat3();
$cat->eat();//正常运行，不会修改原先的访问控制
//$cat->eaten();//报错，已经改成了私有的访问控制
echo "<br/><br/>";
echo "===========Trait也可以互相组合，还可以使用抽象方法，静态属性，静态方法等，实例如下===========". "\n<BR \>\n<BR \>";


trait Cat4{
    public function eat(){
        echo "This is Cat eat";
    }
}

trait Dog4{
    use Cat4;
    public function drive(){
        echo "This is Dog drive";
    }
    abstract public function getName();
    
    public function test(){
        static $num=0;
        $num++;
        echo $num;
    }
    
    public static function say(){
        echo "This is Dog say";
    }
}
class animal4{
    use Dog4;
    public function getName(){
        echo "This is animal name";
    }
}

$animal = new animal4();
$animal->getName();
echo "<br/>";
$animal->eat();
echo "<br/>";
$animal->drive();
echo "<br/>";
$animal::say();
echo "<br/>";
$animal->test();
echo "<br/>";
$animal->test();
