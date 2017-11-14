<?php
/**
 * Created by PhpStorm.
 * User: zhaoye
 * Date: 16/7/15
 * Time: 下午3:58
 */

namespace Controller\Home;

use Controller\BaseController;

class Index extends BaseController
{

    public function index()
    {
        $param = [];
        $param['id'] = $this->request->get('id');

        $this->setTemplate('home');
        $this->_doTplFunction($param);
    }

    public function test(){
        return 'test';
    }
}