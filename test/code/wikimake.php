<?php
/**
 * Created by PhpStorm.
 * author: zhaoye(zhaoye@youzan.com)
 * Date: 2017/6/11
 * Time: 下午4:38
 */

class Arr{
    public static function get($data, $keys, $default=null){
        $keyArray = explode('.' , $keys);
        foreach ($keyArray as $key){
            if(!isset($data[$key])){
                return $default;
            }else{
                $data = $data[$key];
            }
        }
        return $data;
    }
}


class Wiki{
    protected $type='wiki';
    protected $idlFile = '';
    protected $outDir='output';
    protected $user = '';


    public function setData($data){
        $this->idlFile = Arr::get($data, 'idl', '');
        $outDir = Arr::get($data, 'output');
        $this->outDir = $outDir?$outDir:$this->outDir;
        $this->outDir = $this->outDir.DIRECTORY_SEPARATOR.$this->type;
        $this->user = Arr::get($data, 'user', '');
    }

    private function readFileAsIni($file){
        $content = file_get_contents($file);
        $contentArray = explode("\n", $content);
        $config = [];
        $singleConfig = [];
        $singleKey = '';
        foreach($contentArray  as $item){
            $item = trim($item);
            if(empty($item) || $item[0]==='#')
                continue;

            if($item[0]=='[' && substr($item, -1)==']'){
                if(!empty($singleConfig))
                    $config[$singleKey] = $singleConfig;
                $singleKey = substr($item, 1, -1);
                $singleConfig = [];
                continue;
            }
            $equalLNo = strpos($item, '=' );
            if(!empty($equalLNo)){
                $lineKey = trim(substr($item, 0, $equalLNo));
                $lineVal = trim(substr($item, $equalLNo+1));
                $singleConfig[$lineKey] = $lineVal;
            }
        }
        if(!empty($singleConfig))
            $config[$singleKey] = $singleConfig;
        return $config;

    }

    function getOutPutContent($tpl, $param){
        ob_start();
        $temFile = 'template/'.$tpl.'.tpl';
        extract($param, EXTR_OVERWRITE);
        include "$temFile";
        $outPut = ob_get_clean();
        return $outPut;
    }


    function getFuncData($type, $param, $funcType='do'){

        $funcName = 'get'.ucfirst($funcType).'Func';
        return call_user_func([$this, $funcName], $type, $param);
    }
    function getDoFunc($type, $param){

        $funcContext = str_repeat(SPACE, 2).'$param = [];'."\n";
        foreach ($param as $key => $value){
            if(empty($value[4])) {
                $funcContext .= str_repeat(SPACE, 2).'$param["' . $value[0] . '"] = $this->request->' . $type . '("' . $value[1];
            }else{
                $funcContext .= str_repeat(SPACE, 2).'$param["' . $value[0] . '"] = $this->get'.ucfirst($value[4]).'("' . $value[1];
            }
            if(empty($value[2]) ||  $value[2]=='Noo'){
                $funcContext .= '");// '.$value[3];
            }else{
                $funcContext .= '",'.$value[2].');// '.$value[3];
            }
            $funcContext .= "\n";

        }
        $funcContext .= str_repeat(SPACE, 2)."yield".' $this->_doFunction($param);'."\n";
        return $funcContext;
    }


    protected function getMethodData($funcName, $funcConfig){
        $desc = Arr::get($funcConfig, 'desc', '');
        $author = Arr::get($funcConfig, 'author', '');
        $type= Arr::get($funcConfig, 'type', 'get');
        $funcType = Arr::get($funcConfig, 'funcType', 'public');
        $paramArray = [];
        $i = 0;
        while($i < $funcConfig['paramNum']){
            $tmp = explode('|', $funcConfig['param'.$i]);
            $paramArray[] = $tmp;
            $i ++;
        }


        $funcData = $this->getDoFunc($type, $paramArray);
        $outPutParam = [
            'author' => $author,
            'desc' => $desc,
            'funcType' => $funcType,
            'funcName' => $funcName,
            'funcData' => $funcData,
        ];
        $funcData = $this->getOutPutContent('function', $outPutParam);

        return $funcData;
    }


    protected function getMethodWiki($funcName, $funcConfig){
        $paramArray = [];
        $i = 0;
        while($i < $funcConfig['paramNum']){
            $tmp = explode('|', $funcConfig['param'.$i]);
            $p0 = $tmp[1];
            $p1 = $tmp[2]=='Noo'?'否':'是';
            $p2 = $tmp[2]=='Noo'?'/':$tmp[2];
            $p3 = $tmp[3];
            $paramArray[] = [$p0, $p1, $p2, $p3];
            $i ++;
        }
        $return = empty($funcConfig['return'])?[]:json_decode($funcConfig['return'], true);
        $return = json_encode($return,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
        $method = [
            'name' => $funcName,
            'desc' => $funcConfig['desc'],
            'type' => $funcConfig['type'],
            'return' => $return,
            'param' => $paramArray,
        ];
        return $method;

    }


    public function make(){
        $config = $this->readFileAsIni($this->idlFile);
        $controllerArray = explode('|', $config['controller']['controllers']);
        $project = Arr::get($config, 'common.project');
        $module = Arr::get($config, 'common.module');
        $wikiController = [];
        foreach ($controllerArray as $controller){
            $controllerName = $controller."Controller";
            if(empty($config[$controllerName]))
                continue;
            $controllerConfig = $config[$controllerName];
            $methodArray = explode('|', $controllerConfig['functions']);
            $controllerExtend = Arr::get($controllerConfig, 'extends','BaseController');
            $methodList = '';

            $wikiMethod = [];
            $wikiMethodContent = [];
            foreach ($methodArray as $method){
                $methodKey = $controllerName.'.'.$method;
                $methodConfig = $config[$methodKey];
//                $methodList .= $this->getMethodData($method, $methodConfig);
                $wikiMethod[] = [
                    'desc' => $methodConfig['desc'],
                    'name' => $method,
                ];
                $wikiMethodContent[] = $this->getMethodWiki($method, $methodConfig);

            }
            $wikiController[] = [
                'name' => $controller,
                'method' => $wikiMethod,
                'content' => $wikiMethodContent,
            ];
        }
        $data = [
            'controller' => $wikiController,
            'module' => $module,
        ];
        $outPut = $this->getOutPutContent('wiki', $data);
        $outputFile = $this->outDir.DIRECTORY_SEPARATOR.$project.DIRECTORY_SEPARATOR.$module.DIRECTORY_SEPARATOR.$controllerName.".mk";

        $opPath = dirname($outputFile);
        if(!is_dir($opPath)){
            mkdir($opPath, 0755, true);
        }
        file_put_contents($outputFile, $outPut);
    }
}


define("SPACE", '    ');
global $argv;
$anlysisData = [];
$anlysisData['user'] = $argv[1];
$anlysisData['idl'] = $argv[2];

$code = new Wiki();
$code ->setData($anlysisData);
$code->make();


