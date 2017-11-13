<?php
/***************************************************************************
  *
  * Copyright (c) 2017 youzan.com, Inc. All Rights Reserved
  *
  ***************************************************************************/



/**
  * file ShopController.php
  * author zhaoye (zhaoye@youzan.com )
  * date 2017-06-19
  *
  **/
namespace Diancan;

class ShopController  extends \CYApi\Diancan\BaseController{
    /*
    * input : $data = [];
    * output : $resut = [];
    * author : 
    * desc : 开启/关闭堂食点菜
    */
    public function set()
    {
        $param = [];
        $param["kdtId"] = $this->request->post("kdtId");// 店铺ID
        $param["status"] = $this->request->post("status");// 0：开启；1：关闭
        yield $this->_doFunction($param);
    }

    /*
    * input : $data = [];
    * output : $resut = [];
    * author : 
    * desc : 获取店铺堂食点菜功能是否开启
    */
    public function get()
    {
        $param = [];
        $param["kdtId"] = $this->request->get("kdtId");// 店铺ID
        yield $this->_doFunction($param);
    }

}