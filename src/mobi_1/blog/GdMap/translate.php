<?php

/*$q = $_GET['q'];*/
$q = "杭州";
$url = "http://api.fanyi.baidu.com/api/trans/vip/translate";
$from = "zh";
$to = "en";
$appid = "20171225000108828";
$salt = 1435660288;
$str1 = $appid + $q + $salt + "3crXGT5iSUJJEh1xPp9u";
$str1 = utf8_encode($str1);
$sign = hash('md5', $str1);
print_r($sign);
exit();
$url = "$url?q=$q&from=$from&to=$to&appid=$appid&salt=$salt&sign=$sign";
http_get($url);

function http_get($url)
{
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HEADER, 0);

	$result = curl_exec($ch);
	curl_close($ch);

	print_r($result);
}

?>