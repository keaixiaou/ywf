<?php
/**
 * Created by PhpStorm.
 * author: zhaoye(zhaoye@youzan.com)
 * Date: 2017/5/27
 * Time: 下午4:47
 */

return [
    'session' => [
        'enable' => false,
        'adapter' => 'Redis',
        'name' => 'sess',
        'cache_expire' => 3600,
    ],
];