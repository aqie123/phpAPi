<?php
// 服务器代码
echo 'waiting for connect...'."\n";
$serv = new swoole_server("192.168.41.128",886 );
$serv->on('connect', function ($serv, $fd){
	echo "Client:Connect.\n";
});
$serv->on('receive', function ($serv, $fd, $from_id, $data) {
	$serv->send($fd, 'Swoole: '.$data);
});
$serv->on('close', function ($serv, $fd) {
	echo "Client: Close.\n";
});
$serv->start();
