<?php
/**
 * Created by PhpStorm.
 * User: zhaoye
 * Date: 2016/12/29
 * Time: 下午3:05
 */

$manager = new MongoDB\Driver\Manager("mongodb://localhost:5000");
$manager1 = new MongoDB\Driver\Manager("mongodb://localhost:5000");

//count
$arr = ['count'=>'hello', 'query'=>['like'=>['$lte'=>5],'url'=>['$exists'=>1]]];
$cursor = $manager->executeCommand('test', new \MongoDB\Driver\Command($arr));
var_dump($cursor->toArray()[0]);


sleep(10);


$arr = ['count'=>'hello', 'query'=>['like'=>['$lte'=>5],'url'=>['$exists'=>1]]];
$cursor = $manager1->executeCommand('test', new \MongoDB\Driver\Command($arr));
var_dump($cursor->toArray()[0]);
sleep(10);
exit();


//group
//$arr = [
//    'group'=>[
//        'ns'=>'hello',
//    'key'=>['num'=>1],
//    'initial'=>['all'=>0,'no'=>0,'finish'=>0],
//    '$reduce'=> new \MongoDB\BSON\Javascript("function(obj, prev){prev.all=prev.all+obj.num}"),
//    'query'=>['like'=>['$lte'=>5]],
//        ]
//];
//try {
//    $cursor = $manager->executeCommand('test', new \MongoDB\Driver\Command($arr));
//    $data = [];
//    $objArray = $cursor->toArray()[0]->retval;
//    foreach($objArray as $obj){
//        $data[] = (array)$obj;
//    }
//    var_dump($data);
//    exit();
//    foreach ($cursor as $document) {
//        var_dump((array)$document);
//    }
//}catch(\MongoDB\Driver\Exception\RuntimeException $e){
//    echo $e->getMessage();
//}

exit();
/**
 * insert
 */
//$bulk = new MongoDB\Driver\BulkWrite;
//$i = 0;
//while($i<50){
//    $bulk->insert([
//        'title' => 'MongoDB'.$i,
//        'description' => 'database'.$i,'like'=>$i+1,
//    'url'=>'http://www.runoob.com/mongodb/'.$i,'by'=>'菜鸟教程'.$i]);
//    $i ++;
//}
//
//$res = $manager->executeBulkWrite('test.hello', $bulk);
//var_dump($res);

/**
 * aggregate
 */
$command = new MongoDB\Driver\Command([
    'aggregate' => 'hello',
    'pipeline' => [
        ['$match' =>
            ['like' => ['$lte' => 10]]],
        ['$group' => ['_id' => '$like', 'sum' => ['$sum' => '$like'],'num'=>['$sum'=>1]]],
        ['$sort' => ['num' => -1,'sum'=>1]],

//        ['$group' => ['_id' => '$likes', 'sum' => ['$sum' => '$likes']]],
    ],
    'cursor' => new stdClass,
]);
$cursor = $manager->executeCommand('test', $command);
/* The aggregate command can optionally return its results in a cursor instead
 * of a single result document. In this case, we can iterate on the cursor
 * directly to access those results. */
$data = [];
foreach ($cursor as $document) {
    $data[] = (array)$document;
}

echo json_encode($data);
/**
 * group
 */

$command = new MongoDB\Driver\Command([
    'aggregate' => 'hello',
    'pipeline' => [
        'key' =>['like'=>1],
        'init' => ['all'=>0,'no'=>0,'finish'=>0],
        'option' => [
            'table' => 'hello', // 表名
            'condition'=>['like'=>['$lte' => 10]]],
        'reduce' => "function(obj, prev){if(obj.like < 10)prev.no++;else prev.finish++;prev.all++}",
    ],
    'cursor' => new stdClass,
]);
$cursor = $manager->executeCommand('test', $command);
var_dump($cursor);
$data = [];
foreach ($cursor as $document) {
    var_dump($document);
    $data[] = (array)$document;
}
echo json_encode($data);
exit();

