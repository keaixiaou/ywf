<?php
/**
 * Created by PhpStorm.
 * User: zhaoye
 * Date: 16/7/16
 * Time: 下午2:52
 */


namespace Ywf\Core;

use Ywf\Db\Memcached;
use Ywf\Db\Redis;
use Ywf\Model\Cache;
use Ywf\Model\Model;
use Ywf\Model\Mongo;
use Ywf\Ywf;

class Db {
    private static $_cache = [];
    private static $_redis=[];
    private static $_db=[];
    private static $_mongo;

    private static $server;
    private static $instance=null;


    private static $_memcached;
    private static $_sessionRedis;
    private static $_task;
    private static $_collection;
    private static $lastSql;
    private static $workId;
    private static $_swooleModule;

    private function __construct(){
    }

    /**
     * @return Db
     */
    public static function getInstance(){
        if(empty(self::$instance)){
            self::$instance = new Db();
        }
        return self::$instance;
    }

    /**
     * @param string $tableName
     * @param string $db_key
     * @return Model
     */
    public static function table($tableName='', $mode='default', $driver='mysql'){
        if(!isset(self::$_db[$mode])){
            self::$_db[$mode] = Ywf::make(Model::class, [$tableName, $mode, $driver]);
        }
        return self::$_db[$mode];
    }


    /**
     * @param $collection
     * @return Mongo
     */
    public static function collection($collection=''){
        if(!isset(self::$_mongo)){
            $config = Config::get('mongo');
            self::$_mongo = Ywf::make(Mongo::class, [$collection, $config]);
        }
        return self::$_mongo;
    }

    public static function redis($mode='default'){
        if(!isset(self::$_redis[$mode])){
            $config = Config::getField('redis', $mode);
            self::$_redis[$mode] = Ywf::make(Redis::class, $config)->getConnect();
        }
        return self::$_redis[$mode];
    }

    public static function memcached(){
        if(!isset(self::$_memcached)){
            $config = Config::get('memcached');
            self::$_memcached = Ywf::make(Memcached::class, $config);
        }
        return self::$_memcached;
    }


    /**
     * @return Redis
     */
    public static function cache($driver='redis', $mode='default'){
        if(!isset(self::$_cache[$driver][$mode])){
            self::$_cache[$driver][$mode] = Ywf::make(Cache::class, [$mode, $driver]);
        }
        return self::$_cache[$driver][$mode]->getConnect();
    }



    public static function setSql($sql){
        self::$lastSql = $sql;
    }

    public static function getLastSql(){
        return self::$lastSql;
    }




}