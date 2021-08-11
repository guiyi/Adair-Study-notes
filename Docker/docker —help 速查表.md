

**Docker 主机:**  Docker容器将会在上面运行的Linux虚拟主机。.
**Docker 镜像:**  类似于运行在vm虚拟机上的iso镜像，但它们是高度精简的版本。所有已经存在于docker主机上的多余的包或库都会被移除掉。
**Docker 容器:** Docker镜像的快照，你可以启动、停止、修改它们，或者将它们作为另一个镜像来发布。

![img](https://images2015.cnblogs.com/blog/280044/201706/280044-20170601175556211-1614443760.jpg)**





| info\|version | 镜像仓库 | 本地镜像管理 | 容器操作 | 容器rootfs命令 |
| :-----------: | -------- | ------------ | -------- | -------------- |
|     info      | login    | images       | ps       | commit         |
|    version    | pull     | rmi          | inspect  | cp             |
|               | push     | tag          | top      | diff           |
|               | search   | build        | attach   |                |
|               |          | history      | events   |                |
|               |          | save         | logs     |                |
|               |          | load         | wait     |                |
|               |          | import       | export   |                |
|               |          |              | port     |                |



#### 



![img](https://gimg2.baidu.com/image_search/src=http%3A%2F%2Fimg2020.cnblogs.com%2Fblog%2F821814%2F202101%2F821814-20210109102912082-1978951306.png&refer=http%3A%2F%2Fimg2020.cnblogs.com&app=2002&size=f9999,10000&q=a80&n=0&g=0n&fmt=jpeg?sec=1631259063&t=9fcefe8f332d1c09dc96bd5072764d92)
