#### Table of contents

- [1 Item](#1-Item)
    - [1.1  更新一个点菜 - put](#11-put)
    - [1.2  清除一个点菜 - delete](#12-delete)
    - [1.3  获得一个点菜 - get](#13-get)
    - [1.4  批量获得点菜 - gets](#14-gets)

- [2 BusinessOrder](#2-BusinessOrder)
    - [2.1  新建业务单 - add](#21-add)
    - [2.2  业务单详情 - detail](#22-detail)
    - [2.3  业务单列表 - getList](#23-getList)
    - [2.4  取消业务单 - cancel](#24-cancel)
    - [2.5  买家备注 - memo](#25-memo)
    - [2.6  商家备注 - sellerMemo](#26-sellerMemo)
    - [2.7  发票抬头 - invoice](#27-invoice)
    - [2.8  附加费 - extraCharge](#28-extraCharge)
    - [2.9  支付 - pay](#29-pay)

- [3 Cart](#3-Cart)
    - [3.1  获得购物车 - get](#31-get)
    - [3.2  购物车加菜/减菜 - foodOp](#32-foodOp)
    - [3.3  清除购物车 - foodTruncate](#33-foodTruncate)
    - [3.4  修改购物车 - update](#34-update)

- [4 Shop](#4-Shop)
    - [4.1  开启/关闭堂食点菜 - set](#41-set)
    - [4.2  获取店铺堂食点菜功能是否开启 - get](#42-get)

- [5 Order](#5-Order)
    - [5.1  点餐订单状态 - state](#51-state)


# 1 Item
## 1.1-put
* url:  Diancan/Item/put
* method : post
* desc : 更新一个点菜
* param:

| 字段        |   是否可选 |  默认值           | 说明  |
| ------------- |:-------------:|:-------------:|-----:|
|userId|是|0|

|userNum|是|0|

|tableId|否|/|

* return:

```
{
    "code": 0,
    "msg": "diancan\/item::Put",
    "data": {
        "result": 14
    }
}
```
## 1.2-delete
* url:  Diancan/Item/delete
* method : post
* desc : 清除一个点菜
* param:

| 字段        |   是否可选 |  默认值           | 说明  |
| ------------- |:-------------:|:-------------:|-----:|
|userId|是|0|

|diancanId|否|/|

* return:

```
[]
```
## 1.3-get
* url:  Diancan/Item/get
* method : post
* desc : 获得一个点菜
* param:

| 字段        |   是否可选 |  默认值           | 说明  |
| ------------- |:-------------:|:-------------:|-----:|
|tableId|否|/|

* return:

```
{
    "code": 0,
    "msg": "diancan\/item::Get",
    "data": {
        "status": 0,
        "userNum": 2,
        "kdtId": 333
    }
}
```
## 1.4-gets
* url:  Diancan/Item/gets
* method : post
* desc : 批量获得点菜
* param:

| 字段        |   是否可选 |  默认值           | 说明  |
| ------------- |:-------------:|:-------------:|-----:|
|tableIds|否|/|

* return:

```
{
    "code": 0,
    "msg": "diancan\/item::Gets",
    "data": {
        "3": {
            "id": "15",
            "status": 0,
            "created_at": "2017-06-07 15:35:32",
            "updated_at": "2017-06-07 15:35:32",
            "tableId": "3",
            "kdtId": "322140",
            "createdUid": "12345678",
            "updatedUid": "12345678",
            "userNum": 2
        },
        "4": {
            "id": "16",
            "status": 0,
            "created_at": "2017-06-07 15:36:09",
            "updated_at": "2017-06-07 15:36:09",
            "tableId": "4",
            "kdtId": "322140",
            "createdUid": "12345678",
            "updatedUid": "12345678",
            "userNum": 2
        },
        "5": {
            "id": "17",
            "status": 0,
            "created_at": "2017-06-07 15:36:15",
            "updated_at": "2017-06-07 15:36:15",
            "tableId": "5",
            "kdtId": "322140",
            "createdUid": "12345678",
            "updatedUid": "12345678",
            "userNum": 2
        }
    }
}
```
# 2 BusinessOrder
## 2.1-add
* url:  Diancan/BusinessOrder/add
* method : post
* desc : 新建业务单
* param:

| 字段        |   是否可选 |  默认值           | 说明  |
| ------------- |:-------------:|:-------------:|-----:|
|kdtId|否|/|

|diancanId|否|/|

|tableNo|否|/|

|memo|是|''|

|sellerMemo|是|''|

|invoice|是|''|

|extraCharge|是|0|

* return:

```
[]
```
## 2.2-detail
* url:  Diancan/BusinessOrder/detail
* method : post
* desc : 业务单详情
* param:

| 字段        |   是否可选 |  默认值           | 说明  |
| ------------- |:-------------:|:-------------:|-----:|
|kdtId|否|/|

|businessOrderId|否|/|

* return:

```
[]
```
## 2.3-getList
* url:  Diancan/BusinessOrder/getList
* method : post
* desc : 业务单列表
* param:

| 字段        |   是否可选 |  默认值           | 说明  |
| ------------- |:-------------:|:-------------:|-----:|
|kdtId|否|/|

|orderStatus|否|/|

|page|是|1|

|pageSize|是|20|

* return:

```
[]
```
## 2.4-cancel
* url:  Diancan/BusinessOrder/cancel
* method : post
* desc : 取消业务单
* param:

| 字段        |   是否可选 |  默认值           | 说明  |
| ------------- |:-------------:|:-------------:|-----:|
|kdtId|否|/|

|businessOrderId|否|/|

* return:

```
[]
```
## 2.5-memo
* url:  Diancan/BusinessOrder/memo
* method : post
* desc : 买家备注
* param:

| 字段        |   是否可选 |  默认值           | 说明  |
| ------------- |:-------------:|:-------------:|-----:|
|kdtId|否|/|

|businessOrderId|否|/|

|memo|否|/|

* return:

```
[]
```
## 2.6-sellerMemo
* url:  Diancan/BusinessOrder/sellerMemo
* method : post
* desc : 商家备注
* param:

| 字段        |   是否可选 |  默认值           | 说明  |
| ------------- |:-------------:|:-------------:|-----:|
|kdtId|否|/|

|businessOrderId|否|/|

|sellerMemo|否|/|

* return:

```
[]
```
## 2.7-invoice
* url:  Diancan/BusinessOrder/invoice
* method : post
* desc : 发票抬头
* param:

| 字段        |   是否可选 |  默认值           | 说明  |
| ------------- |:-------------:|:-------------:|-----:|
|kdtId|否|/|

|businessOrderId|否|/|

|invoice|否|/|

* return:

```
[]
```
## 2.8-extraCharge
* url:  Diancan/BusinessOrder/extraCharge
* method : post
* desc : 附加费
* param:

| 字段        |   是否可选 |  默认值           | 说明  |
| ------------- |:-------------:|:-------------:|-----:|
|kdtId|否|/|

|businessOrderId|否|/|

|extraCharge|否|/|

* return:

```
[]
```
## 2.9-pay
* url:  Diancan/BusinessOrder/pay
* method : post
* desc : 支付
* param:

| 字段        |   是否可选 |  默认值           | 说明  |
| ------------- |:-------------:|:-------------:|-----:|
|kdtId|否|/|

|businessOrderId|否|/|

* return:

```
[]
```
# 3 Cart
## 3.1-get
* url:  Diancan/Cart/get
* method : post
* desc : 获得购物车
* param:

| 字段        |   是否可选 |  默认值           | 说明  |
| ------------- |:-------------:|:-------------:|-----:|
|userId|是|0|

|diancanId|否|/|

* return:

```
{
    "code": 0,
    "msg": "diancan\/cart::Get",
    "data": {
        "id": "17",
        "remark": "aaaa",
        "status": "0",
        "diancanId": "20",
        "kdtId": "323080",
        "createdUid": "12345678",
        "updatedUid": "12345678",
        "goodsNum": "0",
        "createdAt": "2017-06-07 17:35:41",
        "updatedAt": "2017-06-08 19:34:23",
        "list": [
            {
                "id": "1",
                "num": "1",
                "userId": "12345678",
                "goodsId": "948257",
                "skuId": "2359",
                "kdtId": "323080",
                "cartId": "17",
                "createdUid": "0",
                "updatedUid": "12345678",
                "createdAt": "2017-06-08 16:20:08",
                "updatedAt": "2017-06-08 19:35:48"
            },
            {
                "id": "2",
                "num": "1",
                "userId": "123456",
                "goodsId": "948257",
                "skuId": "2359",
                "kdtId": "323080",
                "cartId": "17",
                "createdUid": "123456",
                "updatedUid": "12345678",
                "createdAt": "2017-06-08 16:55:36",
                "updatedAt": "2017-06-08 19:35:48"
            }
        ],
        "goodsList": {
            "948257": {
                "goodsId": 948257,
                "title": "商品3",
                "price": 200,
                "content": "我是描述2",
                "picture": [],
                "totalSoldNum": 0,
                "status": 0,
                "soldStatus": 1,
                "stocks": null,
                "totalStock": 201,
                "goodsType": 5,
                "isDisplay": 1,
                "tagList": null,
                "multiSku": null
            }
        },
        "skuList": {
            "2359": {
                "isGoodsSkuId": false,
                "price": 200,
                "stockNum": 20,
                "key": "规格",
                "value": "璇公子肉鸭"
            }
        }
    }
}
```
## 3.2-foodOp
* url:  Diancan/Cart/foodOp
* method : post
* desc : 购物车加菜/减菜
* param:

| 字段        |   是否可选 |  默认值           | 说明  |
| ------------- |:-------------:|:-------------:|-----:|
|userId|是|0|

|type|是|0|

|goodsId|否|/|

|skuId|否|/|

|diancanId|否|/|

|source|是|null|

* return:

```
{
    "code": 0,
    "msg": "diancan\/cart::FoodOp",
    "data": {
        "result": true
    }
}
```
## 3.3-foodTruncate
* url:  Diancan/Cart/foodTruncate
* method : post
* desc : 清除购物车
* param:

| 字段        |   是否可选 |  默认值           | 说明  |
| ------------- |:-------------:|:-------------:|-----:|
|userId|是|0|

|diancanId|否|/|

|source|是|null|

* return:

```
{
    "code": 0,
    "msg": "diancan\/cart::FoodOp",
    "data": {
        "result": true
    }
}
```
## 3.4-update
* url:  Diancan/Cart/update
* method : post
* desc : 修改购物车
* param:

| 字段        |   是否可选 |  默认值           | 说明  |
| ------------- |:-------------:|:-------------:|-----:|
|userId|是|0|

|diancanId|否|/|

|remark|是|null|

|source|是|null|

* return:

```
{
    "code": 0,
    "msg": "diancan\/cart::Update",
    "data": {
        "result": true
    }
}
```
# 4 Shop
## 4.1-set
* url:  Diancan/Shop/set
* method : post
* desc : 开启/关闭堂食点菜
* param:

| 字段        |   是否可选 |  默认值           | 说明  |
| ------------- |:-------------:|:-------------:|-----:|
|kdtId|否|/|

|status|是|0|

* return:

```
{
    "code": 0,
    "msg": "diancan\/shop::Set",
    "data": {
        "result": true
    }
}
```
## 4.2-get
* url:  Diancan/Shop/get
* method : get
* desc : 获取店铺堂食点菜功能是否开启
* param:

| 字段        |   是否可选 |  默认值           | 说明  |
| ------------- |:-------------:|:-------------:|-----:|
|kdtId|否|/|

* return:

```
{
    "code": 0,
    "msg": "diancan\/shop::Get",
    "data": {
        "type": 2,
        "status": 1
    }
}
```
# 5 Order
## 5.1-state
* url:  Diancan/Order/state
* method : get
* desc : 点餐订单状态
* param:

| 字段        |   是否可选 |  默认值           | 说明  |
| ------------- |:-------------:|:-------------:|-----:|
|orderId|否|/|

* return:

```
[]
```
