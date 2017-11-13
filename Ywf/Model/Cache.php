<?php
/**
 * Created by PhpStorm.
 * author: zhaoye(zhaoye@youzan.com)
 * Date: 2017/11/11
 * Time: 下午5:24
 */
namespace Ywf\Model;

use Ywf\Core\Config;
use Ywf\Ywf;

class Cache{
    public $connect;
    public function __construct(){
        $param = func_get_args()[0];
        $mode = array_shift($param);
        $driver = array_shift($param);
        $connectConfig = Config::get($driver.'.'.$mode);
        $driver = ucfirst($driver);
        $this->connect = Ywf::make('Ywf\\Db\\'.$driver, $connectConfig);
    }

    public function getConnect(){
        return $this->connect->getConnect();
    }
}