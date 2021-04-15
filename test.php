<?php

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


	


 
 

