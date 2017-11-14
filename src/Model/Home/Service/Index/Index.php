<?php
/**
 * Created by PhpStorm.
 * author: zhaoye(zhaoye@youzan.com)
 * Date: 2017/11/14
 * Time: 上午11:48
 */
namespace Model\Home\Service\Index;

use Model\BaseService;

class Index extends BaseService {
    public function execute($data)
    {
        $this->paramName = ['id'];
        $this->checkParam($data);
        $userinfo = table('admin_user')->where(['id'=>$data['id']])->find();
        return $userinfo;
    }
}