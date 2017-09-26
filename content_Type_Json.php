<?php
//Adair 2017-09-26
//HttpRequester  Content-Type 是 application/json的请求数据
//$_POST,$_REQUEST  都获取不到值


$jsonStr = file_get_contents('php://input') ;
$str = json_decode($jsonStr,true);

if(isset($str["data"])){

	$pdata[] = array(
                "code" => 1,
                "msg" => 'Success',
                "rst" => 'hello world~'
                );
	echo   json_encode($pdata);

}else{

	$pdata[] = array(
                "code" => 403,
                "msg" => 'Error',
                "rst" => NULL
                );
	echo   json_encode($pdata);
}


?>
