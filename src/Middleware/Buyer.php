<?php
/**
 * Created by PhpStorm.
 * author: zhaoye(zhaoye@youzan.com)
 * Date: 2017/11/14
 * Time: 下午5:39
 */
namespace Middleware;

use Library\MiddleResponse;
use Ywf\Network\Http\Filter;
use Ywf\Network\Http\Request;

class Buyer implements Filter{
    public function doFilter(Request $request)
    {
        $middleRet = true;
        $session = $request->session;
        if(empty($session['userinfo'])){
            $id = $request->get('id');
            $middleRet = new MiddleResponse('http://ywf.test.com/Api?id='.$id);
        }
        return $middleRet;
        // TODO: Implement doFilter() method.
    }
}