<?php
/**
 * Created by PhpStorm.
 * User: zhaoye
 * Date: 2017/5/16
 * Time: 下午8:33
 */

$swoole = new swoole_client(SWOOLE_TCP, SWOOLE_SOCK_ASYNC);
$swoole->set([
    "open_length_check" => true,
    "package_length_type" => 'N',
    "package_length_offset" => 0,
    "package_body_offset" => 4,
    "package_max_length" => 327679,
    "socket_buffer_size" => 327679,
    "open_tcp_nodelay" => true,
]);
$ok = false;
$recive = function (swoole_client $swoole, $data) use($ok){
    var_dump('receive:'.$data);
    $type = substr($data, 4);
    $type = unpack('N', $type);
    $body = substr($data, 3);
    var_dump($body);

    echo "\n";
    if(strpos($body, 'OK' )!==false){
        echo "data is oK!\n";
        $ok = true;
        $swoole->send("RDY 20\n");
    }else if(empty($ok)){

        var_dump($type)."\n";
        $swoole->send("SUB test cy_auto_confirm11\n");

    }else{

    }

};
$swoole->on("connect",  function(swoole_client $swoole){
    echo "connect\n";
    $swoole->send('  V2');

    $payload = '{"client_id":"zhaoyedeMacBook-Air.local","hostname":"zhaoyedeMacBook-Air.local","feature_negotiation":true,"heartbeat_interval":30000,"output_buffer_size":16384,"output_buffer_timeout":-1,"tls_v1":false,"snappy":false,"deflate":false,"deflate_level":1,"sample_rate":0,"user_agent":"zan-nsq-client/v0.1","msg_timeout":0}';
    $identify = "IDENTIFY \n" . pack('N', strlen($payload)) . $payload;
    $swoole->send($identify);
});
$swoole->on("receive", $recive); // Cannot destroy active lambda function
$swoole->on("close", function(){
    echo "close";
});
$swoole->connect('127.0.0.1', 4150, -1);

