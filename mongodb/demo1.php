<?php


$servername = "localhost";
$username = "root";
$password = "aaaa@";
//$dbname = "df_opencartv4";

$dbname = "df_forumv2";
 
// 创建连接
$conn = new mysqli($servername, $username, $password,$dbname);
 
// 检测连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
} 
echo "连接成功";

$sql = "select user_id,username,username_clean,user_email,user_regdate,user_avatar,user_birthday from bb_users ";
$result = $conn->query($sql);

$bulk = new MongoDB\Driver\BulkWrite;
$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");  
//$writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
// 插入数据


if ($result->num_rows > 0) {
    // 输出数据
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["customer_id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "email: " . $row["email"]. "<br>";
        //$bulk->insert(['customer_id' => $row["customer_id"], 'name' => $row["firstname"]. " " . $row["lastname"], 'email' =>$row["email"]]);
        $bulk->insert(['customer_id' => $row["customer_id"], 'name'=>$row["firstname"]. " " . $row["lastname"], 'email' => $row["email"]]);
    }
} else {
    echo "0 结果";
}
$manager->executeBulkWrite('nodebb.user', $bulk);
//$manager->executeBulkWrite('test.cus3', $bulk);
$conn->close();
die();

$document = ['_id' => new MongoDB\BSON\ObjectID, 'name' => 'Hello World'];
//var_dump($bulk);die();
$_id= $bulk->insert($document);

var_dump($_id);

$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");  
$writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
$result = $manager->executeBulkWrite('test.runoob', $bulk, $writeConcern);


$filter = [];
$options = [
    'projection' => ['_id' => 0],
];

// 查询数据
$query = new MongoDB\Driver\Query($filter, $options);
$cursor1 = $manager->executeQuery('test.runoob', $query);

foreach ($cursor1 as $document1) {
    print_r($document1);
}

die();

// 插入数据
$bulk = new MongoDB\Driver\BulkWrite;
$bulk->insert(['x' => 1, 'name'=>'菜鸟教程', 'url' => 'http://www.runoob.com']);
$bulk->insert(['x' => 2, 'name'=>'Google', 'url' => 'http://www.google.com']);
$bulk->insert(['x' => 3, 'name'=>'taobao', 'url' => 'http://www.taobao.com']);
$manager->executeBulkWrite('test.sites', $bulk);

$filter = ['x' => ['$gt' => 1]];
$options = [
    'projection' => ['_id' => 0],
    'sort' => ['x' => -1],
];

// 查询数据
$query = new MongoDB\Driver\Query($filter, $options);
$cursor = $manager->executeQuery('test.sites', $query);

foreach ($cursor as $document) {
    print_r($document);
}
