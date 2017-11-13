<?php
/**
 * author: shenzhe
 * Date: 13-6-17
 * 公用方法类
 */

namespace Ywf\Core;


class Filter
{

    public static function isAjax()
    {
        if (!empty($_REQUEST['ajax'])
            ||!empty($_REQUEST['jsoncallback'])
            || (isset($_SERVER['HTTP_X_REQUESTED_WITH'])
                && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
        ) {
            return true;
        }
        return false;
    }


    /**
     * 过滤变量
     * @param $variable
     * @return string
     */
    static public function run($variable){
        if(is_array($variable)){
            foreach($variable as $key => $value){
                $variable[$key] = self::run($value);
            }
        }else{
            $variable = htmlspecialchars(strip_tags($variable));
        }
        return $variable;
    }
}
