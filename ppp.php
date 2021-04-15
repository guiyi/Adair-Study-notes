<?php
/*
 * 访问控制
 * author : adair
 * date : 2017.06.14
 * 1. public的类成员可以被自身、子类和其他类访问
 * 2. protected的类成员只能被自身和子类访问
 * 3. private的类成员只能被自身访问
*/

class father{
	//内部，外部，父类，子类
	public function myPublic(){
		echo 'myPublic - ';
	}
    //内部，父类，子类
	protected function myProtected(){
		echo 'myProtected - ';
	}

	//内部
	private function myPrivate(){
		echo 'myPrivate - ';
	}

	function test(){
		$this->myPublic();
		$this->myProtected();
		$this->myPrivate();
	}

}

$father = new father();
$father->test();
$father->myPublic();
//$father->myProtected();
//$father->myPrivate();
$child = new  child();
$child->chPublic();
$child->test1();

class child extends  father{
	public function chPublic(){
		echo 'chPublic - ';
	}
	protected function chProtected(){
		echo 'chProtected - ';
	}
	private function chPrivate(){
		echo 'chPrivate - ';
	}

	function test1(){
		$this->myPublic();
		$this->myProtected();
		//$this->myPrivate();
		$this->chPublic();
		$this->chProtected();
		$this->chPrivate();
	}


}


$child = new  child();
$child->myPublic();
$child->test1();

?>
