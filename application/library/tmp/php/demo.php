<?php
/*--------------------------------
功能:		使用smsapi.class.php类发送短信
说明:		http://api.sms.cn/sms/?ac=send&uid=用户账号&pwd=MD5位32密码&mobile=号码&content=内容
官网:		www.sms.cn
状态:		{"stat":"100","message":"发送成功"}

	100 发送成功
	101 验证失败
	102 短信不足
	103 操作失败
	104 非法字符
	105 内容过多
	106 号码过多
	107 频率过快
	108 号码内容空
	109 账号冻结
	112	号码错误
	116 禁止接口发送
	117 绑定IP不正确
	161 未添加短信模板
	162 模板格式不正确
	163 模板ID不正确
	164 全文模板不匹配
--------------------------------*/

include 'smsapi.class.php';

//接口账号
$uid = 'testsms';

//登录密码
$pwd = 'test22224234';

/**
* 实例化接口
* 
* @param string $uid 接口账号
* @param string $pwd 接口密码
*/
$api = new SmsApi($uid,$pwd);


/*
* 变量模板发送示例
* 模板内容：您的验证码是：{$code}，对用户{$username}操作绑定手机号，有效期为5分钟。如非本人操作，可不用理会。【云信】
* 变量模板ID：100003
*/

//发送的手机 多个号码用,英文逗号隔开

$mobile = '15900000000';

//短信内容参数
$contentParam = array(
	'code'		=> $api->randNumber(),
	'username'	=> '您好'
	);

//变量模板ID
$template = '100005';

//发送变量模板短信
$result = $api->send($mobile,$contentParam,$template);

if($result['stat']=='100')
{
	echo '发送成功';
}
else
{
	echo '发送失败:'.$result['stat'].'('.$result['message'].')';
}



/*
* 全文模板发送示例
* 模板内容：登录验证码：{**}。如非本人操作，可不用理会！【云信】
* 
*/

//发送的手机 多个号码用,英文逗号隔开
$mobile = '15900000000';

//短信内容
$content = '登录验证码：'.$api->randNumber().'。如非本人操作，可不用理会！【云信】';


//发送全文模板短信
$result = $api->sendAll($mobile,$content);

if($result['stat']=='100')
{
	echo '发送成功';
}
else
{
	echo '发送失败:'.$result['stat'].'('.$result['message'].')';
}



//当前请求返回的原始信息
//echo $api->getResult();

//取剩余短信条数
//print_r($api->getNumber());

//获取发送状态
//print_r($api->getStatus());

//接收上行短信（回复）
//print_r($api->getReply());
?>