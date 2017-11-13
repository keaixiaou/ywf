<?php
/***************************************************************************
  *
  * Copyright (c) 2017 youzan.com, Inc. All Rights Reserved
  *
  ***************************************************************************/



/**
  * file ItemController.php
  * author zhaoye (zhaoye@youzan.com )
  * date 2017-06-19
  *
  **/
namespace Diancan;

class ItemController  extends \CYApi\Diancan\BaseController{
    /*
    * input : $data = [];
    * output : $resut = [];
    * author : 
    * desc : 更新一个桌子的点菜流程
    */
    public function put()
    {
        $param = [];
        $param["userId"] = $this->request->post("userId");// 用户id
        $param["userNum"] = $this->request->post("userNum");// 参与人数
        $param["tableId"] = $this->request->post("tableId");// 桌子ID
        yield $this->_doFunction($param);
    }

    /*
    * input : $data = [];
    * output : $resut = [];
    * author : 
    * desc : 清除桌子上的点菜流程
    */
    public function delete()
    {
        $param = [];
        $param["userId"] = $this->request->post("userId");// 用户id
        $param["tableId"] = $this->request->post("tableId");// 点餐ID
        yield $this->_doFunction($param);
    }

    /*
    * input : $data = [];
    * output : $resut = [];
    * author : 
    * desc : 获得桌子目前的点菜流程
    */
    public function get()
    {
        $param = [];
        $param["tableId"] = $this->request->post("tableId");// 桌子ID
        yield $this->_doFunction($param);
    }

    /*
    * input : $data = [];
    * output : $resut = [];
    * author : 
    * desc : 批量获得桌子目前的点菜流程
    */
    public function gets()
    {
        $param = [];
        $param["tableIds"] = $this->request->post("tableIds");// 桌子IDs
        yield $this->_doFunction($param);
    }

}