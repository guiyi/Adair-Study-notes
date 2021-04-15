<?php
/*
*	===是恒等计算符   同时检查表达式的值与类型
*	==是比较运算符号  不会检查条件式的表达式的类型
*	NULL,FALSE,array(),"",0,"0"  这几个值如果用==他们是相等的
*	author : adair
*/
$x=100; 
$y="100";
$str  = NULL;
$str1 = "";
$str2 = "0";
$bool = FALSE;
$arr  = array();
$int  = 0;


var_dump($x == $y); // 因为值相等，返回 true
echo "\n";
var_dump($x === $y); // 因为类型不相等，返回 false
echo "\n";
var_dump($x != $y); // 因为值相等，返回 false
echo "\n";
var_dump($x !== $y); // 因为值不相等，返回 true
echo "\n\n";

echo '$str  = NULL'.$str,' --- ','$str1 = ""'.$str1."\n";
var_dump($str == $str1);
echo "\n";
var_dump($str === $str1);
echo "\n\n";

echo '$int  = 0'.$int,' --- ','$str2 = "0"'.$str2."\n";
var_dump($int == $str2);
echo "\n";
var_dump($int === $str2);
echo "\n\n";

echo '$str  = NULL'.$str,' --- ','$arr  = array()'.$arr."\n";
var_dump($str == $arr);
echo "\n";
var_dump($str === $arr);
echo "\n\n";




?> 
