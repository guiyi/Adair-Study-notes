<?php
date_default_timezone_set("PRC");
/**
 * 多态
 * 1. 只要某个对象实现了接口（instanceof），就可以直接在对象上调用接口的方法
 * 使用场景
 * 如果要创建一个模型，这个模型将由一些紧密相关的对象采用，就可以使用抽象类。如果要创建将由一些不相关对象采用的功能，就使用接口。
 * 如果必须从多个来源继承行为，就使用接口。
 * 如果知道所有类都会共享一个公共的行为实现，就使用抽象类，并在其中实现该行为。
 * 
 */

interface ICanEat {
   public function eat($food);
}

// Human类实现了ICanEat接口
class Human implements ICanEat { 
  // 跟Animal类的实现是不同的
  public function eat($food){
    echo "Human eating " . $food . "\n<BR \>";
  }
}

// Animal类实现了ICanEat接口
class Animal implements ICanEat {
  public function eat($food){
    echo "Animal eating " . $food . "\n<BR \>";
  }
}

function eat($obj){
  if($obj instanceof ICanEat){ 
    $obj->eat("FOOD"); // 不需要知道到底是Human还是Animal，直接吃就行了
  }else{
    echo "Can't eat!\n<BR \>";
  }
}

$man = new Human();
$monkey = new Animal();

// 同样的代码，传入接口的不同实现类的时候，表现不同。这就是为什么成为多态的原因。
eat($man);
eat($monkey);


/*
Human eating FOOD
Animal eating FOOD 
*/