<?php
namespace Study\PHPClass;

date_default_timezone_set("PRC");
/**
 * 访问控制
 * 1. public的类成员可以被自身、子类和其他类访问
 * 2. protected的类成员只能被自身和子类访问
 * 3. private的类成员只能被自身访问
 */
class test{
    public $name=' 章 三 ';
    protected $height; // 只有自身和子类可以访问到
    public $weight;
    private $isHungry=true; // 只有自身可以访问到

    public function eat($food){
        echo $this->name . "'s eating ". $food. "\n<BR \>";
    }

    public function info(){
        print "HUMAN: " . $this->name . ";" . $this->height . ";" . $this->weight . ";" . $this->isHungry ."\n<BR \>";
    }
}


function db_conn(){
	$servername = "192.168.0.51";
	$username = "root";
	$password = "123456";
	$dbname = "df_opencartv4";
	 
	// 创建连接
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("连接失败: " . $conn->connect_error);
	}
	$sql = "SELECT * FROM `customer` limit 1";
	$result = $conn->query($sql);

	$data =  array();
	$data = $result->fetch_assoc();

	//$conn->close();
	echo json_encode($data);
}
	
 
 

