# phpApi
1.用户登录注册接口
2.文章类别接口
3.接口实现方法
4.邮件接口
5.第三方(短信，Push消息，IP地址转换，微信支付)

6.API工程化
7.API性能优化

一：
a.Restful API接口实现
b.PHP语法以及基础库
c.API分层实现
d.与前端解耦，并行开发
e.工程化抽离整理代码能力
f.API性能问题定位分析与解决能力

二：
1.API
	a.api无状态性，通过session cookie 实现
	b.RPC（面向方法）
	c.SOA（面向消息）
	d.REST(面向资源)
2.RESTFUL API
3.Yaf框架
	1.
4.高性能PHP框架
5.周边知识与工具
	1.json可视化工具
三：API接口基本实现
	1.用户类(user/login user/reg )
		实现用户登录注册，防止模拟登陆，存储用户session
	2.文章类
		1.文章CURD接口，文章列表页接口
			文章表 art
			文章添加/编辑 (art/add)
		2.用户注册，登录接口
		3.邮件发送接口

四：yaf 基本使用
    1.http://www.phpapi.com/?c=index&a=index 首页
    2.Yaf_Route_rewrite COPY到bootstrap 中自定义路由规则
    3.用户接口类
        a.php实现mysql增删改查
        b.登录注册验证函数 

五：邮件服务接口
		1.phpMailer(composer)		
			a.开启socket
			b.安装composer(https://getcomposer.org/download/)
			c.进入项目目录php composer-setup.php
			 ./composer.phar require phpmailer/phpmailer
			d.配置中国源
					./composer.phar config -g repo.packagist composer https://packagist.phpcomposer.com
			   e. 安装邮件扩展composer require nette/mail

六.扩展第三方
	1.SMS短信发送API
		1.http://sms.cn/
		2. 新建 ThirdParty 将第三方库 复制进来,并重命名
	2.IP地址查询API（http://www.ipip.net/）
		a.应用场景
			1.访问来源统计
			2.小流量线上验证
			3.黑名单
		b.
			1.git@github.com:17mon/php.git
			2.下载到library文件夹下
	3.APP push消息API
		1.个推(aqie phpapi123),小米，极光推送
		2.http://www.getui.com/download/docs/server/GETUI_PHP_SDK.zip 
	4.基于微信支付API
		1.商品价格跟着订单走
		2.
七。API接口提炼(功能实现->功能工程化->功能调优->功能迭代)
	1.APi自测脚本i
		a.安装curl ./composer.phar require curl/curl
		b.php-curl-class/php-curl-class
		c.pingplusplus/pingpp-php
	2.API公共lib的抽离
		a.lib库抽离
			1.新建library/Common/Request.php
		b.sdk统一管理
		c.composer管理第三方类库
		d.
	3.数据操作层DBO
		a.private
	4.接口处理异常规范
	5.Api功能整合
	6.API文档
