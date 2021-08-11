<?php
/*
 * 反射API
 * author : adair
 * date : 2017.12.06
*/
header("Content-type: text/html; charset=utf-8"); 
class Person {    
    /**  
     * For the sake of demonstration, we"re setting this private 
     */   
    private $_allowDynamicAttributes = false;  
   
    /** type=primary_autoincrement */  
    protected $id = 0;  
   
    /** type=varchar length=255 null */  
    protected $name;  
   
    /** type=text null */  
    protected $biography;  
   
        public function getId()  
        {  
            return $this->id;  
        }  
        public function setId($v)  
        {  
            $this->id = $v;  
        }  
        public function getName()  
        {  
            return $this->name;  
        }  
        public function setName($v)  
        {  
            $this->name = $v;  
        }  
        public function getBiography()  
        {  
            return $this->biography;  
        }  
        public function setBiography($v)  
        {  
            $this->biography = $v;  
        }  
}  


$class = new ReflectionClass('Person');//建立 Person这个类的反射类  
Reflection::export($class);


//获取属性(Properties)：
echo "<BR/>\n<BR/>\n"."<b>获取属性：</b>"."<BR/>\n";  
$properties = $class->getProperties();  
foreach($properties as $property) {  
    echo "&nbsp&nbsp".$property->getName()."<BR/>\n";  
} 

//获取注释： 
echo "<BR/>\n"."<b>获取注释：</b>"."<BR/>\n";  
foreach($properties as $property) {  
    if($property->isProtected()) {  
        $docblock = $property->getDocComment();  
        preg_match('/ type\=([a-z_]*) /', $property->getDocComment(), $matches);  
        echo "&nbsp&nbsp".$matches[1]."<BR/>\n";   
    }  
}  

//获取类的方法
echo "<BR/>\n"."<b>获取类的方法：</b>"."<BR/>\n";  
$methods = $class->getMethods();  

foreach($methods as $method) {  
    echo "&nbsp&nbsp".$method->getName()."<BR/>\n";  
    $params = $method->getParameters();
    if(!empty($params)){
        echo "&nbsp&nbsp&nbsp&nbsp"."获取类参数："."<BR/>\n";  
        foreach ($params as  $param) {
            echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp".$param->getName()."<BR/>\n";   
        }  
    }
   
} 



?>
