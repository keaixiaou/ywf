<?php
/**
 * Created by PhpStorm.
 * User: zhaoye
 * Date: 2017/2/28
 * Time: 下午4:09
 */



$module = swoole_load_module('/desktop/swoole-src/test/test.so');
$res = cppMethod();
var_dump($res);
$res = cppMethod(1,2);
var_dump($res);
exit(0);
//echo "cppMethod:".cppMethod(1,2,null,"333")."\n";