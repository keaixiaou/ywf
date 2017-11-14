<?php
/**
 * Created by PhpStorm.
 * author: zhaoye(zhaoye@youzan.com)
 * Date: 2017/11/14
 * Time: 上午11:33
 */
namespace Model;

use Ywf\Core\YwfException;

class BaseService {

    protected $paramName=[];
    public function execute($data)
    {
        $class = get_class($this);
        $className = '\\' . str_replace("Service", "Bo", $class);
        $classArr = explode("\\", $className);

        $functionName = lcfirst(array_pop($classArr));
        $className = implode("\\", $classArr);

        $bo = new $className;
        return $bo->$functionName($data);
    }

    protected function checkParam($data){
        if(!empty($this->paramName)){
            foreach ($this->paramName as $key => $value){
                if(empty($data[$value])){
                    throw new YwfException("参数:$key-不存在");
                }
            }
        }
        return true;
    }
}