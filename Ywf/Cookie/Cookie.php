<?php
/**
 * Created by PhpStorm.
 * author: zhaoye(zhaoye@youzan.com)
 * Date: 2017/11/13
 * Time: 下午5:09
 */

namespace Ywf\Cookie;

class Cookie {
    private $data;
    public function __construct()
    {
        $this->init();
    }

    public function init(){
        $this->data = $_COOKIE;
    }

    public function get($key){
        return isset($this->data[$key])?$this->data[$key]:null;
    }

    public function set($key, $value=null){
        if(is_null($value)){
            unset($this->data[$key]);
        }else{
            $this->data[$key] = $value;
        }
    }

    public function finish(){
        foreach ($this->data as $key => $value){
            setcookie($key, $value);
        }
    }
}