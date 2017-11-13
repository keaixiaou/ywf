<?php
/**
 * author: shenzhe
 * Date: 13-6-17
 * 初始化框架相关信息
 */
namespace Ywf;
use Ywf\Controller\Controller;
use Ywf\Core\App;
use Ywf\Core\Config;
use Ywf\Core\Dispatcher;
use Ywf\Core\Env;
use Ywf\Core\YwfException;
use Ywf\Network\Http\Error;
use Ywf\Network\Http\Request;
use Ywf\Network\Http\Response;
use Ywf\Core\Container;
use Ywf\Core\Factory;
use Ywf\Core\Route;
use Ywf\Template\Template;
use Ywf\Template\ViewCache;
use Ywf\View,
    Ywf\Core\Log,
    Ywf\Core\DI;

class Ywf
{
    /**
     * 项目目录
     * @var string
     */
    private static $rootPath;
    private static $tmpPath;
    private static $logPath;
    private static $cachePath;
    /**
     * 配置目录
     * @var string
     */
    private static $configPath = 'config';


    private static $appPath = 'src';
    private static $framePath = '';

    private static $libPath='lib';
    private static $classPath = [];
    private static $appName;

    private static $initItems = [
        Env::class,
        Config::class,
        Route::class,
        Container::class,
    ];


    /**
     * 自动加载类
     * @param $class
     */
    final public static function autoLoader($class)
    {
        if(isset(self::$classPath[$class])) {
            require self::$classPath[$class];
            return;
        }
        $baseFile = \str_replace('\\', DS, $class) . '.php';
        $classPath = array(
            self::$appPath,
            self::$framePath,
        );
        foreach ($classPath as $path) {
            $classFile = ROOTPATH . DS.$path . DS . $baseFile;
            if (\is_file($classFile)) {
                self::$classPath[$class] = $classFile;
                include "{$classFile}";
                return;
            }
        }
    }

    final public static function onErrorHandle($errno, $errstr, $errfile, $errline){
        $error = array(
            'message' => $errstr,
            'file' => $errfile,
            'line' => $errline,
        );
        var_dump($error);die;
    }

    final public static function onExceptionHandler(\Exception $exception)
    {
        Error::setException($exception);
        exit(Error::info($exception->getMessage()));
    }

    final public static function onErrorShutDown(){
        if($error = error_get_last()) {
            exit("ErrorShutDown {$error['message']} ({$error['file']}:{$error['line']})");
        }

    }

    public static function init(){
        define("YWF_VERSION", 1.0);
        defined('DS') || define('DS', DIRECTORY_SEPARATOR);
        \spl_autoload_register(__CLASS__.'::autoLoader');
        register_shutdown_function(__CLASS__. '::onErrorShutDown');
        set_error_handler(__CLASS__. '::onErrorHandle', E_USER_ERROR);
        set_exception_handler(__CLASS__ . '::onExceptionHandler');
        foreach(self::$initItems as $item){
            call_user_func([$item, 'init']);
        }
        self::initPath();
    }

    /**
     * @param $rootPath
     * @param bool $run
     * @param null $configPath
     * @return \ZPHP\Server\IServer
     * @throws \Exception
     */
    public static function run($rootPath)
    {
        self::setRootPath($rootPath);
        self::init();
        self::start();
    }

    public static function make($classPath, $param=[]){
        $classArray = explode('\\', $classPath);
        $module = array_shift($classArray);
        $className = implode('/', $classArray);
        if($module == 'Ywf'){
            return Container::Ywf($className, $param);
        }else{
            return App::$module($className);
        }
    }

    protected static function start(){
        try {
            $dispatcher = self::make(Dispatcher::class);
            $request = self::make(Request::class);
            /**
             * @var Response $response;
             */
            $response = self::make(Response::class);
            $httpCallback = $dispatcher->run($request);
            if($httpCallback instanceof \Closure){
                $content = call_user_func($httpCallback);
                if(!is_null($content)){
                    $response->setReponseContent($content);
                    $response->finish();
                }
            }else{
                $controllerClass = 'controller\\'.$httpCallback['module'].'\\'.$httpCallback['controller'];
                /**
                 * @var Controller $controller;
                 */
                $controller = self::make($controllerClass);
                $controller->setMvc($httpCallback);
                $controller->ywfStart();
            }

        }catch(\Exception $e){
            Error::setException($e);
            $httpResult = Error::info($e->getMessage());

            $response->setReponseContent($httpResult);
            $response->finish();
        }
    }

    public static function getRootPath()
    {
        return self::$rootPath;
    }


    public static function getTmpPath(){
        return self::$tmpPath;
    }

    public static function getLogPath(){
        return self::getRootPath().DS.self::$logPath;
    }

    public static function getCachePath(){
        return self::getRootPath().DS.self::$cachePath;
    }

    public static function getAppPath(){
        return self::$appPath;
    }

    public static function initPath(){
        self::$appPath = Config::get('project.app_path');
        self::$tmpPath = Config::get('project.tmp_path');
        self::$logPath = self::$tmpPath.DS."log";
        self::$cachePath = self::$tmpPath.DS."cache";
    }

    public static function setRootPath($rootPath)
    {
        self::$rootPath = $rootPath;
    }

    public static function getConfigPath(){
        return self::$rootPath.DS.self::$configPath;
    }






}
