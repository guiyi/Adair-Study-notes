<?php 
   header("Content-type: text/html; charset=utf-8"); 
   //Connecting to Redis server on localhost 
   $redis = new Redis(); 
   $redis->connect('127.0.0.1', 6379); 
   echo "<BR /> Connection to server sucessfully <BR />"; 
   //check whether server is running or not 
   echo "<BR /> Server is running: ".$redis->ping(); 

   //store data in redis list 
   $redis->lpush("tutorial-list", "Redis"); 
   $redis->lpush("tutorial-list", "Mongodb"); 
   $redis->lpush("tutorial-list", "Mysql");  

   // Get the stored data and print it 
   $arList = $redis->lrange("tutorial-list", 0 ,5); 
   echo "<BR /> Stored string in redis:: 　<BR />"; 
   print_r($arList); 


   // Get the stored keys and print it 
   $redis->set("tutorial-name", "Redis tutorial"); 
   $arList = $redis->keys("*"); 
   echo "<BR /> Stored keys in redis::  <BR />" ;
   print_r($arList)."<BR /><BR /><BR />"; 




   // --------- 缓存数据
   $redis->set('cache-key', json_encode([
     'data-list' => '这是个缓存数据～'
   ]), JSON_UNESCAPED_UNICODE);
   echo "<BR /><BR />"."字符串缓存成功～ \n\n<BR /><BR />";
   // 获取缓存数据
   $data = $redis->get('cache-key');
   echo "读取缓存数据为： \n<BR />";
   print_r(json_decode($data,true))."<BR />";



   // ---------- queue 进队列
   $userId = mt_rand(000000, 999999);
   $redis->rpush('QUEUE_NAME',json_encode(['user_id' => $userId]));
   $userId = mt_rand(000000, 999999);
   $redis->rpush('QUEUE_NAME',json_encode(['user_id' => $userId]));
   $userId = mt_rand(000000, 999999);
   $redis->rpush('QUEUE_NAME',json_encode(['user_id' => $userId]));
   echo "<BR /><BR /><BR />数据进队列成功 \n<BR />";
   // 查看队列
   $res = $redis->lrange('QUEUE_NAME', 0, 1000);
   echo "当前队列数据为： \n<BR />".count($res)."<BR />";
   print_r($res);
   echo "----------------------------- \n<BR />";
   // 出队列
   $redis->lpop('QUEUE_NAME');
   echo "数据出队列成功 \n<BR />";
   // 查看队列
   $res = $redis->lrange('QUEUE_NAME', 0, 1000);
   echo "当前队列数据为： \n<BR />".count($res)."<BR />";
   print_r($res)."\n<BR /><BR />";





   



   // ---------- 实现悲观锁机制
   $timeout = 5000;
   do {
    $microtime = microtime(true) * 1000;
    $microtimeout = $microtime+$timeout+1;
    // 上锁
    $isLock = $redis->setnx('lock.count', $microtimeout);
    if (!$isLock) {
        $getTime = $redis->get('lock.count');
        if ($getTime < $microtime) {
           // 未超时继续等待
           continue;
        }
       // 超时,抢锁,可能有几毫秒级时间差可忽略
       $previousTime = $redis->getset('lock.count', $microtimeout);
       if ((int)$previousTime < $microtime) {
           break;
       }
    }
   } while (!$isLock);
   $count = $redis->get('count')? : 0;
   // file_put_contents('/var/log/count.log.1', ($count+1));
   // 业务逻辑
   echo "<BR /><BR /><BR />"."实现悲观锁机制 执行count加1操作～ \n\n<BR /><BR />";
   $redis->set('count', $count+1);
   // 删除锁
   $redis->del('lock.count');
   // 打印count值
   $count = $redis->get('count');
   echo "<BR /><BR /><BR />"."实现悲观锁机制 count值为：$count \n<BR />";


   // ---------- 推送
   $redis->publish('msg', '来自msg频道的推送');
   echo "<BR /><BR /><BR />"."msg频道消息推送成功～ \n<BR />";
   //$redis->close();


   //---------- 订阅
  echo "<BR /><BR /><BR />"."订阅msg这个频道，等待消息推送... \n<BR />";
  $redis->subscribe(['msg'], 'callfun');
  function callfun($redis, $channel, $msg)
  {
   print_r([
     'redis'   => $redis,
     'channel' => $channel,
     'msg'     => $msg
   ]);
  }




  // ---------- 实现乐观锁机制
   // 监视 count 值
   $redis->watch('count');
   // 开启事务
   $redis->multi();
   // 操作count
   $time = time();
   $redis->set('count', $time);
   //-------------------------------
   /**
    * 模拟并发下其他进程进行set count操作 请执行下面操作
    *
    * redis-cli 执行 $redis->set('count', 'is simulate'); 模拟其他终端
    */
   sleep(10);
   //-------------------------------
   // 提交事务
   $res = $redis->exec();
   if ($res) {
     // 成功...
     echo "<BR /><BR /><BR />".'实现乐观锁机制 success:' . $time."<BR />";
     return;
   }
   // 失败...
   echo 'fail:' . $time."<BR />";
?>
