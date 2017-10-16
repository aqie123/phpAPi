<?php


//创建websocket服务器对象，监听0.0.0.0:9502端口  
$ws_server = new swoole_websocket_server('192.168.144.128', 886);  
  
//设置server运行时的各项参数  
$ws_server->set(array(  
    'daemonize' => true, //是否作为守护进程  
));  
  
//监听WebSocket连接打开事件  
$ws_server->on('open', function ($ws, $request) {  
    file_put_contents( __DIR__ .'/log.txt' , $request->fd);  
    $ws->push($request->fd, "Hello, Welcome\n");  
});  
  
//监听WebSocket消息事件  
$ws_server->on('message', function ($ws, $frame) {  
    pushMessage($ws,$frame);  
});  
  
//监听WebSocket连接关闭事件  
$ws_server->on('close', function ($ws, $fd) {  
    echo "client-{$fd} is closed\n";  
});  
  
$ws_server->start();  
  
//消息推送  
function pushMessage($ws,$frame){  
    $data = $frame->data;  
    $msg = file_get_contents( __DIR__ .'/log.txt');  
    for ($i=1 ; $i<= $msg ; $i++) {  
        $ws->push($i, $frame->fd.' : '.$data);  
    }  
}
 
