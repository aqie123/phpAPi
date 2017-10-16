<?php
# 公共协议名字来获取一个协议类型 udp icmp
$commonProtocol = getprotobyname("tcp");
# 产生一个socket并且返回一个socket资源的实例
$socket = socket_create(AF_INET, SOCK_STREAM,$commonProtocol);
# 绑定端口
socket_bind($socket,'localhost',1337);
socket_listen($socket);
# socket_create ( int $domain , int $type , int $protocol ) 返回资源
var_dump($socket);
# 非阻塞转换为阻塞
socket_set_block($socket);
$str = 'aqie123456';
# socket_write ( resource $socket , string $buffer [, int $length = 0 ] )
socket_write($socket, $str);
/* socket_read ( resource $socket , int $length [, int $type = PHP_BINARY_READ ] )
 pfsockopen 实现持久长连接,脚本结束不会断开 , fsockopen
 socket_set_option ( resource$socket , int$level , int$optname , mixed$optval )
$socket 是必选参数，代表一个有效的socket句柄。

$level 是必选参数，指定option起作用的协议级别，一般取常量 SOL_SOCKET。

$optname 是必选参数，指定要控制的选项名称。

$optval 是必选参数，指定选项的值。
 socket_last_error ([ resource$socket ] )
# socket_strerror ( int $errno )



socket_create ( int $domain , int $type , int $protocol )
此函数用于创建一个socket，它有三个参数，返回值是一个句柄（资源）。

$domain 指定创建socket时使用的通信协议族，其可选的值为：

AF_INET： 基于IPv4的Internet协议

AF_INET6：基于IPv6的Internet协议

AF_UNIX：UNIX本地通信协议

$type 指定socket通信的交互类型，其可选的值为：

SOCK_STREAM：提供序列化的、可靠的、全双工的、基于连接的字节流传输，支持TCP

SOCK_DGRAM：提供数据报式的、无连接的、固定最大长度的、自动寻址功能的传输，支持UDP

SOCK_SEQPACKET：提供序列化的、可靠的、双通道的、基于连接的数据报传输

SOCK_RAW：提供原始的网络访问协议，可手工构建特殊协议类型的套接字，支持ICMP请求（如 ping）

SOCK_RDM：提供可靠的数据报传输，无法保证顺序

$protocol 指定socket使用哪种具体的传输协议，包括ICMP、UDP、TCP，常量SOL_UDP对应UDP，常量SOL_TCP对应常量TCP。 


类似nginx+fpm的方案，fooking+fpm=php长连接，gateway用于承载连接，router用于转发消息。
$sid = $_SERVER['SESSIONID'];//这是sessionid 
$data = file_get_contents("php://input");//这样就能拿到请求内容了 
//想要返回消息只需要两步 
header('Content-Length: 11');//返回给客户端字节数 
echo "hello world"; 
//想要给别的用户发消息 
include 'api.php'; 
$router = new RouterClient('router host', 'router port'); 
$router->sendMsg(用户sessionid, "fuck you"); 
//想要给所有人要消息 
$router->sendAllMsg("fuck all"); 
//想给指定组发消息(类似redis的pub/sub) 
$router->publish("channel name", "fuck all");
