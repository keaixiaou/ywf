<?php
/**
 * Created by PhpStorm.
 * author: zhaoye(zhaoye@youzan.com)
 * Date: 2017/11/11
 * Time: 下午5:07
 */
namespace Ywf\Db;

class Redis implements Connect {
    private $connect;
    public function __construct($config)
    {
        if(empty($config)) {
            throw new \Exception("Connnect config can't Empty!", -1);
        }
        $name = $config['host'].PATH_SEPARATOR.$config['port'];
        $timeOut = 0;
        if(isset($config['timeout'])) {
            $timeOut = $config['timeout'];
        }
        $pconnect = !empty($config['pconnect']);
        $redis = new \Redis();
        if ($pconnect) {
            $redis->pconnect($config['host'], $config['port'], $timeOut);
        } else {
            $redis->connect($config['host'], $config['port'], $timeOut);
        }
        $redis->setOption(\Redis::OPT_SERIALIZER, \Redis::SERIALIZER_NONE);
        if(!empty($config['auth'])) {
            $redis->auth($config['auth']);
        }
        if(!empty($config['select'])){
            $redis->select($config['select']);
        }
        $this->connect = $redis;
    }

    public function getConnect(){
        return $this->connect;
    }
}