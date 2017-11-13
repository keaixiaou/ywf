<?php
/**
 * Created by PhpStorm.
 * User: zhaoye
 * Date: 2017/2/17
 * Time: 上午9:27
 */

namespace Main;



use Model\User\User;

class Main{
    function main()
    {
        $user = new User();
        echo $user->getNickname()."\n";
    }

    static function autoload($class){
        echo $class;
    }
}



