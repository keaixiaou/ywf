<?php
/**
 * Created by PhpStorm.
 * User: zhaoye
 * Date: 16/7/16
 * Time: 下午2:57
 */


function table($tableName, $poolName='default'){
    return \ZPHP\Core\Db::getInstance()->table($tableName, $poolName);
}

function collection($collectionName){
    return \ZPHP\Core\Db::collection($collectionName);
}

function cache($key, $value='', $expire=3600){
    $cache = \ZPHP\Cache\Factory::getInstance();
    if($value===null){
        return $cache->delete($key);
    }
    if('' === $value){
        return $cache->get($key);
    }
    return $cache->set($key, $value, $expire);
}


function url($str){
    if($str[0]!='/'){
        $str = '/'.$str;
    }
    echo $str;
}