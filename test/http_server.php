<?php
/**
 * Created by PhpStorm.
 * User: zhaoye
 * Date: 2017/3/1
 * Time: 下午1:54
 */
class Request{
    public function res(){
        return "hello world!";
    }
}

$http = new \swoole_http_server("127.0.0.1", 9501);
$http->set(array(
    'worker_num' => 1,
    'daemonize' => true,
    'log_file' => '/tmp/swoole.log',
));
$http->on('request', function ($request, $response) {
    $req = new Request();
    $response->end($req->res());
});
$http->start();