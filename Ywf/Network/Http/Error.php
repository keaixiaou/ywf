<?php
/**
 * Created by PhpStorm.
 * User: zhaoye
 * Date: 16/7/16
 * Time: 下午2:49
 */

namespace Ywf\Network\Http;

class Error {
    /**
     * @var \Exception $exception;
     */
    private static $exception;

    public static function setException(\Exception $exception){
        if(empty(self::$exception))
            self::$exception = $exception;
    }


    private static function buildException(){
        $traceArray = [];
        if(!empty(self::$exception)){
            $traceString = self::$exception->getTraceAsString();
            $traceArray = explode('#', $traceString);
            array_shift($traceArray);
            $addSymFunc = function($n){
                return '#'.$n;
            };
            $traceArray = array_map($addSymFunc, $traceArray);
        }
        return $traceArray;
    }
    /**
     * 输出一条错误信息，并结束程序的运行
     * @param $msg
     * @param $content
     * @return string
     */
    public static function info($msg, $content='')
    {
        if (DEBUG !==true )
        {
            $content = '';
        }else {
            $exceptionContent = self::buildException();
            if(!empty($content))
                array_unshift($exceptionContent, $content);
            $content = implode('<br/>', $exceptionContent);
        }
        $info =
            <<<HTMLS
            <html>
            <head>
            <title>application error</title>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <style type="text/css">
            *{
                font-family:		Consolas, Courier New, Courier, monospace;
                font-size:			14px;
            }
            body {
                background-color:	#fff;
                margin:				40px;
                color:				#000;
            }

            #content  {
            border:				#999 1px solid;
            background-color:	#fff;
            padding:			20px 20px 12px 20px;
            line-height:160%;
            }

            h1 {
            font-weight:		normal;
            font-size:			14px;
            color:				#990000;
            margin: 			0 0 4px 0;
            }
            </style>
            </head>
            <body>
                <div id="content">
                    <h1>$msg</h1>
                    <p>$content</p><pre>
HTMLS;
        if (DEBUG===true) {
            $trace = debug_backtrace();
            $info .= str_repeat('-', 100) . "<br/>";
            foreach ($trace as $k => $t) {
                if (empty($t['line'])) {
                    $t['line'] = 0;
                }
                if (empty($t['class'])) {
                    $t['class'] = '';
                }
                if (empty($t['type'])) {
                    $t['type'] = '';
                }
                if (empty($t['file'])) {
                    $t['file'] = 'unknow';
                }
                $info .= "#$k line:{$t['line']} call:{$t['class']}{$t['type']}{$t['function']} \t file:{$t['file']}<br/>";
            }
            $info .= str_repeat('-', 100) . "<br/>";
        }
        $info .= '</pre></div></body></html>';

        return $info;
    }
}