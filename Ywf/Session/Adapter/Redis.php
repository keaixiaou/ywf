<?php
/**
 * User: shenzhe
 * Date: 13-6-17
 */


namespace Ywf\Session\Adapter;


use Ywf\Core\Config;
use Ywf\Core\Db;
use Ywf\Session\Handle;
use Ywf\Session\Session;
use Ywf\Ywf;

class Redis implements Handle
{
    private $redis;
    private $gcTime = 1800;

    public function __construct()
    {
        $config = Config::get('session');
        if (empty($this->redis)) {
            $this->redis = Db::redis('session');

            if (!empty($config['cache_expire'])) {
                $this->gcTime = $config['cache_expire'] ;
            }
        }
    }
    
    public function get(){
        $sessionKey = Session::getSessionKey();
        $value = $this->redis->get($sessionKey);
        return unserialize($value);
    }
    
    public function set($data){
        $sessionKey = Session::getSessionKey();
        $value = serialize($data);
        $this->redis->set($sessionKey, $value, $this->gcTime);
    }


}
