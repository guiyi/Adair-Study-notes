<?php
/*
* PHP设定错误和异常处理
* 1 register_shutdown_function(array(‘Debug’,'fatalError’)); //定义PHP程序执行完成后执行的函数
* 2 set_error_handler(array(‘Debug’,'appError’)); // 设置一个用户定义的错误处理函数
* 3 set_exception_handler(array(‘Debug’,'appException’)); //自定义异常处理。

1.注意事项
1，register_shutdown_function()函数可重复调用，但执行的顺序与注册的顺序相同
2，如果在调用register_shutdown_function()函数之前有exit()函数调用，register_shutdown_function()函数将不能执行
3，PHP4后支持注册函数参数传递
4，在某些服务端，如Apache，当前目录在register_shutdown_function()函数中能够改变
5，register_shutdown_function()函数执行在headers发送之后
*/

namespace Study\PHPClass;
error_reporting(0);


//register_shutdown_function(array(‘Debug’,'fatalError’)); 
// eg1
function testFun()  
{  
    echo '程序发生致命错误执行testFun方法';  
}  
register_shutdown_function('testFun');  
var_dump(error_get_last());
echo '-----测试一下----' . '<br>';  
//undefinedFunc ();    //调用未定义函数
var_dump(error_get_last());
echo '=====测试一下----' . '<br>'; 


// eg2
class ClassDemo {
    public function __construct() {
        register_shutdown_function(array($this, "f"));    
    }

    public function f() {
    	var_dump(error_get_last());
    	//undefinedFunc();
    	
        echo "f()";
    }
}

$demo = new ClassDemo();
echo "before </br>";




// eg3
// 错误处理
$callback = function (){
	
    // print_r($e);
    $req = $_REQUEST;
    $err =  error_get_last();
    //var_dump($err);
  
    $req['err'] = $err;
    var_dump($req);
    undefinedFunc();    
};
register_shutdown_function($callback);









// 设置一个用户定义的错误处理函数
//set_error_handler() 函数设置用户自定义的错误处理函数。该函数用于创建运行时期间的用户自己的错误处理方法。该函数会返回旧的错误处理程序，若失败，则返回 null。

// eg1
function customError1($errno, $errstr, $errfile, $errline) {

    $errmsg = "[".date("Y-m-d H:i:s")."] [{$errno}] {$errstr}n";
    $errmsg .= "Error on line {$errline} in {$errfile}nn";
    $errmsg .= "REQUEST: ".print_r($_REQUEST, true)."n";
    $errmsg .= "Server: ".print_r($_SERVER['REQUEST_URI'], true)."n";
    var_dump($errmsg);
    //error_log($errmsg, 3, ERROR_LOG);

    die();
}
set_error_handler("Study\PHPClass\customError1");
//undefinedFunc();    
//trigger_error('customError1 触发一个错误', E_USER_ERROR); //人为触发错误  





// eg2
//error handler function
function customError($errno, $errstr, $errfile, $errline)
{
	echo "<b>Custom error:</b> [$errno] $errstr<br />";
	echo " Error on line $errline in $errfile<br />";
	echo "Ending Script<br />";
	echo "错误编号errno: $errno<br>";  
    echo "错误信息errstr: $errstr<br>";  
    echo "出错文件errfile: $errfile<br>";  
    echo "出错行号errline: $errline<br>";  
	die();
}

//set error handler
set_error_handler("Study\PHPClass\customError");
trigger_error('customError  set_error_handler 触发一个错误', E_USER_ERROR); //人为触发错误  



//自定义异常处理。
//set_exception_handler() 函数设置用户自定义的异常处理函数。该函数用于创建运行时期间的用户自己的异常处理方法。该函数会返回旧的异常处理程序，若失败，则返回 null。
// eg1
function exceptionHandler($exception) {

    $errmsg = "[".date("Y-m-d H:i:s")."] ".$exception->getMessage()."n";
    $errmsg .= " exceptionHandler REQUEST: ".print_r($_REQUEST, true)."n";
    $errmsg .= " Server: ".print_r($_SERVER['REQUEST_URI'], true)."n";

	var_dump($errmsg);
    //error_log($errmsg, 3, ERROR_LOG);

}
set_exception_handler('Study\PHPClass\exceptionHandler');
throw new \Exception('Uncaught Exception occurred');




// eg2
function my_exception($e){    //该函数必须在set_exception_handler()之前定义
    echo "我是顶级异常处理<br />".$e->getMessage()."<br />";
}
set_exception_handler("Study\PHPClass\my_exception");

function a($val){
    if ($val=="hello") {
        throw new \Exception("不能输入hello", 1);
    }
}
try{
    a("hello");
}catch(Exception $e){
    throw $e;
}