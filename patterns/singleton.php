<?php
/* 单列模式
 * 生成一个且只生成一个对象实例的特殊类  getInstance
 * author : adair
 * date : 2017.06.21
 */

namespace oop;

class Preferences{
	private $props =  array();
	private static $instance;

	private function __counstruct(){}

	public static function getInstance(){
		if(empty(self::$instance)){
			self::$instance = new Preferences();
		}
		return self::$instance;
	}

	public function setProperty($key,$val){
		$this->props[$key] = $val;
	}

	public function getProperty($key){
		return $this->props[$key];
	}

	public function conn($db_name){
		if($db_name == "mysql"){
			$hostname = "127.0.0.1";
			$user = "root";
			$password = "root";
			$conn = mysql_connect($hostname,$user,$password) or die("数据库链接错误".mysql_error());  
			$db = mysql_select_db("test",$conn) or die("数据库访问错误".mysql_error());
		}
		return $db;
	}



}


$pref = Preferences::getInstance();
$pref->setProperty("name","matt");

unset($pref);

$pref2 = Preferences::getInstance();
echo $pref2->getProperty("name")."</BR>";



//扩展MYSQL
$mysql = Preferences::getInstance();
$db = $mysql->conn('mysql');
echo $db."</BR>";

unset($mysql);

$mysql1 = Preferences::getInstance();
$db = $mysql1->conn('mysql');
echo $db."</BR>";

?>
