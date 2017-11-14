<?php
/**
 * Created by PhpStorm.
 * User: zhaoye
 * Date: 2016/11/28
 * Time: 下午3:43
 */


namespace Ywf\Core;

class Route {
    static public $matchRouteList=[];
    static public $routeList = [];
    static public function init(){
        $routeConfig = Config::get('route');
        if(!empty($routeConfig)) {
            foreach ($routeConfig as $key => $value) {
                $method = strtoupper($key);
                foreach ($value as $k => $v) {
                    $routeK = $k;
                    if (is_string($v)) {
                        $v = trim($v, '\\');
                    }
                    if ($method == 'ANY') {
                        self::$routeList['POST'][$routeK] = $v;
                        self::$routeList['GET'][$routeK] = $v;
                    } else {
                        self::$routeList[$method][$routeK] = $v;
                    }
                }
            }
        }
    }

    /**
     * 路由解析
     * @param $uri
     * @param $method
     * @return array|null
     * @throws \Exception
     */
    static public function parse($uri, $method){
        $uriResult = self::routeParse($uri, $method);
        if(empty($uriResult)){
            $uriResult = self::defaultParse($uri);
        }
        return $uriResult;
    }

    /**
     * 配置文件的路由解析
     * @param $uri
     * @param $method
     * @throws \Exception
     */
    static public function routeParse($uri, $method){
        $method = strtoupper($method);
        $uriResult = null;
        if(!empty(self::$routeList[$method][$uri])){
            $uriResult = self::$routeList[$method][$uri];
            if(is_string($uriResult)){
                $uriResult = self::parseString($uriResult);
            }else if($uriResult instanceof \Closure){
                $uriResult = ['callback'=>$uriResult];
            }
        }
        /**
         * 考虑性能不做这块的功能
         */
//        else if(!empty(self::$matchRouteList[$method])){
//            $methodMatchList = self::$matchRouteList[$method];
//            foreach($methodMatchList as $key => $value){
//                if(preg_match($key, $uri, $tmpMatch)){
//                    if(is_string($value))$uriResult = self::parseString($value);
//                    else $uriResult = ['callback'=>$value,'param'=>$tmpMatch];
//                }
//            }
//        }
        return $uriResult;
    }

    /**
     * 解析路由里字符串
     * @param $str
     * @return array
     * @throws \Exception
     */
    protected static function parseString($str){
        $mvc = explode('\\', $str);
        $explodeNum = count($mvc)-1;
        if($explodeNum>=1){
            if($explodeNum==1){
                $mvcConfig = Config::getField('project', 'mvc');
                $uriResult = [
                    'module' => $mvcConfig['module'],
                    'controller' => $mvc[0],
                    'action' => $mvc[1],
                ];
            }else{
                $uriResult = [
                    'module' => $mvc[0],
                    'controller' => $mvc[1],
                    'action' => $mvc[2],
                ];
            }
        }
        return ['mvc'=>self::dealUcfirst($uriResult)];
    }

    /**
     * 默认解析路由
     * @param $uri
     * @return array
     * @throws \Exception
     */
    static public function defaultParse($uri){
        $mvc = Config::getField('project','mvc');
        $urlArray = explode('/', trim($uri,'/'));
        if(!empty($urlArray[2])){
            $mvc['module'] = $urlArray[0];
            $mvc['controller'] = $urlArray[1];
            $mvc['action'] = $urlArray[2];
        }else if(!empty($urlArray[1])){
            $mvc['controller'] = $urlArray[0];
            $mvc['action'] = $urlArray[1];
        }else if(!empty($urlArray[0])){
            $mvc['module'] = $urlArray[0];
        }
        $mvc = [ 'mvc'=> self::dealUcfirst($mvc)];
        return $mvc;
    }


    /**
     * 首字母大写
     * @param $mvc
     * @return array
     */
    static function dealUcfirst($mvc){
        return [
            'module'=>ucwords($mvc['module']),
            'controller'=>ucwords($mvc['controller']),
            'action'=>$mvc['action'],
        ];
    }
}