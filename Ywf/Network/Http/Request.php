<?php
/**
 * Created by PhpStorm.
 * author: zhaoye(zhaoye@youzan.com)
 * Date: 2017/11/10
 * Time: 下午10:06
 */

namespace Ywf\Network\Http;

use Ywf\Core\Filter;
use Ywf\Session\Session;

class Request{
    public $server;
    public $uri;
    public $env;
    public $get;
    public $post;
    public $request;
    public $cookie;
    public $session;


    public function __construct()
    {
        $this->init();
    }

    public function init(){
        $this->server = $_SERVER;
        $parseUrl = parse_url($this->server['REQUEST_URI']);
        $this->uri = $parseUrl['path'];
        $this->env = $_ENV;
        $this->get = $_GET;
        $this->post = $_POST;
        $this->request = $_REQUEST;
        Session::init();
        $this->session = Session::get();
        $this->cookie = $_COOKIE;
    }


    /**
     * @param $key
     * @param bool $filter
     * @return string
     */
    public function __call($method, $param){
        if(empty($param)){
            return $this->$method;
        }else {
            $filter = isset($param[1]) ? $param[1]:true;
            $attribute = $this->$method;
            if(isset($attribute[$param[0]])){
                return $this->_getHttpVal($attribute[$param[0]], $filter );
            }else{
                return null;
            }
        }
    }


    /**
     * @param $variableArray
     * @param $key
     * @param $filter
     * @return string
     */
    protected function _getHttpVal($value, $filter){
        if(!isset($value))
            return null;
        if($filter)
            return Filter::run($value);
        else
            return $value;
    }



}