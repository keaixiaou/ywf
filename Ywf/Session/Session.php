<?php
/**
 * Created by PhpStorm.
 * User: zhaoye
 * Date: 2016/11/14
 * Time: 11:11
 */

namespace Ywf\Session;


use Ywf\Cookie\Cookie;
use Ywf\Core\Config;
use Ywf\Core\Rand;
use Ywf\Session\Adapter\File;
use Ywf\Session\Adapter\Redis;
use Ywf\Ywf;

abstract class Session
{
    const ADAPTER_FILE = 'File';
    const ADAPTER_SESSION = 'Redis';
    const KEY = 'SESSID';
    private static $config;
    /**
     * @var \Handle $handle;
     */
    private static $handle;

    private static $Adapters = [
        'File' => File::class,
        'Redis' => Redis::class,
    ];

    private static $data = [];

    public static function get($key=null){
        $value = self::$data;
        if(!is_null($key)){
            $value = isset($value[$key])?$value[$key]:null;
        }
        return $value;
    }

    public static function set($key, $value){
        if(is_null($value)){
            unset(self::$data[$key]);
        }else{
            self::$data[$key] = $value;
        }
    }


    public static function init(){
        $sessionConfig = Config::get('session');
        self::$config = $sessionConfig;
        if(self::$config['enable']) {
            $adapter = $sessionConfig['adapter'];
            $adapterClass = self::$Adapters[$adapter];
            self::$handle = Ywf::make($adapterClass);
            self::$data = self::$handle->get();
        }
    }

    public static function finish(){
        if(self::$config['enable']) {
            Cookie::finish();
            self::$handle->set(self::$data);
        }
    }

    public static function getSessionKey(){
        $sid = Cookie::get(self::KEY);
        if(empty($sid)){
            $sid = Rand::string(26);
            Cookie::set(self::KEY, $sid);
        }
        return Config::getField('session', 'name').'_'.$sid;
    }
}