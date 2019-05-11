# chasuoxie
[查缩写](https://www.expshort.com/)

每每看到一些计算机的缩写，总是好奇到底全称是什么。

那么现在，做个网站，可以查缩写词的全称，以及描述。

如果没有词条，你也可以添加词条。

### 新增alfred workflow
快捷键 sx(缩写)
例如：sx ls

#### 【TODO】

1、查询速度问题--由于国外vps机器，暂把域名解析到本地请求到本地数据库

2、查询后写入本地缓存，一段时间内无需再一次请求

3、workflow本身的一个缺点是每输入一个字符都去查询一次(有道词典的workflow测试也一样)，如果workflow能在输入时把输入间隔时间设置下再去查询接口，体验会更好.

如图：输入ls，l字母输入发起了一次查询，返回无结果；输入s后才查到ls

![gif](https://raw.githubusercontent.com/mr-von-chn/expshort/master/2019-05-11%2011_38_11.gif)

#### P.S

此workflow是参考![weather-workflow](https://github.com/wensonsmith/weather-workflow)基础上进行修改的，在此致谢！
