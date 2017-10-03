<?php
require_once __DIR__.'/../vendor/autoload.php';
use \Curl\Curl;

$host = 'http://localhost/';
$curl = new Curl();
$uname = 'apitest_'.rand();
$pwd = 'apitest_'.rand();

// 注册接口验证

$curl->post(
		$host."/user/register",
		array('uname'=>$uname, 'pwd'=>$pwd)
	);
// 登录接口验证


echo 'check down.'.'\n';
