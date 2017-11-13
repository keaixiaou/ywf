<?php
/**
 * Created by PhpStorm.
 * author: zhaoye(zhaoye@youzan.com)
 * Date: 2017/11/12
 * Time: 下午9:09
 */
namespace Ywf\Session;

interface Handle{
    public function set($data);
    public function get();
}