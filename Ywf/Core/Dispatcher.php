<?php
/**
 * Created by PhpStorm.
 * User: zhaoye
 * Date: 2016/11/29
 * Time: 下午5:14
 */

namespace Ywf\Core;

use Ywf\Network\Http\Request;
use Ywf\Ywf;

class Dispatcher{

    public function run(Request $request){
        $route = Route::parse($request->uri,
            $request->server['REQUEST_METHOD']);
        if (!empty($route['callback'])) {
            $httpCallback = $this->callbackDistribute($route['callback'], $route['param']);
        } else {
            $this->defaultDistribute($route['mvc']);
            $httpCallback = $route['mvc'];
        }
        return $httpCallback;

    }


    /**
     * 路由映射为闭包函数的
     * @param \Closure $callback
     * @param $param
     * @return mixed|void
     */
    public function callbackDistribute(\Closure $callback, $param)
    {
        $reflectFunc = new \ReflectionFunction($callback);
        $reflectParam = $reflectFunc->getParameters();
        $paramArray = [];
        foreach($reflectParam as $key => $value){
            if(!isset($param[$value->name])){
                break;
            }
            $paramArray[] = $param[$value->name];
        }
        $callbackResult = function() use($callback, $paramArray){
           return call_user_func_array($callback, $paramArray);
        };
        return $callbackResult;
    }


    /**
     * 默认mvc模式
     */
    public function defaultDistribute($mvc)
    {
        $controllerClass = 'controller\\'.$mvc['module'].'\\'.$mvc['controller'];
        $controller = Ywf::make($controllerClass);
        $action = $mvc['action'];
        if(!method_exists($controller, $action)){
            throw new YwfException("404|$controllerClass".DS."$action not Found!");
        }
    }





}