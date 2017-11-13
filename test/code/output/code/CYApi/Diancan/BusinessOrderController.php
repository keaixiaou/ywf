<?php
/***************************************************************************
  *
  * Copyright (c) 2017 youzan.com, Inc. All Rights Reserved
  *
  ***************************************************************************/



/**
  * file BusinessOrderController.php
  * author zhaoye (zhaoye@youzan.com )
  * date 2017-06-19
  *
  **/
namespace Diancan;

class BusinessOrderController  extends \CYApi\Diancan\BaseController{
    /*
    * input : $data = [];
    * output : $resut = [];
    * author : 
    * desc : 新建业务单
    */
    public function add()
    {
        $param = [];
        $param["kdtId"] = $this->request->post("kdtId");// 店铺ID
        $param["diancanId"] = $this->request->post("diancanId");// 点餐id
        $param["tableId"] = $this->request->post("tableId");// 桌位编号
        $param["userId"] = $this->getEnv("userId");// 买家id
        $param["sellerMemo"] = $this->request->post("sellerMemo",'');// 商家备注
        $param["invoice"] = $this->request->post("invoice",'');// 发票抬头
        $param["extraCharge"] = $this->request->post("extraCharge");// 附加费
        yield $this->_doFunction($param);
    }

    /*
    * input : $data = [];
    * output : $resut = [];
    * author : 
    * desc : 业务单详情
    */
    public function detail()
    {
        $param = [];
        $param["kdtId"] = $this->request->post("kdtId");// 店铺ID
        $param["diancanId"] = $this->request->post("diancanId");// 点餐id
        yield $this->_doFunction($param);
    }

    /*
    * input : $data = [];
    * output : $resut = [];
    * author : 
    * desc : 业务单列表
    */
    public function getList()
    {
        $param = [];
        $param["kdtId"] = $this->request->post("kdtId");// 店铺ID
        $param["orderStatus"] = $this->request->post("orderStatus");// 业务单状态
        $param["page"] = $this->request->post("page",1);// 页数
        $param["pageSize"] = $this->request->post("pageSize",20);// 每页条数
        yield $this->_doFunction($param);
    }

    /*
    * input : $data = [];
    * output : $resut = [];
    * author : 
    * desc : 取消业务单
    */
    public function cancel()
    {
        $param = [];
        $param["kdtId"] = $this->request->post("kdtId");// 店铺ID
        $param["businessOrderId"] = $this->request->post("businessOrderId");// 业务单id
        yield $this->_doFunction($param);
    }

    /*
    * input : $data = [];
    * output : $resut = [];
    * author : 
    * desc : 买家备注
    */
    public function memo()
    {
        $param = [];
        $param["kdtId"] = $this->request->post("kdtId");// 店铺ID
        $param["businessOrderId"] = $this->request->post("businessOrderId");// 业务单id
        $param["memo"] = $this->request->post("memo");// 买家备注
        yield $this->_doFunction($param);
    }

    /*
    * input : $data = [];
    * output : $resut = [];
    * author : 
    * desc : 商家备注
    */
    public function sellerMemo()
    {
        $param = [];
        $param["kdtId"] = $this->request->post("kdtId");// 店铺ID
        $param["businessOrderId"] = $this->request->post("businessOrderId");// 业务单id
        $param["sellerMemo"] = $this->request->post("sellerMemo");// 商家备注
        yield $this->_doFunction($param);
    }

    /*
    * input : $data = [];
    * output : $resut = [];
    * author : 
    * desc : 发票抬头
    */
    public function invoice()
    {
        $param = [];
        $param["kdtId"] = $this->request->post("kdtId");// 店铺ID
        $param["businessOrderId"] = $this->request->post("businessOrderId");// 业务单id
        $param["invoice"] = $this->request->post("invoice");// 发票抬头
        yield $this->_doFunction($param);
    }

    /*
    * input : $data = [];
    * output : $resut = [];
    * author : 
    * desc : 附加费
    */
    public function extraCharge()
    {
        $param = [];
        $param["kdtId"] = $this->request->post("kdtId");// 店铺ID
        $param["businessOrderId"] = $this->request->post("businessOrderId");// 业务单id
        $param["extraCharge"] = $this->request->post("extraCharge");// 附加费
        yield $this->_doFunction($param);
    }

    /*
    * input : $data = [];
    * output : $resut = [];
    * author : 
    * desc : 支付
    */
    public function pay()
    {
        $param = [];
        $param["payType"] = $this->request->post("payType");// 支付方式（wapay,alipay）
        $param["youzanUserId"] = $this->request->post("youzan_user_id");// youzanuserid
        $param["buyerId"] = $this->request->post("buyerId");// buyerId
        $param["platform"] = $this->request->post("platform");// 平台
        $param["businessOrderId"] = $this->request->post("businessOrderId");// 业务单编号
        $param["buyer"] = $this->request->post("buyer");// buyer
        $param["kdtId"] = $this->request->post("kdtId");// 店铺ID
        $param["selectCoupon"] = $this->request->post("selectCoupon");// 优惠券编号
        $param["clientIp"] = $this->request->post("clientIp");// 客户端IP
        $param["fansId"] = $this->request->post("fansId");// fans编号
        $param["fansType"] = $this->request->post("fansType");// fans类别
        yield $this->_doFunction($param);
    }

    /*
    * input : $data = [];
    * output : $resut = [];
    * author : 
    * desc : 业务单结账
    */
    public function settleAccounts()
    {
        $param = [];
        $param["kdtId"] = $this->request->post("kdtId");// 店铺ID
        $param["diancanId"] = $this->request->post("diancanId");// 点餐id
        yield $this->_doFunction($param);
    }

    /*
    * input : $data = [];
    * output : $resut = [];
    * author : 
    * desc : 轮询业务单详情
    */
    public function payState()
    {
        $param = [];
        $param["kdtId"] = $this->request->get("kdtId");// 店铺ID
        $param["businessOrderId"] = $this->request->get("businessOrderId");// 业务单编号
        yield $this->_doFunction($param);
    }

}