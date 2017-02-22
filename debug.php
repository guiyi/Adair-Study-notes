<?php
header("Content-type: text/html; charset=utf-8"); 


define("GREETING","Hello world ! 552855 ");
echo constant("GREETING"). '<br>';
echo GREETING . '<br>';


//连接 
$mem = new Memcache; 
$mem->connect("127.0.0.1", 11211); 

$myvar =array() ;
$myvars =array() ;
$vars = '';

$var = "1 I am in the global symbol table";
$myvar = array('step 01');
$mem->set('key1', 'step 01', 0, 60); 
$vals = $mem->get('key1'); 
//echo $vals;
array_push($myvars,$vals);
//var_dump($myvars);
//***********************************************************/

//控制台打印PHP代码
function console_log( $data ){
echo '<script>';
echo 'console.log('. json_encode( $data ) .')';
echo '</script>';
}

$mem->set('key1', 'step 02', 0, 60); 
$vals = $mem->get('key1'); 
array_push($myvars,$vals);
//***********************************************************/

//变量问题

function sample($para){
	Global $myvar;
$var = "2 I am in the active symbol table";
echo $var.'<br/>';
 array_push($myvar,$var);
}
sample($var);
array_push($myvar,$var);
echo $var.'<br/>';

$mem->set('key1', 'step 03', 0, 60); 
$vals = $mem->get('key1'); 
array_push($myvars,$vals);
//***********************************************************/

//使用静态变量
function count_to_100(){
	static $n=1;
	if($n <= 10){
		echo $n.'<br/>';
		$n++;
		count_to_100();
	}
}
count_to_100();
//***********************************************************/
//异常的使用
ini_set('display_errors', 'On');
error_reporting(E_ALL & ~ E_WARNING);
$error = 'Always throw this error';
//throw new Exception($error);
// 继续执行
echo 'Hello World'; 
//***********************************************************/

//可以使用try catch捕获掉
try {
		$error = 'Always throw this error';
		throw new Exception($error);

		// 从这里开始，tra 代码块内的代码将不会被执行
		echo 'Never executed';

	} catch (Exception $e) {
		echo 'Caught exception: ',$e->getMessage(),'<br>';
	}

// 继续执行
echo 'Hello World'.'<br/>';
//***********************************************************/
//
//

error_reporting(0);  

function userErrorHandler($errno, $errmsg, $filename, $linenum, $vars)  
{  
    // timestamp for the error entry
    $dt = date("Y-m-d H:i:s (T)").'<br/>';
    // define an assoc array of error string
    // in reality the only entries we should
    // consider are E_WARNING, E_NOTICE, E_USER_ERROR,
    // E_USER_WARNING and E_USER_NOTICE
    $errortype = array (
	  E_ERROR  => 'Error',
	  E_WARNING=> 'Warning',
	  E_PARSE  => 'Parsing Error',
	  E_NOTICE => 'Notice',
	  E_CORE_ERROR   => 'Core Error',
	  E_CORE_WARNING => 'Core Warning',
	  E_COMPILE_ERROR=> 'Compile Error',
	  E_COMPILE_WARNING    => 'Compile Warning',
	  E_USER_ERROR   => 'User Error',
	  E_USER_WARNING => 'User Warning',
	  E_USER_NOTICE  => 'User Notice',
	  E_STRICT => 'Runtime Notice',
	  E_RECOVERABLE_ERROR  => 'Catchable Fatal Error'
    );
    // set of errors for which a var trace will be saved
    $user_errors = array(E_USER_ERROR, E_USER_WARNING, E_USER_NOTICE);
    $err = "<errorentry>\n";
    $err .= "\t<datetime>" . $dt . "</datetime>\n";
    $err .= "\t<errornum>" . $errno . "</errornum>\n";
    $err .= "\t<errortype>" . $errortype[$errno] . "</errortype>\n";
    $err .= "\t<errormsg>" . $errmsg . "</errormsg>\n";
    $err .= "\t<scriptname>" . $filename . "</scriptname>\n";
    $err .= "\t<scriptlinenum>" . $linenum . "</scriptlinenum>\n";
    if (in_array($errno, $user_errors)) {
  		$err .= "\t<vartrace>" . wddx_serialize_value($vars, "Variables") . "</vartrace>\n";
    }
    $err .= "</errorentry>\n\n";
    echo $err;
}



function distance($vect1, $vect2) {
    if (!is_array($vect1) || !is_array($vect2)) {
	  trigger_error("Incorrect parameters, arrays expected", E_USER_ERROR);
	  return NULL;
    }
    if (count($vect1) != count($vect2)) {
	  trigger_error("Vectors need to be of the same size", E_USER_ERROR);
	  return NULL;
    }
    for ($i=0; $i<count($vect1); $i++) {
	  $c1 = $vect1[$i]; $c2 = $vect2[$i];
	  $d = 0.0;
  if (!is_numeric($c1)) {
	  trigger_error("Coordinate $i in vector 1 is not a number, using zero",E_USER_WARNING);
	  $c1 = 0.0;
    }
    if (!is_numeric($c2)) {
	  trigger_error("Coordinate $i in vector 2 is not a number, using zero",E_USER_WARNING);
	  $c2 = 0.0;
    }
    $d += $c2*$c2 - $c1*$c1;
    }
    return sqrt($d);
}



$old_error_handle = set_error_handler("userErrorHandler");
$t = I_AM_NOT_DEFINED;  //generates a warning

// define some "vectors"
$a = array(2, 3, "foo");
$b = array(5.5, 4.3, -1.6);
$c = array(1, -3);

//generate a user error
$t1 = distance($c,$b);

// generate another user error
$t2 = distance($b, "i am not an array") . "\n";

// generate a warning
$t3 = distance($a, $b) . "\n";

//***********************************************************/
//
//构造方法
  class Person{

    public $name;
    public $age;
    public $sex;

	public function __construct($name="",$sex="男",$age=27){      //显示声明一个构造方法且带参数
	    $this->name=$name;
	    $this->sex=$sex;
		$this->age=$age;
	}
	public function say(){
	    echo "<br/><br/>"."我叫：".$this->name."，性别：".$this->sex."，年龄：".$this->age. "<br />";
	}

    }

$Person1= new Person();
echo $Person1->say();//输出:我叫：，性别：男，年龄：27
$Person3= new Person("李四","男",25);
echo $Person3->say();//输出：我叫：李四，性别：男，年龄：25

//***********************************************************/
//
//
//
setcookie("cookie[three]","cookiethree");
setcookie("cookie[two]","cookietwo");
setcookie("cookie[one]","cookieone");

// 输出 cookie （在重载页面后）
if (isset($_COOKIE["cookie"]))
  {
  foreach ($_COOKIE["cookie"] as $name => $value)
    {
    echo "$name : $value <br />";
    }
  }

var_dump($myvars);
//***********************************************************/

console_log( $myvar ); // [1,2,3]

?>