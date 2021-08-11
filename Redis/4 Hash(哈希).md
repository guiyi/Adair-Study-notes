### hash 变更的数据 user name age,尤其是用户信息之类的，经常变动的信息**

### hash 更适合存放对象信息**

```shell
192.168.0.182:6379[3]> hset myhash f1 hello  # set 一个具体key-value
(integer) 1
192.168.0.182:6379[3]> hget myhash f1 # 获取一个字段值
"hello"
192.168.0.182:6379[3]> hget myhash f1 h1 f2 world
(error) ERR wrong number of arguments for 'hget' command
192.168.0.182:6379[3]> hmset myhash f1 h1 f2 world  #设置多个值
OK
192.168.0.182:6379[3]> hmget myhash f1 f2
1) "h1"
2) "world"


192.168.0.182:6379[3]> hdel myhash h1  #删除
(integer) 0
192.168.0.182:6379[3]> keys *
1) "myhash"
192.168.0.182:6379[3]> hgetall myhash #查看所有值
1) "f1"
2) "h1"
3) "f2"
4) "world"
192.168.0.182:6379[3]> hdel myhash f1
(integer) 1
192.168.0.182:6379[3]> hgetall myhash
1) "f2"
2) "world"
192.168.0.182:6379[3]> hlen myhash #获取hash表的字段数量
(integer) 1
192.168.0.182:6379[3]> hmset myhash f1 hello
OK
192.168.0.182:6379[3]> hlen myhash
(integer) 2

192.168.0.182:6379[3]> hexists  myhash f1 #判断hash中指定的字段是否存在
(integer) 1


192.168.0.182:6379[3]> hkeys myhash  # 获取所有key
1) "f2"
2) "f1"
192.168.0.182:6379[3]> hvals myhash # 获取所有values
1) "world"
2) "hello"



192.168.0.182:6379[3]> hset myhash f3 5 #指定增量！
(integer) 1
192.168.0.182:6379[3]> hincrby myhash f3 1
(integer) 6
192.168.0.182:6379[3]> hincrby myhash f3 -1
(integer) 5
192.168.0.182:6379[3]> hsetnx myhash f4 hello #如果不存在则可以设置
(integer) 1
192.168.0.182:6379[3]> hsetnx myhash f4 world #如果存在则不能设置
(integer) 0

#hash 变更的数据 user name age,尤其是用户信息之类的，经常变动的信息
#hash 更适合存放对象信息
192.168.0.182:6379[3]> hset user:1 name aaa
(integer) 1

192.168.0.182:6379[3]> hget user:1 name
"aaa"

192.168.0.182:6379[3]> hset user:1 name bbb
(integer) 0
192.168.0.182:6379[3]> hget user:1 name
"bbb"
```

