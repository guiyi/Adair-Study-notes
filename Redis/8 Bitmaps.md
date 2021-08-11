### 位存储

统计用户信息，活跃，不活跃！ 登录、未登录！打卡，365打卡！ 两个状态的，都可以使用 Bitmaps!

Bitmaps 位图，数据结构！ 都是操作二进制位来进行记录，就只有0和1两个状态！

365天 = 365 bit    1字节 = 8 bit

```shell
192.168.0.182:6379[3]> setbit sign 0 0
(integer) 0
192.168.0.182:6379[3]> setbit sign 1 1
(integer) 0
192.168.0.182:6379[3]> setbit sign 2 1
(integer) 0
192.168.0.182:6379[3]> setbit sign 3 1
(integer) 0
192.168.0.182:6379[3]> setbit sign 4 1
(integer) 0
192.168.0.182:6379[3]> setbit sign 5 0
(integer) 0
192.168.0.182:6379[3]> setbit sign 6 0
(integer) 0
192.168.0.182:6379[3]> getbit sign 3  #获取某一天的打卡情况
(integer) 1
192.168.0.182:6379[3]> bitcount sign  #统计本周打卡记录，是否有全勤
(integer) 4
```