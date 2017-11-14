<?php
/**
 * Created by PhpStorm.
 * author: zhaoye(zhaoye@youzan.com)
 * Date: 2017/11/14
 * Time: 下午5:40
 */
namespace Ywf\Network\Http;


interface Filter{
    public function doFilter(Request $request);
}
