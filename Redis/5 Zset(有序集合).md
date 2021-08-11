### **Zset 有序集合 ：set排序，工资成绩表，工资表排序**

### **排行榜 TOP N  排行**



```shell
192.168.0.182:6379> zadd salary 3500 s1 #添加
(integer) 1
192.168.0.182:6379> zadd salary 5000 s2
(integer) 1
192.168.0.182:6379> zadd salary 500 s3
(integer) 1
192.168.0.182:6379> zrangebyscore salary 0 -1 
(empty list or set)
192.168.0.182:6379> zrangebyscore salary -inf +inf #区间
1) "s3"
2) "s1"
3) "s2"
192.168.0.182:6379> zrangebyscore salary -inf +inf withscores
1) "s3"
2) "500"
3) "s1"
4) "3500"
5) "s2"
6) "5000"
192.168.0.182:6379> zrangebyscore salary +inf -inf withscores
(empty list or set)
192.168.0.182:6379> zrangebyscore salary +inf -inf 
(empty list or set)

192.168.0.182:6379> zrem salary s1     #删除
(integer) 1
192.168.0.182:6379> zrangebyscore salary +inf -inf 
(empty list or set)
192.168.0.182:6379> zrangebyscore salary -inf +inf
1) "s3"
2) "s2"
192.168.0.182:6379> zcard salary #长度 获取有序集合中的个数
(integer) 2


192.168.0.182:6379> zrevrange salary 0 -1  #从大到小进行排序
1) "s2"
2) "s3"



192.168.0.182:6379> flushdb
OK
192.168.0.182:6379> zadd myset 1 hello
(integer) 1
192.168.0.182:6379> zadd myset 2 word
(integer) 1
192.168.0.182:6379> zadd myset 3 php
(integer) 1
192.168.0.182:6379> zcount myset 1 3  #获取指定区间的成员数量
(integer) 3
192.168.0.182:6379> zcount myset 1 2
(integer) 2
```

