<?php
/*
isset()
null,unset();
*/

print isset($a); // $a is not set. Prints false. (Or more accurately prints ''.)
$b = 0; // isset($b) returns true (or more accurately '1')
var_dump($b);
echo "<BR />";

$c = array(); // isset($c) returns true
var_dump($c);
echo "<BR />";

$b = null; // Now isset($b) returns false;
var_dump($b);
echo "<BR />";

unset($c); // Now isset($c) returns false;
var_dump($c);
echo "<BR />";

/*empty()
The default values are the _empty_ values. 
E.g  Booleans default to FALSE, 
integers and floats default to zero, 
strings to the empty string '', 
arrays to the empty array.
*/
$bool = false;
var_dump(empty($bool));
echo "<BR />";

$int = $float =  0;
var_dump(empty($int));
var_dump(empty($float));
echo "<BR />";

$string = '';
var_dump(empty($string));
echo "<BR />";

$array = array();
var_dump(empty($array));
echo "<BR />";

?>