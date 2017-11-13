<?php
/**
 * Created by PhpStorm.
 * author: zhaoye(zhaoye@youzan.com)
 * Date: 2017/11/11
 * Time: 下午5:51
 */
namespace Ywf\Db;

use Ywf\Ywf;

class File implements Connect{
    private function getCacheKey($key){
        $cachePath = Ywf::getLogPath();
        return $cachePath.DS.md5($key);
    }
    public function get($key, $default=null){
        $value = $default;
        $filename = $this->getCacheKey($key);
        if(is_file($filename)){
            $value = file_get_contents($filename);
            $value = unserialize($value);
        }
        
        return $value;
    }

    public function set($key, $value){
        $fileName = $this->getCacheKey($key);
        $value = serialize($value);
        return file_put_contents($fileName, $value);
    }

    public function getConnect()
    {
        return $this;
        // TODO: Implement getConnect() method.
    }
}