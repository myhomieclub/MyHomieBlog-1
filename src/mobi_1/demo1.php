<?php
/**
 * Created by PhpStorm.
 * User: sss
 * Date: 2017/8/6
 * Time: 下午3:53
 */
$appid="wxbdc7bc1e209bdac4";
//$appid = "wx24bf35040e89f35b";
//$redirect_uri="http://www.smartsupremesoft.com/coding/mobi_1/demo2.php";
$redirect_uri="http://myhomie.chinaxueyun.com/mobi_1/demo2.php";
$url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$appid.'&redirect_uri='.$redirect_uri.'&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';
header("Location:".$url);

?>