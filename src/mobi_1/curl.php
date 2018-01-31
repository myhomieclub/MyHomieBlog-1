<?php
/**
 * Created by PhpStorm.
 * User: sss
 * Date: 2017/8/6
 * Time: 下午5:50
 */





//get cookies and save

$login_url = 'http://www.chinesetest.cn/index.do';   //登录页面地址
    //$cookie_file = dirname(__FILE__)."pic.cookie";    //cookie文件存放位置（自定义）
    $cookie_file="pic.cookie";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $login_url);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file);
curl_exec($ch);
curl_close($ch);

// create a new cURL resource
$ch = curl_init();

$useremail=$_GET['useremail'];

$password=$_GET['password'];

//echo("useremail: ".$useremail);

//$useremail="iagyamfi@st.ug.edu.gh";
//$password="chineseexams";
$post = "useremail=$useremail&password=$password";

//$post_data=array("useremail"=>$useremail,"password"=>$password);

// set URL and other appropriate options
curl_setopt($ch, CURLOPT_URL, "http://www.chinesetest.cn/userlogin.do");
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);

curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file);

// grab URL and pass it to the browser
curl_exec($ch);

// close cURL resource, and free up system resources
curl_close($ch);

$data_url="http://www.chinesetest.cn/searchchengji.do?styleId=cjxx";
$new_ch=curl_init();
curl_setopt($new_ch,CURLOPT_URL,$data_url);
curl_setopt($new_ch, CURLOPT_HEADER, false);
curl_setopt($new_ch, CURLOPT_HEADER, 0);
curl_setopt($new_ch,CURLOPT_RETURNTRANSFER,1);
curl_setopt($new_ch, CURLOPT_COOKIEFILE, $cookie_file);
$output=curl_exec($new_ch);
//$regex="/<table[^>]*>(.*)<\/table>/is";
$regex="/<div id=\"info_all_mid[^>]*>(.*)anniu/is";

preg_match_all($regex,$output,$matches,PREG_SET_ORDER);
/*
 *  <div id="info_all_siteinfo">        start
 *  <div id="anniu">                    END
 *
 */
?>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>HSK Score</title>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <meta name="format-detection" content="address=no">
    <link rel="stylesheet" type="text/css" href="css/common.css">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/mui.min.css"/>
    <link rel="stylesheet" type="text/css" href="css/mui.picker.min.css"/>
    <script src="js/jquery-1.8.2.min.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/iscroll.js"></script>
    <script type="text/javascript" src="js/jquery.flexslider-min.js"></script>
    <script src="js/hmt.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/index.js"></script>
    <script src="js/swiper.min.js" type="text/javascript" ></script>
    <script src="js/mui.min.js"></script>
    <script src="js/mui.picker.min.js"></script>
</head>
<body>
<!--header star-->
<header class="hasManyCity hasManyCitytwo" id="header">
    <a href="javascript:history.go(-1)" class="fl fanhui"><i class="iconfont icon-fanhui"></i></a>
    <div class="header-tit">
        HSK Score
    </div>
</header>

<?php

echo "<br><br><br><br><h4>Data Collected From www.chinesetest.cn<h4> <h2>HSK Score Information:</h2>
" . $matches[0][0] . "\n";


echo ("</body></html>");

?>
