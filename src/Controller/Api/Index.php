<?php
/**
 * Created by PhpStorm.
 * author: zhaoye(zhaoye@youzan.com)
 * Date: 2017/11/14
 * Time: 上午10:58
 */
namespace Controller\Api;


use Controller\BaseController;

class Index extends BaseController {
    public function index(){
        $param = [];
        $param['id'] = $this->request->get('id');

        $this->_doFunction($param);
    }
}