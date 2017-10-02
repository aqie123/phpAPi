<?php
/*--------------------------------
功能:		使用smsapi.fun.php功能函数发送短信示例
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



include 'smsapi.fun.php';

//用户账号
$uid = 'testsms';
//MD5密码
$pwd = '353447s535dd';



/*
* 变量模板发送示例
* 模板内容：您的验证码是：{$code}，对用户{$username}操作绑定手机号，有效期为5分钟。如非本人操作，可不用理会。【云信】
* 变量模板ID：100003
*/

//号码
$mobile	 = '13900001111,13900001112';
//变量模板ID
$template = '100005';
//6位随机验证码
$code = randNumber();	

//短信内容参数
$contentParam = array(
	'code'		=> $code,
	'username'	=> '您好'
	);
//即时发送
$res = sendSMS($uid,$pwd,$mobile,array_to_json($contentParam),$template);
if( $res['stat']=='100' )
{
	echo "发送成功!";
}
else 
{
	echo "发送失败! 状态：".$res['stat'].'|'.$res['message'];
}


/*
* 全文模板发送示例
* 模板内容：登录验证码：{**}。如非本人操作，可不用理会！【云信】
* 
*/

//号码 多个号码用,英文逗号隔开
$mobile	 = '13900001111';
//短信内容
$code = randNumber();	//验证码
$content = '登录验证码：'.$code.'。如非本人操作，可不用理会！【云信】';
//即时发送
$res = sendSMS($uid,$pwd,$mobile,$content);
if( $res['stat']=='100' )
{
	echo "发送成功!";
}
else 
{
	echo "发送失败! 状态：".$res['stat'].'|'.$res['message'];
}

?>