<?php
/**
 * Created by PhpStorm.
 * User: zhaoye
 * Date: 2017/2/17
 * Time: 上午9:49
 */


class Load{
    final static function  autoloader($class_name){
        $baseClasspath = \str_replace('\\', "/", $class_name) . '.php';
        echo __DIR__."/".$baseClasspath;
        require_once __DIR__."/".$baseClasspath ;
    }
}
//function __autoload($class_name) {
//    $baseClasspath = \str_replace('\\', "/", $class_name) . '.php';
//    echo __DIR__."/".$baseClasspath;
//    require_once __DIR__."/".$baseClasspath ;
//}

spl_autoload_register("Load::autoloader");
$main = new \Main\Main();
//spl_autoload_register(__CLASS__.'::autoload');

echo "dir:".dirname(__DIR__)."\n";
echo "class:".__CLASS__."\n";
echo $main->main();