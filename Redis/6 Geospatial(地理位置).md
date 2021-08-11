### 朋友的定位，附近的人，打车距离计算

Redis Geo  3.2 之后的版本，这个功能可以推算地理位置的信息，两地之间的距离，方圆几里的人！

http://www.jsons.cn/lngcode/



```shell
#geoadd 添加城市坐标（纬度、经度、名称）

127.0.0.1:6379> geoadd china:city 121.47 31.23 shanghai
(integer) 1
127.0.0.1:6379> geoadd china:city 116.40 39.90 beijing
(integer) 1
127.0.0.1:6379> geoadd china:city 113.28 23.12 guangzhou
(integer) 1


#geopos 获取当前定位：一定是一个坐标值

127.0.0.1:6379> geopos china:city beijing
1) 1) "116.39999896287918091"
   2) "39.90000009167092543"
127.0.0.1:6379> geopos china:city shanghai
1) 1) "121.47000163793563843"
   2) "31.22999903975783553"
127.0.0.1:6379> geopos china:city shanghai guangzhou
1) 1) "121.47000163793563843"
   2) "31.22999903975783553"
2) 1) "113.27999979257583618"
   2) "23.1199990030198208"
   
   
# geodist 两个地方的直接距离   
m 表示单位为米。
km 表示单位为千米。
mi 表示单位为英里。
ft 表示单位为英尺。

127.0.0.1:6379> geodist china:city beijing shanghai km
"1067.3788"

127.0.0.1:6379> geodist china:city beijing guangzhou km
"1889.3260"


#我附近的人？(获得所有附近的人的位置，定位！) 通过半径来查询！
#获得指定数量的人，200
#所有数据都应录入：china:city,才能让结果更加准确！！！
#GEORADIUS key longitude latitude radius m|km|ft|mi [WITHCOORD] [WITHDIST] [WITHHASH] [COUNT count]
#以给定的经纬度为中心， 返回键包含的位置元素当中， 与中心的距离不超过给定最大距离的所有位置元素。
127.0.0.1:6379> georadius china:city 110 30 10 km #以100，30这个经纬度为中心，寻找方圆10km内的城市
(empty list or set)
127.0.0.1:6379> georadius china:city 110 30 1000 km
1) "guangzhou"
127.0.0.1:6379> georadius china:city 110 30 1000 km withdist#显示到中间距离的位置
1) 1) "guangzhou"
   2) "831.7713"

127.0.0.1:6379> georadius china:city 110 30 1000 km withcoord #显示他人的定位信息
1) 1) "guangzhou"
   2) 1) "113.27999979257583618"
      2) "23.1199990030198208"
127.0.0.1:6379> georadius china:city 110 30 1000 km withcoord count 3
1) 1) "guangzhou"
   2) 1) "113.27999979257583618"
      2) "23.1199990030198208"      


#GEORADIUSBYMEMBER 找出位于指定元素的周围的其他元素！
127.0.0.1:6379> GEORADIUSBYMEMBER  china:city shanghai 10000 km
1) "guangzhou"
2) "shanghai"
3) "beijing"


#geohash 将返回11个字符的Geohash 字符串
# 将二维的经纬度转换为一维的字符串，如果两个字符串越接近，那么则距离越近！
127.0.0.1:6379> geohash china:city shanghai guangzhou
1) "wtw3sj5zbj0"
2) "ws0e98zgz20"



#Geo 底层的实现原理其实就是Zset ! 我们可以使用Zset 命令来操作geo ！
127.0.0.1:6379> zrange china:city 0 -1 #查看地图中的全部的元素
1) "guangzhou"
2) "shanghai"
3) "beijing"
127.0.0.1:6379> zrem china:city beijing # 移除指定的元素
(integer) 1
127.0.0.1:6379> zrange china:city 0 -1
1) "guangzhou"
2) "shanghai"


```

