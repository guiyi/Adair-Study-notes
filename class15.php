<?php
date_default_timezone_set("PRC");

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

public function __destruct(){

	echo "This is __destory function!";

	}

}

$info = new Human;
$info->eat('apple');