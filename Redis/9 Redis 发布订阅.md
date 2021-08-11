### 使用场景：

1. 实时消息系统！

2. 实时聊天！(当作聊天室，将信息回显给所有人)

3. 订阅，关注系统

稍微复杂的场景我们就会使用MQ() Rabbitmq

```shell
订阅端：
root@ubuntu:/home/ubuntu# redis-cli -h 192.168.0.182  -p 6379
192.168.0.182:6379> subscribe pd  #订阅一个频道 pd
Reading messages... (press Ctrl-C to quit)
1) "subscribe"
2) "pd"
3) (integer) 1
#等待读取推送到信息
1) "message" #消息
2) "pd" #那个频道的销售
3) "hello redis" #消息的具体内容
1) "message"
2) "pd"
3) "hello world"


发送端：
192.168.0.182:6379> publish pd 'hello redis' #发布者发送信息到频道
(integer) 1
192.168.0.182:6379> publish pd 'hello world'
(integer) 1
```

