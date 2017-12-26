<?php
/**
 * Created by PhpStorm.
 * User: zhaoye
 * Date: 16/9/14
 * Time: 下午5:16
 */

namespace Ywf\Controller;

use Library\MiddleResponse;
use Ywf\Core\Config;
use Ywf\Core\Log;
use Ywf\Core\YwfException;
use Ywf\Network\Http\Error;
use Ywf\Ywf;
use Ywf\Network\Http\Request;
use Ywf\Network\Http\Response;
use Ywf\View\View;

class Controller {


    /**
     * @var Request $request;
     */
    protected $request;
    /**
     * @var Response $response;
     */
    protected $response;

    /**
     * @var Context $context;
     */
    protected $context;
    protected $baseMethod;
    protected $baseParam = [];


    protected $cookie;

    protected $session;

    /**
     * @var View $view;
     */
    protected $view;


    protected $template;
    protected $tplVar = [];
    protected $tplFile = '';


    function __construct()
    {
        $vConfig = Config::getField('project', 'view');
        $this->view = Ywf::make(View::class, $vConfig);
        $this->request = Ywf::make(Request::class);
        $this->response = Ywf::make(Response::class);
        $this->context = Ywf::make(Context::class);
    }

    protected final function middleware(){
        $middleRet = true;
        try {
            $middlewareConfig = Config::getField('middleware', $this->context->get('module'));
            if(!empty($middlewareConfig)){
                foreach ($middlewareConfig as $middle) {
                    $middRes = Ywf::make($middle)->doFilter($this->request);
                    if ($middRes !== true && $middRes instanceof MiddleResponse) {
                        $this->redirect($middRes->getUrl());
                        throw new \Exception("");
                    }
                }
            }
        }catch(\Exception $e){
            $middleRet = false;
        }
        return $middleRet;
    }

    /**
     * 全局变量的初始化
     */
    public function init()
    {
        $viewConfig = [
            'module' => $this->context->get('module'),
            'controller' => $this->context->get('controller'),
            'method' => $this->context->get('action')
        ];
        $this->view->init($viewConfig);
    }


    /**
     * 处理请求
     */
    public final function ywfStart(){
        try{
            $this->init();
            $initRes = true;
            if(method_exists($this, 'middleware')){
                $initRes = $this->middleware();
            }

            $result = null;
            if($this->checkResponse() && $initRes === true){
                $result = call_user_func_array([$this, $this->baseMethod], $this->baseParam);
            }
        }catch(\Exception $e){
            $this->onUserExceptionHandle($e->getMessage());
            Error::setException($e);
            $result = Error::info($e->getMessage());
        }

        $this->endResponse($result);
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

    public function setApi(){
        $this->response->setApi();
    }

    public function checkApi(){
        return $this->response->checkApi();
    }

    public function setMvc($mvc){
        $this->context->set('module', $mvc['module']);
        $this->context->set('controller', $mvc['controller']);
        $this->context->set('action',  $mvc['action']);
        $this->baseMethod = $this->context->get('action');
    }

    protected function endResponse($result){
        if($this->checkResponse()){
            if(!is_string($result) && $this->checkApi()){
                $this->jsonReturn($result);
            }else{
                $this->strReturn($result);
            }
        }

        $this->response->finish();
        Log::clear();
    }


    protected function setResponseContent($content){
        $this->response->setReponseContent($content);
    }

    protected function setStatusCode($code){
        $this->response->setHttpCode($code);
    }

    /**
     * @param $key
     * @param $value
     */
    protected function setHeader($key, $value){
        $this->response->setHeaderVal($key, $value);
    }


    /**
     * html return
     * @param $data
     */
    protected function strReturn($data, $code=Response::CODE_NORMAL){
        if($this->checkResponse()){
            $this->setHeader('Content-Type', 'text/html; charset=utf-8');
            $result = strval($data);
            $this->setStatusCode($code);
            $this->setResponseContent($result);
        }
    }


    /**
     * json return
     * @param $data
     * @throws \Exception
     */
    protected function jsonReturn($data){
        if($this->checkResponse()) {
            $result = json_encode($data);
            if (!empty(Config::get('response_filter'))) {
                $result = $this->strNull($result);
            }
            $this->setStatusCode(Response::CODE_NORMAL);
            $this->setHeader('Content-Type',   'application/json');
            $this->setResponseContent($result);
        }
    }

    /**
     * 返回图片
     * @param $content
     * @param $type
     */
    protected function image($content, $type){
        if($this->checkResponse()) {
            $this->setHeader('Content-Type', 'image/' . $type);
            $this->setStatusCode(200);
            ob_start();
            $ImageFun = 'image'.$type;
            $ImageFun($content);
            $result = ob_get_contents();
            imagedestroy($content);
            $this->setResponseContent($result);
        }
    }


    /**
     * 传入变量到模板
     * @param $name
     * @param $value
     */
    public function assign($name, $value){
        $this->tplVar[$name] = $value;
    }


    /**
     * 设置模板
     * @param $template
     * @throws \Exception
     */
    public function setTemplate($template){
        $this->view->setTemplate($template);
    }


    /**
     * 获取当前请求对应html的内容
     * @param string $tplFile
     * @return mixed
     * @throws \Exception
     */
    public function fetch($tplFile=''){
        return $this->view->fetch($this->tplVar, $tplFile);
    }


    /**
     * 跳转方法
     * @param $url
     */
    public function redirect($url){
        $this->setHeader('Location', $url);
        $this->strReturn('', Response::CODE_REDIRECT);
    }


    /**
     * 载入模板文件
     * @param string $tplFile
     */
    public function display($tplFile=''){
        $content = $this->fetch($tplFile);
        $this->strReturn($content);
    }



    /**
     * 异常处理
     */
    public function onUserExceptionHandle($message){
        $this->strReturn($message);
    }

    /**
     * 系统异常错误处理
     * @param $message
     */
    public function onSystemException($message){
        $message = DEBUG===true?$message:'系统出现了异常';
        $this->strReturn($message, 500);
    }




}