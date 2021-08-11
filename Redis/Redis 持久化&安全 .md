### 启动的时候，就是通过redis.conf来启动的

**RDB配置 持久化配置**

```shell
# RDB配置 持久化配置
save 900 1     #如果在900s内，如果至少有1个key 进行了修改，我们即进行持久化操作
save 300 10    #如果在300s内，如果至少有10个key进行了修改，我们即进行持久化操作
save 60 10000  #如果在60s内，如果至少有10000个key进行了修改，我们即进行持久化操作
stop-writes-on-bgsave-error yes #持久化出错，是否还需要继续工作
rdbcompression yes #是否压缩 rdb 文件，需要消耗一些cpu资源！
rdbchecksum yes #保存rdb文件的时候，进行错误的检查校验
dbfilename dump.rdb #rdb文件
dir /var/lib/redis #rdb文件保存的目录
```



**安全**

```shell
# 安全
127.0.0.1:6379> config get requirepass
1) "requirepass"
2) ""
127.0.0.1:6379> config set requirepass 123456
OK
127.0.0.1:6379> config get requirepass
(error) NOAUTH Authentication required.
127.0.0.1:6379> auth 123456
OK
127.0.0.1:6379> config get requirepass
1) "requirepass"
2) "123456"
```



**内存**

```shell
# 内存
maxmemory <bytes> #redis 配置最大内存容量

maxmemory-policy noeviction #内存达到上限 的处理策略


maxmemory-policy 六种方式
1、volatile-lru：只对设置了过期时间的key进行LRU（默认值） 
2、allkeys-lru ： 删除lru算法的key   
3、volatile-random：随机删除即将过期key   
4、allkeys-random：随机删除   
5、volatile-ttl ： 删除即将过期的   
6、noeviction ： 永不过期，返回错误
```



**APPEND ONLY MODE**  

```shell
APPEND ONLY MODE  
appendonly no #默认是不开启aof模式的，默认使用rdb方式持久化的，在大部分所有的情况下，rdb完全够用！
appendfilename "appendonly.aof" #持久化的文件名称
appendfsync everysec #每秒执行一次 sync，可能会丢失这1s 的数据！
```

