<?php

set_time_limit(0);
echo "socket通信客户端\n";
$port = 886;//端口
$ip = "192.168.41.128";//ip
/**
socket连接整个过程
 socket_create //建立一个socket 连接
 socket_connect // 开始一个socket连接  连接服务端
 socket_write //将数据写入缓存   向服务端发送
 socket_read// 读取服务端的结果
 socket_close // 关闭套接字资源
  */
$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
if ($socket < 0) {
    echo "socket_create() failed: reason: " . socket_strerror($socket) . "\n";
}else {
    echo "OK.\n";
}
echo "试图连接 '$ip' 端口 '$port'...\n";
$result = socket_connect($socket, $ip, $port);
if ($result < 0) {
    echo "socket_connect() failed.\nReason: ($result) " . socket_strerror($result) . "\n";
}else {
    echo "连接OK\n";
}
$in = "Ho\r\nfirst blood\r\n";
$out = '';
if(!socket_write($socket, $in, strlen($in))) {
    echo "socket_write() failed: reason: " . socket_strerror($socket) . "\n";
}else {
    echo "发送到服务器信息成功！\n";
    echo "发送的内容为:<font color='red'>$in</font> <br>";
}
while($out = socket_read($socket, 8192)) {
    echo "接收服务器回传信息成功！\n";
    echo "接受的内容为:",$out;
}
echo "关闭SOCKET...\n";
socket_close($socket);
echo "关闭OK\n";
