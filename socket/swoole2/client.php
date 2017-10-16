<?php
// 客户端代码

$client = new swoole_client(SWOOLE_SOCK_TCP);
if (!$client->connect('192.168.41.128', 886, -1))
{
	exit("connect failed. Error: {$client->errCode}\n");
}
$client->send("hello world\n");
echo $client->recv();
$client->close();
