<?php
/**
 * Created by PhpStorm.
 * User: zhaoye
 * Date: 16/7/16
 * Time: 下午2:57
 */


function table($tableName){
    return \Ywf\Core\Db::table($tableName);
}

function collection($collectionName){
    return \Ywf\Core\Db::collection($collectionName);
}
