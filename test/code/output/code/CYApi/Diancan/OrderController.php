<?php
/***************************************************************************
  *
  * Copyright (c) 2017 youzan.com, Inc. All Rights Reserved
  *
  ***************************************************************************/



/**
  * file OrderController.php
  * author zhaoye (zhaoye@youzan.com )
  * date 2017-06-19
  *
  **/
namespace Diancan;

class OrderController  extends \CYApi\Diancan\BaseController{
    /*
    * input : $data = [];
    * output : $resut = [];
    * author : 
    * desc : 点餐订单状态
    */
    public function state()
    {
        $param = [];
        $param["orderId"] = $this->request->post("orderId");// 订单编号
        yield $this->_doFunction($param);
    }

}