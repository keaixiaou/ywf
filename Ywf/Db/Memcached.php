<?php
/**
 * Created by PhpStorm.
 * author: zhaoye(zhaoye@youzan.com)
 * Date: 2017/11/13
 * Time: 下午7:08
 */

namespace Ywf\Db;



class Memcached{
    protected $manager;
    protected $config;
    function __construct($config)
    {
        $this->config = $config;

    }

    protected function checkManager(){
        if(empty($this->manager)) {
            $this->manager = new \Memcached();
            $this->manager->addServer($this->config['host'], $this->config['port']);
        }
    }

    public function get($key){
        $this->checkManager();
        $res = $this->manager->get($key);
        return $res;
    }


    public function set($key, $value, $time_expire=3600){
        $this->checkManager();
        return $this->manager->set($key, $value, $time_expire);
    }

    public function delete($key){
        $this->checkManager();
        return $this->manager->delete($key);
    }
}