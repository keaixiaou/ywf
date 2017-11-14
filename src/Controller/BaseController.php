<?php
/**
 * Created by PhpStorm.
 * author: zhaoye(zhaoye@youzan.com)
 * Date: 2017/11/14
 * Time: 上午11:07
 */
namespace Controller;

use Library\WebException;
use Ywf\Controller\Controller;

class BaseController extends Controller{
    public function _doFunction($param){
        $controllerName = $this->context->get('controller');
        $module = $this->context->get('module');
        $action = $this->context->get('action');
        try{
            $serviceName = "\\Model\\$module\\Service\\$controllerName\\$action";
            if(class_exists($serviceName)){
                $service = new $serviceName();
                $ret = $service->execute($param);
                $this->jsonReturn($ret);
            }else{
                throw new WebException(WebException::CLASS_NOT_EXSIST, "$serviceName not exsist!");
            }
        }catch(\Exception $e){
            $ret = [
                'code' => $e->getCode(),
                'msg' => $e->getMessage(),
            ];
            $this->jsonReturn($ret);
        }
    }

    public function _doTplFunction($param, $tpl=''){
        $controllerName = $this->context->get('controller');
        $module = $this->context->get('module');
        $action = $this->context->get('action');
        $serviceName = "\\Model\\$module\\Service\\$controllerName\\$action";
        if (class_exists($serviceName)) {
            $service = new $serviceName();
            $ret = $service->execute($param);
            foreach ($ret as $key => $value) {
                $this->assign($key, $value);
            }
            $this->display($tpl);
        } else {
            throw new WebException(WebException::CLASS_NOT_EXSIST, "$serviceName not exsist!");
        }

    }
}