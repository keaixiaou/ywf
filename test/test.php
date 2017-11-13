<?php
/**
 * Created by PhpStorm.
 * User: zhaoye
 * Date: 2016/12/13
 * Time: 上午10:07
 */



$a = ['b'=>1,'a'=>2,'c'=>['b'=>1,'a'=>2]];
ksort($a);
var_dump($a);die;
function tttt(...$arrays){
    var_dump($arrays[0]);
    var_dump($arrays);
}
$c = getopt("", [ "mqfile:" ]);
var_dump($c);die;
tttt();
exit(0);
class Test{
    public static function getSubTarget($target, $path) {
        $sub = $target ['sub'];
        while(true) {
            foreach ( $sub as $item ) {
                if ($item ['mod'] == $path) {
                    return $item;
                }
            }
            $cursor = strrpos ( $path, "." );
            if (!$cursor) {
                break;
            }
            $path = substr ( $path, 0, $cursor );
        }
        return $target;
    }
    public static function underLineTOCamel($fields)
    {
        if ($fields) {
            if (is_array($fields)) {
                foreach ($fields as $key => $v) {
                    if (!stripos($key, '_')) continue;
                    $keyTmp = array_reduce(explode('_',$key), function($v1, $v2) {
                        return ucfirst($v1).ucfirst($v2);
                    });
                    $keyTmp = lcfirst($keyTmp);
                    $fields[$keyTmp] = $v;
                    unset($fields[$key]);
                }
            } else {
                if (stripos($fields, '_')) {
                    $tmp = array_reduce(explode('_',$fields), function($v1, $v2) {
                        return ucfirst($v1).ucfirst($v2);
                    });
                    $fields = lcfirst($tmp);
                }
            }
        }

        return $fields;
    }

}
$payExt = [
  'order_id' => 1,
    'acquire_no' => 2,
    'out_biz_no' => 3,
    'partner_id' => 4,
    'mch_id' => 5,
    'payer_id' => 6,
    'pay_amount' => 7,
    'currency_codel' => 8,
    'discountable_amount' => 9,
    'undiscountable_amount' => 10,
    'order_no' => 11,
];
echo json_encode(Test::underLineTOCamel($payExt), JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
exit();

$target = [
    'type' => 'local',
    'host' => 'http://pay.api.youzan.com/',
    'sub' => [
        [
            'mod' => 'pay.api.yzpay',
            'host' => 'http://10.9.59.58:8038',
            'type' => 'java'
        ],
        [
            'mod' => 'pay.cashier',
            'host' => '10.9.82.150:8100',
            'type' => 'java'
        ],
        [
            'mod' => 'pay.payment.checkstand',
            //'host' => 'http://192.168.66.238:8048',
            'host' => 'http://10.9.18.213:8048',
            'type' => 'java'
        ],
        [
            'mod' => 'pay.payment.recharge',
            'host' => 'http://pay-payment-recharge-qa.s.qima-inc.com:8086',
            'type' => 'java'
        ],
        [
            'mod' => 'pay.ticket',
            'host' => 'http://pay-ticket-qa.s.qima-inc.com:8088',
            'type' => 'java'
        ],
        [
            'mod' => 'pay.settlement',
            'host' => 'http://settlement-qa.s.qima-inc.com:8082',
            'type' => 'java'
        ],
        [
            'mod' => 'pay.yzcoin',
            'host' => 'http://10.9.36.29:28203',
            'type' => 'java'
        ],
        [
            'mod' => 'pay.microaccount',
            'host' => 'http://pay-microaccount-qa.s.qima-inc.com:8087',
            'type' => 'java'
        ],
        [
            'mod' => 'pay.assetcenter',
            'host' => 'http://10.9.199.88:8094',
            'type' => 'java'
        ],
    ]
];
$path = 'pay.assetcenter.pay.multi';

var_dump(Test::getSubTarget($target, $path));
exit();


$a = [3,4,2,1,5,10,4,8];
usort($a, function($a, $b){
    return $a<$b?-1:1;
});
var_dump($a);
exit();

class Z{
    public function gz(){
        return 'gz';
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
        return 'gzToString';
    }
}


$file =  __DIR__."/Model/User/User.php";
$foo = include $file;
$classContent = get_included_files();
var_dump($classContent);
die;
$classContent = file_get_contents($file);
var_dump($foo);
$parse = new DocParser();
$info = $parse->parse($classContent);
var_dump($info);
die;
class Zhushi {

    /**
     * @url student/zhushi
     * @method POST
     * @description  获取参数a
     * @param Int $a  用户编号 optional
     * @param Int $b 用户名称
     * @param String $c 用户性别
     * @return Int $a 用户编号
     * @return Int $b 用户昵称
     *
     */
    public function getm(Int $a){
        return $a;
    }
}

$c = new Zhushi();
$relection = new ReflectionClass("Zhushi");
$document = $relection->getMethods();
$class = new DocParser();
foreach($document as $key => $value){
    $doc = $value->getDocComment();
    //解析注释
    $info = $class->parse($doc);
    var_dump($info);
}



exit(0);
$code = <<<PHP_CODE
<?php
$str = "Hello World!\n";
echo $str;
PHP_CODE;
var_dump(token_get_all($code));

var_dump($_SERVER);
exit(0);


$client = new \swoole_mysql;
$a = $client->test();
var_dump($a);
exit(0);
class A{
    public $name;
    function getName(){
        return $this->name;
    }
}

$a = new A();
var_dump(spl_object_hash($a));
$b = clone $a;
var_dump(spl_object_hash($b));

echo hash("md5", php_uname())."\n";
echo md5(php_uname())."\n";
echo getmypid()."\n";
sleep(5);

echo mt_rand(0,1000000)."\n";
exit();

$id = 1000;
$callback = function()use($id){
    $param = func_get_args();
    var_dump($param);
    var_dump($id);
};
$timeid = \swoole_timer_tick(1000,  $callback);
exit();
class B{

    public function test(){
        echo "test\n";
    }

    function __destruct(){
        echo "B __destruct\n";
    }
}

//class A{
//    public $func;
//    function __destruct(){
//        echo "A__destruct\n";
//    }
//}
$b = new B();
$a = new A();

$a->func = function()use($b){
    echo "closure\n";
};
call_user_func($a->func);

unset($a);
unset($b);
echo "end\n";
exit();

//function abcd(){
//    $a = new A();
//    $a->a = 2;
//    return $a->a;
//}

$b = new B();
echo $b->bb();
//abcd();
echo 'end';
exit();




$controller = new controller();
$controller->generatorMethod = 'test';
$generator = call_user_func([$controller, 'start']);
if ($generator instanceof \Generator) {
    $task = new CoroutineTask();
    $task->setController($controller);
    $task->setRoutine($generator);
    $task->work($task->getRoutine());
}
unset($controller);
echo "end\n";
exit(0);
function get_curl($url, $post_data=[])
{
//get、post数据
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    if (!empty($post_data)) {
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    }
//判断当前url是否为https请求方式
    $url_arr = parse_url($url);
    if ($url_arr['scheme'] == "https") {
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    }
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}
$a = get_curl('http://test.jeekzx.com/index/test');
var_dump($a);
exit(0);


$db = new \swoole_mysql;
$server = array(
//    'host' => '120.27.143.217',
//    'user' => 'jeekzx',
//    'password' => '123456',
//    'database' => 'test',

    'host' => '121.41.12.19',
    'database' => 'tao_culture',
    'user' => 'remoteLink',
    'password' => 1235,

);

$db->connect($server, function ($db, $r) {
    if ($r === false) {
        echo 'connenct fail!'."\n";
    }

    echo "hello\n";
    sleep(2);
    echo "world\n";
});
echo "after\n";

//$a=array("a"=>"red","b"=>"green");
//print_r(array_unshift($a,"blue"));
//var_dump($a);
//exit(0);
//function abcd($key, $value, $field, $value){
//    $data = [$key, $value, $field, $value];
//    $func = function($key){return $key;};
//    $data[] = $func;
//    return $data;
//}
//
//$list = abcd('1,', 'v', 'field', 'value');
//var_dump($list);
//array_unshift($list,'command');
//var_dump($list);
//$element = array_shift($list);
//var_dump($element);
//$list['token'] = 'token';
//var_dump($list);
//$element = array_shift($list);
//var_dump($element);