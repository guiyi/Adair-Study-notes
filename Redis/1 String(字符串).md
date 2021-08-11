### **String类似的使用场景:value 除了是我们的字符串还可以是我们的数字！**

-  **计数器**
- **统计多单位的数量     uid:234545:follow  关注数，粉丝数，获赞赏，播放数..**
- **粉丝数**
- **对象缓存存储**

```shell
192.168.0.182:6379[3]> set key1 v1 OK 192.168.0.182:6379[3]> get key1 "v1" 192.168.0.182:6379[3]> keys * 1) "key1" 192.168.0.182:6379[3]> exists key1 (integer) 1 192.168.0.182:6379[3]> append key1 " , hello " #追加 (integer) 11 
192.168.0.182:6379[3]> get key1 "v1 , hello " 
192.168.0.182:6379[3]> strlen key1 # 查看长度 (integer) 11 
192.168.0.182:6379[3]> append name adair  #不存在， 就创建 (integer) 5 
192.168.0.182:6379[3]> exits (error) ERR unknown command 'exits' 
192.168.0.182:6379[3]> keys * 1) "key1" 2) "name"
```



```shell
# 浏览量  阅读量
192.168.0.182:6379[3]> set views 0
OK
192.168.0.182:6379[3]> get views
"0"
192.168.0.182:6379[3]> incr views #增加
(integer) 1
192.168.0.182:6379[3]> incr views
(integer) 2
192.168.0.182:6379[3]> get views
"2"
192.168.0.182:6379[3]> decr views #减少
(integer) 1
192.168.0.182:6379[3]> get views
"1"

192.168.0.182:6379[3]> INCRBY views 10  #步长
(integer) 11
192.168.0.182:6379[3]> DECRBY views 5
(integer) 6
192.168.0.182:6379[3]> get views
"6"
```



```shell
# 字符串范围 range
192.168.0.182:6379[3]> INCRBY views 10
(integer) 11
192.168.0.182:6379[3]> DECRBY views 5
(integer) 6
192.168.0.182:6379[3]> get views
"6"
# 替换
192.168.0.182:6379[3]> set key abcdefg
OK
192.168.0.182:6379[3]> setrange key  1 XX
(integer) 7
192.168.0.182:6379[3]> get key
"aXXdefg"
```



```shell
#setex(set with expire) #设置过期时间
#setnx(set if not expire) #不存在在设置(在分布式锁中会常常使用)

192.168.0.182:6379[3]> setex key4 30 "hello" #设置key4的值为hello，30秒后过期
OK
192.168.0.182:6379[3]> get key4
"hello"
192.168.0.182:6379[3]> ttl key4
(integer) 18
192.168.0.182:6379[3]> setnx mykey redis #如果mykey 不存在，创建mykey
(integer) 1
192.168.0.182:6379[3]> keys *
1) "key"
2) "key3"
3) "name"
4) "mykey"
5) "key4"
6) "views"
192.168.0.182:6379[3]> keys *
1) "key"
2) "key3"
3) "name"
4) "mykey"
5) "views"
192.168.0.182:6379[3]> keys *
1) "key"
2) "key3"
3) "name"
4) "mykey"
5) "views"
192.168.0.182:6379[3]> setnx mykey mongodb #如果存在mykey，则不创建
(integer) 0
192.168.0.182:6379[3]> get mykey
"redis"
```



```shell
mset 设置多个值 。   
gset 获取多个值
192.168.0.182:6379[3]> mset k1 v1 k2 v2 k3 v3
OK
192.168.0.182:6379[3]> keys *
1) "k3"
2) "k2"
3) "k1"
192.168.0.182:6379[3]> mget k1 k2 k3
1) "v1"
2) "v2"
3) "v3"
192.168.0.182:6379[3]> msetnx k1 v1 k4 v4 #msetnx 是一个原子性的操作，要么一起成功，要么一起失败！
(integer) 0
192.168.0.182:6379[3]> keys *
1) "k2"
2) "k3"
3) "k1"
192.168.0.182:6379[3]> msetnx  k4 v4 k1 v1
(integer) 0
192.168.0.182:6379[3]> keys *
1) "k2"
2) "k3"
3) "k1"

# 对象
192.168.0.182:6379[3]> set user:1 {name:zhagnsan,age:3} #设置一个user:1对象，值为 json数据
OK
192.168.0.182:6379[3]> keys *
1) "user:1"
2) "k2"
3) "k3"
4) "k1"
192.168.0.182:6379[3]> get user:1
"{name:zhagnsan,age:3}"


192.168.0.182:6379[3]> mset user:2:name lisi user:2:age 2 #相对于 set 效率更高
OK
192.168.0.182:6379[3]> mget user:2:name user:2:age
1) "lisi"
2) "2"


#getset  先get再set
192.168.0.182:6379[3]> getset db redis #如果不存在值，则返回nil
(nil)
192.168.0.182:6379[3]> get db
"redis"
192.168.0.182:6379[3]> getset db mongodb #如果存在值，获取原来的值，并设置新的值
"redis"
192.168.0.182:6379[3]> get db
"mongodb"
```

