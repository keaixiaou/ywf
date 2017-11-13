<?php
/**
 * Created by PhpStorm.
 * User: zhaoye
 * Date: 16/9/22
 * Time: 下午3:03
 */


return [
    'redis' => [
        'default' => [
            'name' => 'cr',
            'pconnect' => false,
            'auth' => '',
            'host' => '127.0.0.1',
            'port' => 6602,
            'timeout' => 5,
            'prefix' => 'ztcp'
        ],
        'session' =>[
            'pconnect' => false,
            'auth' => '',
            'host' => '127.0.0.1',
            'port' => 6602,
            'select' => 1,
            'timeout' => 5,
        ]
    ],
];
