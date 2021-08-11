### Redis 默认有16个数据库

```shell
# mac 目录
/usr/local/etc/
redis-server redis79.conf 
redis-cli  -p 6379

 redis-server 192.168.0.182:6378
 /usr/bin/redis-server 192.168.0.182:6379

 1041  redis-cli -h 192.168.0.182  -p 6379
 1042  redis-cli -h 192.168.0.182  -p 6378
 
 192.168.0.182:6378> select 3  #切换数据库
OK
192.168.0.182:6378[3]> dbsize  #查看DB大小
(integer) 0

flushdb #清除当前数据库
flushall #清除全部数据库的内容


192.168.0.182:6379[3]> keys *
(empty list or set)
192.168.0.182:6379[3]> set h1 1
OK
192.168.0.182:6379[3]> set h2 1
OK
192.168.0.182:6379[3]> keys *  #查看所有值
1) "h2"
2) "h1"
192.168.0.182:6379[3]> move h1
(error) ERR wrong number of arguments for 'move' command
192.168.0.182:6379[3]> move h1 1  #移除
(integer) 1
192.168.0.182:6379[3]> keys *
1) "h2"
192.168.0.182:6379[3]> exprie h2 10  #设置过期时间
(error) ERR unknown command 'exprie'
192.168.0.182:6379[3]> expire h2 10
(integer) 1
192.168.0.182:6379[3]> ttl
(error) ERR wrong number of arguments for 'ttl' command
192.168.0.182:6379[3]> ttl h2 #查看key的当前剩余时间
(integer) 4
192.168.0.182:6379[3]> ttl h2
(integer) 3
192.168.0.182:6379[3]> ttl h2
(integer) 2
192.168.0.182:6379[3]> ttl h2
(integer) 1
192.168.0.182:6379[3]> ttl h2
(integer) 1
192.168.0.182:6379[3]> ttl h2
(integer) -2
192.168.0.182:6379[3]> get h2
(nil)
192.168.0.182:6379[3]> exists h2
(integer) 0
192.168.0.182:6379[3]> exists h1 #查看是否存在值
(integer) 0
192.168.0.182:6379[3]> set h1 aa
OK
192.168.0.182:6379[3]> exists h1
(integer) 1
192.168.0.182:6379[3]> type h1 #查看值类型
string
```



   





