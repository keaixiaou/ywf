<?php


$agent = 'Mozilla/5.0 (Linux; Android 6.0; Android SDK built for x86 Build/MASTER; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/44.0.2403.119 Safari/537.36 youzan_cy_android/1.1.0.0';
$res = preg_match('/(android|bb\d+|meego).+mobile|android-|kdtunion|weibo|m2oapp|micromessenger|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$agent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($agent,0,4));


var_dump($res);die;
//$url = 'http://wx.royldesign.cn/vote?from=timeline&isappinstalled=0';
$url = 'http://blog.csdn.net/limenghua9112/article/details/46618995';
$agent = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36';
$post_data = [];
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_USERAGENT, $agent);
curl_setopt($ch, CURLOPT_ENCODING, "gzip" );
curl_setopt($ch, CURLOPT_HTTPGET, 1);
//设置跟踪页面的跳转，有时候你打开一个链接，在它内部又会跳到另外一个，就是这样理解
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
//获取的cookie 保存到指定的 文件路径，我这里是相对路径，可以是$变量
curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 1);

//curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
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
echo  $output;
exit(0);





class Test
{
    static private $_configMap;
    public static function getConfigCacheKey($configKey)
    {
        self::$_configMap = '{"account":{"login":{"common":{"connection":"redis.default_write"},"account_wap_wxlogin":{"connection":"redis.default_write","key":"account:wap:wxlogin:%s:%s","exp":7000},"test":{"connection":"redis.default_write","key":"test","exp":3600}}},"common":{"smscaptcha":{"common":{"connection":"redis.v2_default"},"response":{"connection":"redis.v2_default","key":"smscaptcha_response_%s_%s","exp":1800},"time":{"connection":"redis.v2_default","key":"smscaptcha_time_%s","exp":1800},"count":{"connection":"redis.v2_default","key":"smscaptcha_count_%s_%s","exp":86400},"flag":{"connection":"redis.v2_default","key":"smscaptcha_flag_%s_%s"},"ip":{"connection":"redis.v2_default","key":"smscaptcha_ip_%s","exp":86400},"total":{"connection":"redis.v2_default","key":"smscaptcha_total_%s","exp":86400},"imagecaptchamobile":{"connection":"redis.v2_default","key":"smscaptcha_image_captcha_mobile_count_%s","exp":3433},"imagecaptchaip":{"connection":"redis.v2_default","key":"smscaptcha_image_captcha_ip_count_%s","exp":3433},"channelfaild":{"connection":"redis.v2_default","key":"smscaptcha_channel_faild_count_%s","exp":600},"bizcount":{"connection":"redis.v2_default","key":"smscaptcha_bizcount_%s_%s","exp":3660}}},"goods":{"goods":{"common":{"connection":"redis.default_write"},"wm_goods_simple_itemids":{"connection":"redis.default_write","key":"wm:goods:simple:itemids:%s","exp":60},"wm_goods_id_detail":{"connection":"redis.default_write","key":"wm:goods:id:detail:%s","exp":60},"wm_goods_id_tagids":{"connection":"redis.default_write","key":"wm:goods:id:tagids:%s","exp":60}}},"session":{"acl":{"common":{"connection":"redis.default_write"},"session":{"connection":"redis.default_write","key":"PHPREDIS_SESSION:%s","exp":240000}}},"shop":{"shop":{"common":{"connection":"redis.default_write"},"shop_kdt_id_shop_id":{"connection":"redis.default_write","key":"shop:kdt_id:%s","exp":86400}}}}';
        self::$_configMap = json_decode(self::$_configMap, true);
        $result = self::$_configMap;
        $routes = explode('.', $configKey);
        if (empty($routes)) {
            return null;
        }
        foreach ($routes as $route) {
            if (!isset($result[$route])) {
                return null;
            }
            $result = &$result[$route];
        }
        return $result;
    }
    /*
         *  merge 分组
         */
    static public function _mergeTagList($tagList, $tagIdsArr)
    {
        if (count($tagList) == 0) {
            return [];
        }

        if (count($tagIdsArr) == 0) {
            return $tagList;
        }

        $tagListArr = [];
        foreach ($tagList as $tag) {
            $tagListArr[intval($tag['groupId'])] = $tag;
        }

        $output = [];

        foreach ($tagIdsArr as $tagId) {
            if (intval($tagId) <= 0) {
                continue;
            }

            if (isset($tagListArr[$tagId])) {
                $output[intval($tagId)] = $tagListArr[$tagId];
            }
        }

        foreach ($tagListArr as $tagId => $tag) {
            if (!isset($output[$tagId])) {
                $output[$tagId] = $tag;
            }
        }
        return array_values($output);
    }
}


$data = Test::getConfigCacheKey('account.login.account_wap_wxlogin');
var_dump($data);
exit();
$a = [['groupId'=>1,'b'=>111], ['groupId'=>2,'b'=>222],['groupId'=>3,'b'=>333]];
$b = [1,2];
print_r(Test::_mergeTagList($a, $b));
$a = [];
print_r(Test::_mergeTagList($a, $b));
$a = [['groupId'=>1,'b'=>111], ['groupId'=>2,'b'=>222],['groupId'=>3,'b'=>333]];
$b = [2,3,4];
print_r(Test::_mergeTagList($a, $b));
exit();

$cli = new swoole_http_client('192.168.66.239', 80);
$cli->setHeaders(['Host'=>'api.koudaitong.com','Content-Type'=>'application/x-www-form-urlencoded']);
$body = 'user_id=5180125&debug_t=1494912826&debug=json';
$cli->post('/account/open/admin/getUserById', $body, function ($cli) {
    echo "Length: " . strlen($cli->body) . "\n";
    echo $cli->body;
    exit(0);
});
exit(0);


global $argv;
var_dump($argv);
exit(0);
function get_curl($url, $post_data=[])
{
	//get、post数据
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//设置跟踪页面的跳转，有时候你打开一个链接，在它内部又会跳到另外一个，就是这样理解
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
//获取的cookie 保存到指定的 文件路径，我这里是相对路径，可以是$变量
curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
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
$i= 0 ;
while($i<10){
$a = get_curl('http://test.jeekzx.com/index/test');
sleep(5);
$i++;
}
