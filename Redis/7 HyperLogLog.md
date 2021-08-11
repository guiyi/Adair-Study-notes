### 什么是基数？

A {1,3,5,7,8,7}

B {1,3,5,7.8}

基数（不重复的元素） = 5，可以接受误差！

HyperLogLog 数据结构 做基数统计的算法！

**网页的UV（一个人访问一个网站多次，但是还是算作一个人！）**

传统的方式，set保存用户的id，然后就可以统计set中的元素数据作为标准判断！

这个方法如果保存大量的用户id，就会比较麻烦！ 我们的目的是为了计数，而不是保存用户id；

0.81 % 错误率！ 统计UV  任务，可以忽略不计！



```shell
192.168.0.182:6379[3]> pfadd mykey a b c d e f g h i j #创建第一组元素
(integer) 1
192.168.0.182:6379[3]> pfcount mykey #统计mykey元素的基数量
(integer) 10
192.168.0.182:6379[3]> pfadd mykey2 i j k x c v b n m #创建第二组元素
(integer) 1
192.168.0.182:6379[3]> pfcount mykey2
(integer) 9
192.168.0.182:6379[3]> pfmerge mykey mykey2 #合并两组元素
OK
192.168.0.182:6379[3]> pfcount mykey # 查看并集的数量
(integer) 15
```

