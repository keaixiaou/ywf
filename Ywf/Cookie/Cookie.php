<?php
/**
 * Created by PhpStorm.
 * author: zhaoye(zhaoye@youzan.com)
 * Date: 2017/11/13
 * Time: 下午5:09
 */

namespace Ywf\Cookie;

class Cookie {
    private static $data;

    public static function init(){
        self::$data = $_COOKIE;
    }

    public static function get($key){
        return isset(self::$data[$key])?self::$data[$key]:null;
    }

    public static function set($key, $value=null){
        if(is_null($value)){
            unset(self::$data[$key]);
        }else{
            self::$data[$key] = $value;
        }
    }

    public static function finish(){
        if(!empty(self::$data)){
            foreach (self::$data as $key => $value){
                setcookie($key, $value);
            }
        }

    }
}