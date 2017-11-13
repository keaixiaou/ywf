<?php
/**
 * Created by PhpStorm.
 * author: zhaoye(zhaoye@youzan.com)
 * Date: 2017/11/10
 * Time: 上午11:44
 */

namespace Ywf\Core;

class Env implements InitInterface {
    protected static $data = [];
    public static function init(){
        self::initRunMode();
    }

    private static function initRunMode(){
        $mode = get_cfg_var('RUN_MODE');
        $mode = in_array($mode, ['qatest', 'online', 'local','pre'])?$mode:'qatest';
        self::set('run_mode', $mode);
        $debug = empty(get_cfg_var('DEBUG'))?false:true;
        define('DEBUG', $debug);
        self::set('debug', $debug);
    }

    private static function set($key, $value){
        self::$data[$key] = $value;
    }

    public static function get($key=null){
        if(is_null($key)){
            return self::$data;
        }else{
            return isset(self::$data[$key])?self::$data[$key]:null;
        }
    }
}