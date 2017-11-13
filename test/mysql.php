<?php
/**
 * Created by PhpStorm.
 * User: zhaoye
 * Date: 2017/2/16
 * Time: 上午9:52
 */

$db = new \swoole_mysql();
$server = array(
    'host' => '120.27.143.217',
    'port' => 3306,
    'user' => 'jeekzx',
    'password' => '7f331f',
    'database' => 'test',
    'chatset' => 'utf8', //指定字符集
);

$db->connect($server, function ($db, $r) {
    var_dump($db);
    var_dump($r);
});
echo "connect finish!\n";