<?php
/**
 * Created by PhpStorm.
 * author: zhaoye(zhaoye@youzan.com)
 * Date: 2017/11/14
 * Time: 下午5:54
 */
namespace Library;

class MiddleResponse{
    private $url;
    public function __construct($url)
    {
        $this->url = $url;
    }

    public function getUrl(){
        return $this->url;
    }

}