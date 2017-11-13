<?php
/**
 * Created by PhpStorm.
 * User: zhaoye
 * Date: 2017/1/21
 * Time: 下午2:55
 */

namespace Ywf\Controller;

use Ywf\Network\BaseResponse;

abstract class IController{

    public $module;
    public $controller;
    public $action;
    protected $baseMethod;
    protected $baseParam = [];


    /**
     * @var BaseResponse
     */
    protected $response;

    protected function middleware(){
        return true;
    }

    public function setApi(){
        $this->response->setApi();
    }

    public function checkApi(){
        return $this->response->checkApi();
    }

    public function ywfStart(){

    }

    public function setMvc($mvc){
        $this->module = $mvc['module'];
        $this->controller = $mvc['controller'];
        $this->action = $mvc['action'];
        $this->baseMethod = $this->action;
    }

    public function setBaseMethodParam($method, $param){
        $this->baseMethod = $method;
        $this->baseParam = $param;
    }

    /**
     * 异常处理
     */
    public function onExceptionHandle($message){

    }

    public function onSystemException($message){

    }

    /**
     * 返回null 替换
     * @access protected
     * @return String
     */
    protected function strNull($str){
        return str_replace(array('NULL', 'null'), '""', $str);
    }


    /**
     * 检测response是否结束
     * @return bool
     */
    protected function checkResponse(){
        return $this->response->checkResponse();
    }

    public function destroy(){
    }


    function __destruct()
    {
        // TODO: Implement __destruct() method.
    }

}