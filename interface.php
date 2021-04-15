<?php
/*
 * 接口开发
 * author : adair
 * date : 2017.06.14
*/

//类的模板，一个类的规定，如果你属于这类，你就必须遵循我的规定，少一个都不行;
//但是具体你怎么去做，我不管，那是你的事
//接口里面的方法没有具体的实现
//接口中定义的所有方法都必须是公有，这是接口的特性。
//接口可以继承接口（interface extends interface）

header('Content-Type: text/html; charset=UTF-8');
interface shop{
	public function buy($gid); //接口里面的方法没有具体的实现  所有方法都必须是公有
	public function sell($gid);
	public function view($gid);
}

class people implements  shop{
	public function buy($gid){
		echo('你购买了ID为 :'.$gid.'的商品'."<BR/>");
	}
	public function sell($gid)
	{
		echo('你卖了ID为 :'.$gid.'的商品'."<BR/>");
	}
	public function view($gid)
	{
		echo('你查看了ID为 :'.$gid.'的商品'."<BR/>");
	}

}

$p = new people();
$p->buy('1');
$p->sell('10');
$p->view('100');


interface teacher extends shop {//接口可以继承接口（interface extends interface）
  public function see($gid);
}


class student implements  teacher{
	public function buy($gid){
		echo('学生 购买了ID为 :'.$gid.'的商品'."<BR/>");
	}
	public function sell($gid)
	{
		echo('学生 卖了ID为 :'.$gid.'的商品'."<BR/>");
	}
	public function view($gid)
	{
		echo('学生 查看了ID为 :'.$gid.'的商品'."<BR/>");
	}
	public function see($gid)
	{
		echo('学生 查看了ID为 :'.$gid.'的商品'."<BR/>");
	}

}

$s = new student();
$s->buy('1');
$s->sell('10');
$s->view('100');
$s->see('1000');
?>
