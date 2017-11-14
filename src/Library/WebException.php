<?php
/**
 * Created by PhpStorm.
 * author: zhaoye(zhaoye@youzan.com)
 * Date: 2017/11/14
 * Time: 上午11:53
 */
namespace Library;

use Ywf\Core\Env;

class WebException extends \Exception
{
    const INTER_ERROR = 100000000;
    const PARAM_ERROR = 100000001;
    const CLASS_NOT_EXSIST = 100000002;
    public static $msgs = [
        self::INTER_ERROR => '未知错误',
        self::PARAM_ERROR => '参数错误',
        self::CLASS_NOT_EXSIST => '类不存在',
    ];


    public function __construct($code, $param = "", $realCode = 0)
    {
        if ($realCode <= 0) {
            $this->code = $code;
        } else {
            $this->code = $realCode;
            $this->message = $param;
            return;
        }

        $this->message = self::getErrorMsg($code);

        $runMode = Env::get('run_mode');
        if ('online' !== $runMode && $param != "") {
            $this->message .= "_" . $param;
        }
    }

    public static function getErrorMsg($errno)
    {
        if (isset(self::$msgs[$errno])) {
            return self::$msgs[$errno];
        } else {
            return self::$msgs[self::INTER_ERROR];
        }
    }
}