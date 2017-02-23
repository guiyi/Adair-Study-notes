<?php
header("Content-type: text/html; charset=utf-8"); 

//在指定的字符前添加反斜杠的字符串
$str = "Welcome to my humble Homepage!";
echo $str."<br>";
echo addcslashes($str,'m')."<br>";
echo addcslashes($str,'H')."<br>";
echo addcslashes($str,'A..Z')."<br>";
echo addcslashes($str,'a..z')."<br>";
echo addcslashes($str,'a..g')."<br><br>";


//在预定义的字符前添加反斜杠的字符串
$str = "Who's Peter Griffin?";
echo $str . " This is not safe in a database query.<br>";
echo addslashes($str) . " This is safe in a database query."."<br><br>";


//把一个字符串值从二进制转换为十六进制，再转换回去
$str = "Hello world!";
echo bin2hex($str) . "<br>";
echo pack("H*",bin2hex($str)) . "<br><br>";

//移除字符串右侧的字符
$str = "我是phper 哈哈!";
echo $str . "<br>";
echo chop($str,"哈哈!"). "<br><br>";


$str = "活捉一条很长很长的新闻!";
echo chunk_split($str,20,"..."). "<br><br>";


?>