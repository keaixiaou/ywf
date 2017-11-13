<?php

return [
    'project'=>[

        'project_name' => 'Ywf',
        'app_path' => 'src',
        'tmp_path' => 'tmp',
        'common_file'  => ROOTPATH.'/src/library/function.php',
        'swoole_module' => [
//        'test'=>ROOTPATH.'/extension/test.so'
        ],


        'view'=> [
            'tag'=>true,
        ],

        'mvc'  => [
            'module'=>'Home',
            'controller' => 'Index',
            'action' => 'index'
        ],
        'timeout' => 15000,
        'reload' => DEBUG,
    ]
];
