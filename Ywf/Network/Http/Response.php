<?php
/**
 * Created by PhpStorm.
 * User: zhaoye
 * Date: 2017/4/14
 * Time: 下午2:39
 */

namespace Ywf\Network\Http;

use Ywf\Cookie\Cookie;
use Ywf\Core\YwfException;
use Ywf\Network\BaseResponse;
use Ywf\Session\Session;

class Response extends BaseResponse{

    const CODE_NORMAL = 200;
    const CODE_REDIRECT = 302;
    static $HTTP_HEADERS = array(
        100 => "100 Continue",
        101 => "101 Switching Protocols",
        200 => "200 OK",
        201 => "201 Created",
        204 => "204 No Content",
        206 => "206 Partial Content",
        300 => "300 Multiple Choices",
        301 => "301 Moved Permanently",
        302 => "302 Found",
        303 => "303 See Other",
        304 => "304 Not Modified",
        307 => "307 Temporary Redirect",
        400 => "400 Bad Request",
        401 => "401 Unauthorized",
        402 => "402 Address error",
        403 => "403 Forbidden",
        404 => "404 Not Found",
        405 => "405 Method Not Allowed",
        406 => "406 Not Acceptable",
        408 => "408 Request Timeout",
        410 => "410 Gone",
        413 => "413 Request Entity Too Large",
        414 => "414 Request URI Too Long",
        415 => "415 Unsupported Media Type",
        416 => "416 Requested Range Not Satisfiable",
        417 => "417 Expectation Failed",
        500 => "500 Internal Server Error",
        501 => "501 Method Not Implemented",
        503 => "503 Service Unavailable",
        506 => "506 Variant Also Negotiates",
    );

    private $header = [
        'Connection'=>'keep-alive'
    ];

    private $session = [];
    private $code = 200;

    protected function setTypeVal($type, $key, $value){
        if(is_null($value))
            unset($this->$type[$key]);
        else{
            $this->$type = array_merge($this->$type, [$key => $value]);
        }

    }

    public function setHeader($header){
        $this->header = $header;
    }

    public function setHeaderVal($key, $value=null){
        $this->setTypeVal('header', $key, $value);
    }


    public function setSession($session){
        $this->session = $session;
    }

    public function setSessionVal($key, $value){
        $this->setTypeVal('session', $key, $value);
    }

    public function setHttpCode($code){
        $this->code = $code;
    }


    protected function responseHeader(){
        foreach ($this->header as $key => $value){
            header($key . ':' . $value);
        }
    }

    protected function responseSession(){
        Session::finish();
    }

    public function finish(){
        $this->responseHeader();
        $this->responseSession();
        http_response_code($this->code);
        echo $this->content;
        if (function_exists('fastcgi_finish_request')) {
            // 提高页面响应
            fastcgi_finish_request();
        }
    }
}