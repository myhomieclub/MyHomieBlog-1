

<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>My Messages</title>
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, width=device-width">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-touch-fullscreen" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no">
<meta name="format-detection" content="post=no">
<link rel="stylesheet" type="text/css" href="css/common.css">
<link rel="stylesheet" type="text/css" href="css/index.css">
<link rel="stylesheet" type="text/css" href="css/mui.min.css"/>
<link rel="stylesheet" href="css/reset.css">
<script src="js/jquery-1.8.2.min.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/iscroll.js"></script>
<script type="text/javascript" src="js/jquery.flexslider-min.js"></script>
<script src="js/hmt.js" type="text/javascript"></script>
<script type="text/javascript" src="js/index.js"></script>
<script src="js/swiper.min.js" type="text/javascript" ></script>
</head>

<?php
    @session_start();
    
    
    require_once("connect.php");
    
    
    
    
    
    ?>
<body>
<header class="hasManyCity hasManyCitytwo" id="header">
<a href="javascript:history.go(-1)" class="fl fanhui"><i class="iconfont icon-fanhui"></i></a>
<div class="header-tit">
My Messages
</div>
</header>
<br>
<div id="container">
<div id="main">
<div id="index" class="page-center-box">
<div>
<div class="sy_recmd">
<div class="sy_recmd_list_box">
<ul>

<?php
    $id_array=array();
    if ($_SESSION['userid']!=''){
        
        $data=get_data($_SESSION['userid'],0);
        $data=json_decode(json_encode($data),true);
        //echo var_dump($data);
        //echo "<script>alert('json '+$data)</script>";
        
        
        
        
        
        for ($i=0;$i<count($data);$i++)
        {
            $num=0;
            $num = $data[$i]['number'];
            $msg_from = $data[$i]['from_id'];
            $id_array[]=$msg_from;
            
            
            $user_info_query = "select * from user where id='$msg_from'";
            $res_user = mysql_query($user_info_query);
            $result_user = mysql_fetch_array($res_user, MYSQL_ASSOC);
            $headimg = $result_user['headimg'];
            $nickname = $result_user['nickname'];
            
            $url_suffix="?to_id=".$msg_from."&from_id=".$_SESSION['userid']."&from_name=".$_SESSION['nickname']."&to_name=".$nickname."&to_img=".$headimg."&from_img=".$_SESSION['headimg'];
            
            ?>
<li class="sy_recmd_list">
<div class="box">
<div class="pub_img">
<a href="http://www.smartsupremesoft.com:55151/<?php echo $url_suffix  ?>"><img
src="<?php echo $headimg ?>"
width="145" height="145"></a>
</div>
<div class="pub_wz">
<h3 class="overflow_clear"><a href="http://www.smartsupremesoft.com:55151/<?php echo $url_suffix  ?>"><?php echo $nickname ?></a></h3>
<div class="nr_box">
<p class="fl fontcl2"><?php echo $num ?> unreadMessage(s)</p>
<!--<span class="fl black9"> on sale</span>-->
<!--<p class="fr price fontcl2"><span class="black9">seen </span>
</p>-->
</div>
</div>
</div>
</li>
<?php
    
    }

$data=get_data($_SESSION['userid'],1);
$data=json_decode(json_encode($data),true);
//echo var_dump($data);
//echo "<script>alert('json '+$data)</script>";





for ($i=0;$i<count($data);$i++)
{
$num=0;
$num = $data[$i]['number'];
$msg_from = $data[$i]['from_id'];
if(in_array($msg_from,$id_array)){
    continue;
}


$user_info_query = "select * from user where id='$msg_from'";
$res_user = mysql_query($user_info_query);
$result_user = mysql_fetch_array($res_user, MYSQL_ASSOC);
$headimg = $result_user['headimg'];
$nickname = $result_user['nickname'];

$url_suffix="?to_id=".$msg_from."&from_id=".$_SESSION['userid']."&from_name=".$_SESSION['nickname']."&to_name=".$nickname."&to_img=".$headimg."&from_img=".$_SESSION['headimg'];


?>
    <li class="sy_recmd_list">
        <div class="box">
            <div class="pub_img">
                <a href="http://www.smartsupremesoft.com:55151/<?php echo $url_suffix  ?>"><img
                            src="<?php echo $headimg ?>"
                            width="145" height="145"></a>
            </div>
            <div class="pub_wz">
                <h3 class="overflow_clear"><a href="http://www.smartsupremesoft.com:55151/<?php echo $url_suffix  ?>"><?php echo $nickname ?></a></h3>
                <div class="nr_box">
                    <p class="fl fontcl2"><?php echo $num ?> readMessage(s)</p>
                    <!--<span class="fl black9"> on sale</span>-->
                    <!--<p class="fr price fontcl2"><span class="black9">seen </span>
                    </p>-->
                </div>
            </div>
        </div>
    </li>
    <?php

    }









    }
    
    function get_data($to_id,$type){
        
        $ch=curl_init();
        $timeout=10;
        $url="www.smartsupremesoft.com:55151/get_chat_list.php?to_id=$to_id&type=$type";
        
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_ENCODING,'gzip');
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
        $json=mb_convert_encoding(curl_exec($ch),'utf-8');
        
        return json_decode($json);

        
    }
    
    
    
    
    
    
    
    
    
    ?><!--
<li class="sy_recmd_list">
<div class="box">
<div class="pub_img">
<a href="mall-detail.html"><img src="img/thumb_543ba5688cb7b.jpg" width="145" height="145"></a>
</div>
<div class="pub_wz">
<h3 class="overflow_clear"><a href="#">Dasoash department</a></h3>
<div class="nr_box">
<p class="fl fontcl2">¥1800 / 70sqm / month </p>
<!--<span class="fl black9"> on sale</span>-->
<!--<p class="fr price fontcl2"><span class="black9">seen 350</span></p>
</div>
</div>
</div>
</li>-->



</ul>
<div class="clear"></div>
</div>
</div>
<!--专享推荐end-->
</div>
</div>
</div>
</div>
</body>
</html>
