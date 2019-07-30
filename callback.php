<?php
/*
 * 回调、匿名函数、闭包 
 * author : adair
 * date : 2019.07.30
 * 1. 将函数存储在$logger变量中;
 * 2. 将其传递给$processor->registerCallback($logger);
 * 3. 创建两个产品并将其传递给sale()方法;
*/

date_default_timezone_set("PRC");
class Product{
    public $name;
    public $price;
    
    function __construct($name,$price){
        $this->name = $name;
        $this->price = $price;
    }

}

class  ProcessSale{
    private $callbacks;
    
    function registerCallback($callback){
        
        if(!is_callable($callback)){
            throw new Exception("callbak not callable");
        }
        $this->callbacks[] = $callback;
    }
    
    function sale($product){
        print "{$product->name}: processing \n";
        foreach($this->callbacks as $callback){
            call_user_func($callback,$product);
        }
    }
}


class Mailer{
    function doMail($product){
        print "    mailling({$product->name})\n";
    }
}

class Totalizer{
    static function warnAmount( $amt ){
        $count = 0;
        return function($product) use ($amt,&$count){
            $count += $product->price;
            print "    count :$count\n";
            if($count > $amt){
                print "    high price reached: {$count}\n";
            }
        };
    }

}

//方法1
$logger = create_function('$product','print "    logging ({$product->name})\n";');
//方法2 优化
$logger2 = function($product){
  print "    logging ({$product->name})\n";
};


$processor = new ProcessSale();
//匿名函数
$processor->registerCallback($logger);
$processor->registerCallback($logger2);
//非匿名函数  可以使用函数名,甚至对象应用引用和方法  
$processor->registerCallback(array(new mailer(),"doMail"));
//闭包
$processor->registerCallback(Totalizer::warnAmount(8));


$processor->sale(new Product("shoes",6));
print "\n";
$processor->sale(new Product("coffee",6));

/*
rst:
shoes: processing 
    logging (shoes)
    logging (shoes)
    mailling(shoes)
    count :6

coffee: processing 
    logging (coffee)
    logging (coffee)
    mailling(coffee)
    count :12
    high price reached: 12

*/
