### **基本的数据类型，列表，栈、队列、阻塞队列**

- 实际上是一个链表， before node  after, left,right 都可以插入值
- 如果key不存在，创建新的链表
- 如果key存在，新增内容
- 如果移除了所有值，空链表，也代表不存在！
- 在两边插入或改动值，效率最高！中间元素，相对来说效率会低一点～

```shell
#消息排队、消息队列(Lpush Rpop)、栈(Lpush Lpop)
192.168.0.182:6379[3]> lpush list one #将一个值或多个值，插入到列表的头部
(integer) 1
192.168.0.182:6379[3]> lpush list two
(integer) 2
192.168.0.182:6379[3]> lpush list three
(integer) 3
192.168.0.182:6379[3]> lrange list 0 -1
1) "three"
2) "two"
3) "one"
192.168.0.182:6379[3]> lrange list 0 1
1) "three"
2) "two"


192.168.0.182:6379[3]> rpush list right .  #将一个值或多个值，插入到列表的尾部
(integer) 4
192.168.0.182:6379[3]> lrange list 0 -1
1) "three"
2) "two"
3) "one"
4) "right"

#####################################################################
# lpop  从头部移除第一个元素
# rpop  从尾部移除第一个元素

192.168.0.182:6379[3]> lpop list
"three"
192.168.0.182:6379[3]> lrange list 0 -1
1) "two"
2) "one"
3) "right"
192.168.0.182:6379[3]> rpop list
"right"
192.168.0.182:6379[3]> lrange list 0 -1
1) "two"
2) "one"

#####################################################################
# lindex 返回列表里的元素的索引 index 存储在 key 里面

192.168.0.182:6379[3]> lindex list 1
"one"
192.168.0.182:6379[3]> lindex list 0
"two"
#####################################################################
#llen 返回列表的长度

192.168.0.182:6379[3]> llen list
(integer) 2

#####################################################################
#lrem (key count value) 移除指定值

192.168.0.182:6379[3]> lrange list 0 -1
1) "two"
2) "one"
3) "three"
4) "three"

192.168.0.182:6379[3]> lindex  list 3
"three"
192.168.0.182:6379[3]> lindex  list 0
"two"
192.168.0.182:6379[3]> lrem list 0 one
(integer) 1
192.168.0.182:6379[3]> lrange list 0 -1
1) "two"
2) "three"
3) "three"
192.168.0.182:6379[3]> lrem list 2 three
(integer) 2
192.168.0.182:6379[3]> lrange list 0 -1
1) "two"


192.168.0.182:6379[3]> ltrim list 1 2  #通过下标截取指定的长度，这个list已经被改变了，截断了只剩下截取的元素
OK
192.168.0.182:6379[3]> lrange list 0 -1
(empty list or set)

#####################################################################
rpoplpush # 移除列表中的最后一个元素，将他移动到新的列表中！

192.168.0.182:6379[3]> rpush mylist "hello"
(integer) 1
192.168.0.182:6379[3]> rpush mylist "hello1"
(integer) 2
192.168.0.182:6379[3]> rpush mylist "hello2"
(integer) 3
192.168.0.182:6379[3]> rpoplpush mylist myotherlist #移除列表的最后一个元素，将他移动到新的列表中！
"hello2"
192.168.0.182:6379[3]> lrange mylist 0 -1 # 查看原来的列表
1) "hello"
2) "hello1"
192.168.0.182:6379[3]> lrange myotherlist 0 -1
1) "hello2"

#####################################################################
#lset 将列表中指定下标的值替换为另外一个值，更新操作。
192.168.0.182:6379[3]> lset mylist 4 item #对不存在的值，会报错
(error) ERR index out of range
192.168.0.182:6379[3]> lset mylist 5 item
(error) ERR index out of range
192.168.0.182:6379[3]> lset mylist 0 item
OK
192.168.0.182:6379[3]> lrange myotherlist 0 -1
1) "hello2"
192.168.0.182:6379[3]> lrange mylist 0 -1
1) "item"
2) "hello1"
192.168.0.182:6379[3]> lset mylist 0 item1
OK
192.168.0.182:6379[3]> lrange mylist 0 -1
1) "item1"
2) "hello1"

#####################################################################
#linsert 将某一个具体的值，插入到列表中某个值的前面或后面

192.168.0.182:6379[3]> linsert mylist before item1  before
(integer) 3
192.168.0.182:6379[3]> lrange mylist 0 -1
1) "before"
2) "item1"
3) "hello1"
192.168.0.182:6379[3]> linsert mylist after item1  after
(integer) 4
192.168.0.182:6379[3]> lrange mylist 0 -1
1) "before"
2) "item1"
3) "after"
4) "hello1"
```

