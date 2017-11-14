<?php
/**
 * Created by PhpStorm.
 * author: zhaoye(zhaoye@youzan.com)
 * Date: 2017/11/14
 * Time: 上午11:22
 */
namespace Ywf\Controller;

class Context {
    private $data=[];
    public function set($key , $value){
        if(is_null($value)){
            unset($this->data[$key]);
        }else{
            $this->data[$key] = $value;
        }

    }

    public function get($key){
        return isset($this->data[$key])?$this->data[$key]:null;
    }
}