<?php
/***************************************************************************
  *
  * Copyright (c) 2017 youzan.com, Inc. All Rights Reserved
  *
  ***************************************************************************/



/**
  * file CartController.php
  * author zhaoye (zhaoye@youzan.com )
  * date 2017-06-19
  *
  **/
namespace Diancan;

class CartController  extends \CYApi\Diancan\BaseController{
    /*
    * input : $data = [];
    * output : $resut = [];
    * author : 
    * desc : 获得购物车
    */
    public function get()
    {
        $param = [];
        $param["userId"] = $this->request->post("userId");// 用户id
        $param["diancanId"] = $this->request->post("diancanId");// 点餐Id
        yield $this->_doFunction($param);
    }

    /*
    * input : $data = [];
    * output : $resut = [];
    * author : 
    * desc : 购物车加菜/减菜
    */
    public function foodOp()
    {
        $param = [];
        $param["userId"] = $this->request->post("userId");// 用户id
        $param["type"] = $this->request->post("type");// 类型，1加菜,2减菜
        $param["goodsId"] = $this->request->post("goodsId");// 商品Id
        $param["skuId"] = $this->request->post("skuId");// skuId
        $param["diancanId"] = $this->request->post("diancanId");// 点餐Id
        $param["opUserId"] = $this->request->post("opUserId");// 点餐Id
        $param["num"] = $this->request->post("num",1);// 数量
        $param["source"] = $this->request->post("source",null);// 来源
        yield $this->_doFunction($param);
    }

    /*
    * input : $data = [];
    * output : $resut = [];
    * author : 
    * desc : 清除购物车
    */
    public function foodTruncate()
    {
        $param = [];
        $param["userId"] = $this->request->post("userId");// 用户id
        $param["diancanId"] = $this->request->post("diancanId");// 点餐Id
        $param["source"] = $this->request->post("source",null);// 来源
        yield $this->_doFunction($param);
    }

    /*
    * input : $data = [];
    * output : $resut = [];
    * author : 
    * desc : 修改购物车
    */
    public function update()
    {
        $param = [];
        $param["userId"] = $this->request->post("userId");// 用户id
        $param["diancanId"] = $this->request->post("diancanId");// 描述
        $param["remark"] = $this->request->post("remark",null);// 描述
        $param["source"] = $this->request->post("source",null);// 来源
        yield $this->_doFunction($param);
    }

}