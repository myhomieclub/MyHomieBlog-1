<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Send Post</title>
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, width=device-width">
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
<script type="text/javascript" src="../js/jweixin-1.2.0.js"></script>
<script src="js/swiper.min.js" type="text/javascript" ></script>
<script src="js/mui.min.js"></script>
<script src="js/mui.picker.min.js"></script>
</head>
<body>
<!--header star-->
<header class="hasManyCity hasManyCitytwo" id="header">
<a href="javascript:history.go(-1)" class="fl fanhui"><i class="iconfont icon-fanhui"></i></a>
<div class="header-tit">
Send Post
</div>
</header>
<!--header end-->


<?php
    
    function httpGet($url, $data=array(), $header=array(), $timeout=30){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 跳过证书检查
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        
        $response = curl_exec($ch);
        
        if($error=curl_error($ch)){
            die($error);
        }
        
        curl_close($ch);
        
        return $response;
        
    }
    function createNonceStr($length = 16) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }
    function get_access_token($appid,$appsecret){
        
        //echo "get access token";
        
        $file_data=file_get_contents('access_token.json');
        if(!$file_data) {
            
            $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=' . $appid . '&secret=' . $appsecret;
            $rurl = file_get_contents($url);
            $rurl = json_decode($rurl, true);
            
            $data = array();
            $data['access_token'] = $rurl['access_token'];
            $data['created_time'] = time() ;
            $jsonStr = json_encode($data);
            $fp = fopen("access_token.json", "w");
            fwrite($fp, $jsonStr);
            fclose($fp);
            
            if(array_key_exists('errcode',$rurl)){
                //echo "<br> failed <br>";
                //echo "errcode<br>".$rurl['errcode'];
                return false;
            }else{
                $access_token = $rurl['access_token'];
                //echo "get access1 -> $access_token";
                return $access_token;
            }
            
        }
        else {
            
            $file_data_arr=json_decode($file_data,true);
            if ((time()-$file_data_arr['created_time'])>6800)
            {
                $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=' . $appid . '&secret=' . $appsecret;
                $rurl = file_get_contents($url);
                $rurl = json_decode($rurl, true);
                
                $data = array();
                $data['access_token'] = $rurl['access_token'];
                $data['created_time'] = time();
                $jsonStr = json_encode($data);
                $fp = fopen("access_token.json", "w");
                fwrite($fp, $jsonStr);
                fclose($fp);
                
                if(array_key_exists('errcode',$rurl)){
                    //echo "<br> failed <br>";
                    //echo "errcode<br>".$rurl['errcode'];
                    return false;
                }else{
                    $access_token = $rurl['access_token'];
                    //echo "get access2 -> $access_token";
                    return $access_token;
                }
            }
            else {
                $s=$file_data_arr['access_token'];
                //echo "get access3 -> $s";
                return $s;
            }
            
        }
        
        
    }
    function getJsApiTicket() {
        
        global $accessToken;
        
        
        $appid="wxbdc7bc1e209bdac4";
        $secret="3273c0aed84cceb42125867afbced999";
        $data = json_decode(file_get_contents("jsapi_ticket.json"));
        $accessToken = get_access_token($appid, $secret);
        // 如果是企业号用以下 URL 获取 ticket
        // $url = "https://qyapi.weixin.qq.com/cgi-bin/get_jsapi_ticket?access_token=$accessToken";
        $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=$accessToken";
        $res = json_decode(httpGet($url));
        $ticket = $res->ticket;
        
        return $ticket;
    }
    
    
    $nonceStr = createNonceStr();
    
    $accessToken='';
    
    // 注意 URL 一定要动态获取，不能 hardcode.
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $url = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $jsapiTicket = getJsApiTicket();
    $timestamp = time();
    
    
    
    $string = "jsapi_ticket=$jsapiTicket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";
    
    $signature = sha1($string);
    $signature.='';
    
    
    //echo "times ".$timestamp."<br> noncestr ".$nonceStr."<br> sig ".$signature."<br> url ".$url."<br> ticket ".$jsapiTicket;
    
    ?>



<style type="text/css">


.upload {
opacity: 0;
position: absolute;
    z-index: 10;
    
}

</style>

<script type="text/javascript">



wx.config({
          debug: false, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
          appId: 'wxbdc7bc1e209bdac4', // 必填，公众号的唯一标识
          timestamp: <?php echo $timestamp?>, // 必填，生成签名的时间戳
          nonceStr:  "<?php echo $nonceStr?>", // 必填，生成签名的随机串
          signature:  "<?php echo $signature?>",// 必填，签名，见附录1
          jsApiList: [
          'checkJsApi',
          'chooseImage',
          'uploadImage',
          'previewImage',
          'downloadImage'] // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
          
          
          });

function upload(localIds,i)
{wx.uploadImage({
                
                
                
                localId: "" + localIds[i],
                isShowProgressTips: 1,
                success: function(res) {
                serverId = res.serverId;
                setTimeout(console.log("delay "+i),1000);
                
                
                
                //alert(i+" ok，serverId："+serverId);
                
                if (i==0) {$("#hid_pic1").val(serverId);//alert("1st");
                }
                if (i==1) {$("#hid_pic2").val(serverId);//alert("2nd");
                }
                if (i==2) {$("#hid_pic3").val(serverId);//alert("3rd");
                }
                
                i++;
                if (i<localIds.length) upload(localIds,i);
                
                },
                fail: function(res){
                alert("err，msg："+JSON.stringify(res));
                }
                
                });
    
    
    
}


function chooseImage(){
    // 选择张片
    //alert("choose:");
    wx.chooseImage({
                   count: 3, // 默认9
                   sizeType: ['original', 'compressed'], // 可以指定是原图还是压缩图，默认二者都有
                   sourceType: ['album', 'camera'], // 可以指定来源是相册还是相机，默认二者都有
                   success: function(res) {
                   var localIds = res.localIds; // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片
                   $("#file_UserPic1").attr('src', localIds[0]);
                   $("#file_UserPic2").attr('src', localIds[1]);
                   $("#file_UserPic3").attr('src', localIds[2]);
                   //alert("locals length :"+localIds.length);
                   
                   upload(localIds,0);
                   
                   },
                   // 上传照片
                   
                   fail: function(res){
                   alert("err，msg："+JSON.stringify(res));
                   }
                   });
}
//https://api.weixin.qq.com/cgi-bin/media/get?access_token=BFZKdUSrzbBDgyijJaGcEEwp18iO_ANlrjzzfssO2pVbOxef0HK2hCqLg3jaSzBpT3vSstpHuMBSU7Z4k6luvWZcuUpkSc4gCfeIkOfHu6g2nJGkCQ7-ytFyQ-avwvNrFSXjAEAYLQ&media_id=Awc7Oso8qZvYqxqmXxNfvi3zI9dAI5lihA14A7NnW7x7ZKTuZgCMOyzwO59DA1dN
//










</script>

<form action="sendPost_action.php" method="post" enctype="multipart/form-data">
<div class="warp warpthree clearfloat" id="main">
<div class="recharge clearfloat">
<div class="addtu clearfloat">
<a href="#" onclick="chooseImage()">Add Pic(s) </a>

<div class="tubottom clearfloat fl">
<ul>
<li><img id="file_UserPic1" src=""/></li>

<li><img id="file_UserPic2" src=""/></li>

<li><img id="file_UserPic3" src=""/></li>
</ul>
</div>
</div>
<div class="czhi clearfloat box-s">
<p>title</p>
<input type="text" id="title" value="" name="title"  style="-webkit-user-select: text" placeholder="this is title" required/>
</div>
<div class="czhi clearfloat box-s" style="-webkit-user-select: text" id='diy_select_category'>
<p id="categories">Category</p>
<i class="iconfont icon-xiala fr" ></i>
</div>
<div class="czhi clearfloat box-s" id="old_price" >
<p class="dtit">Original Price ¥</p>
<input type="text"  value="" name="original_price" style="-webkit-user-select: text" placeholder="(optional)" />
</div>
<div class="czhi clearfloat box-s" id="new_price">
<p class="dtit">Current Price ¥</p>
<input type="text"  value="" name="current_price" style="-webkit-user-select: text" placeholder="(optional)" />
</div>
<div class="czhi clearfloat box-s" id="sqm"  >
<p class="dtit">SQM / ㎡</p>
<input type="text"  value="" name="sqm" style="-webkit-user-select: text" placeholder="(Necessary for Rent)" />
</div>

<div class="czhi clearfloat box-s" id="location_id" >
    <!--<a href="location.php">-->
<p>Location</p>
<input type="text"  value="" name="location" style="-webkit-user-select: text" placeholder="(optional)" />
   <!-- </a>-->
</div>
<div class="czhi clearfloat box-s">
<textarea id="content"  rows=10 cols=41 placeholder="this is content" name="content" style="-webkit-user-select: text" required></textarea>
</div>

    <input type="hidden" id="userResult" value="" name="category"   />


<input type="hidden" id="hid_pic1" name="pic1" >
<input type="hidden" id="hid_pic2" name="pic2" >
<input type="hidden" id="hid_pic3" name="pic3" >
<input type="hidden" id="access" name="access" value="<?php echo $accessToken ?>"
</div>
</div>



<div class="renting-footer renting-footertwo clearfloat" id="footer">
<ul>
<li><a href="#" onclick="submit_check()">Send</a></li>
</ul>
</div>
</form>

<script type="text/javascript">


document.getElementById("old_price").style.display='none';
document.getElementById("new_price").style.display='none';
document.getElementById("location_id").style.display='none';
document.getElementById("sqm").style.display='none';




function appear(){
    
    
    var userResult=document.getElementById("userResult").value;
    
    
    if (userResult!=''){
        
        
        
        if (userResult=="2nd-hand"){
            
            document.getElementById("old_price").style.display='';
            document.getElementById("new_price").style.display='';
            document.getElementById("location_id").style.display='';
            document.getElementById("sqm").style.display='none';
            
        }
        
        else if (userResult=="Event"){
            
            
            document.getElementById("location_id").style.display='';
            document.getElementById("old_price").style.display='none';
            document.getElementById("new_price").style.display='none';
            
            document.getElementById("sqm").style.display='none';
            
            
        }else if (userResult=="Recommended"){
            
            document.getElementById("location_id").style.display='';
            document.getElementById("old_price").style.display='none';
            document.getElementById("new_price").style.display='none';
            
            document.getElementById("sqm").style.display='none';
            
        }
        /*else if (userResult=="Rental Info"){
            
            document.getElementById("sqm").style.display='';
            document.getElementById("location_id").style.display='';
            document.getElementById("old_price").style.display='none';
            document.getElementById("new_price").style.display='';
            
        }else if (userResult=="Internship"){
            
            document.getElementById("location_id").style.display='';
            document.getElementById("old_price").style.display='none';
            document.getElementById("new_price").style.display='none';
            document.getElementById("sqm").style.display='none';
            
        }*/
        else if (userResult=="Marketing"){
            
            document.getElementById("new_price").style.display='';
            document.getElementById("location_id").style.display='';
            
            document.getElementById("sqm").style.display='none';
            document.getElementById("old_price").style.display='none';
            
        }else {
            document.getElementById("old_price").style.display='none';
            document.getElementById("new_price").style.display='none';
            document.getElementById("location_id").style.display='none';
            document.getElementById("sqm").style.display='none';
        }
        
    }
    
    
    
    
    
}



function submit_check()
{
    var title=document.getElementById("title").value;
    var content=document.getElementById("content").value;
    
    var userResult=document.getElementById("userResult").value;
    
    if (userResult=='') alert("Please choose a category! ");
    else if (title=='') alert("Please fill in the title! ");
    else if (content=='') alert("Please fill in the content! ");
    else if (title.length>=30) alert("Title should be less than 30 characters! ");
    else document.forms[0].submit();
    
}









</script>

</body>
<script src="js/other.js"></script>
</html>
