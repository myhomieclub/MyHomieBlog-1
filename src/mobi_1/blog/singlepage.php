


<!DOCTYPE HTML>
<html>
<head>
    <title>Post</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Style Blog Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script type="applijewelleryion/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
    <!-- Custom Theme files -->
    <link href='//fonts.googleapis.com/css?family=Raleway:400,600,700' rel='stylesheet' type='text/css'>
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <link rel="stylesheet" type="text/css" href="css/common.css">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="css/mui.min.css"/>
    <link rel="stylesheet" href="css/reset.css">
    <script src="js/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="js/iscroll.js"></script>
    <script type="text/javascript" src="js/jquery.flexslider-min.js"></script>
    <script src="js/hmt.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/index.js"></script>
    <script src="js/swiper.min.js" type="text/javascript" ></script>
    <script src="js/bootstrap.min.js"></script>

    <script type="text/javascript" src="../js/jweixin-1.2.0.js"></script>
</head>

<?php

@session_start();
$postid=$_GET['postid'];
require_once("../connect.php");
$if='0';
if (!$_SESSION['userid'])
{

}
else {
    $userid = $_SESSION['userid'];
    $usernickname = $_SESSION['nickname'];
    $userpic = $_SESSION['headimg'];

    $browsed_time=date("F j, Y, g:i a");
    //browse record
    $query_browse="insert into browse(userid,postid,browsed_time) values('$userid','$postid','$browsed_time')";
    mysql_query($query_browse);

    $query_if="select * from favorite where userid='$userid' and postid='$postid' and valid='1' ";

    $res_if=mysql_query($query_if);
    $result_if=mysql_fetch_array($res_if,MYSQL_ASSOC);
    $if_id=$result_if['id'];
    if ($if_id!='') $if='1';


}
//get post info

$query_get_post_info="select * from post where id='$postid' and check_status='1' and valid='1'";
$post_resource=mysql_query($query_get_post_info);
$post_results=mysql_fetch_array($post_resource,MYSQL_ASSOC);
$title=$post_results['title'];
$content=$post_results['content'];
$seen=$post_results['seen'];

//.....still
$pic1=$post_results['pic1'];
$pic2=$post_results['pic2'];
$pic3=$post_results['pic3'];
$created_time=$post_results['created_time'];

$location=$post_results['location'];
$sqm=$post_results['sqm'];
$old_p=$post_results['original_price'];
$new_p=$post_results['current_price'];

$show='';
if ($location!='')  $show.="<br><p style='color:orange'>Location: ".$location."</p>";
if ($sqm!='')  $show.="<br><p style='color:orange'>Square Meter: ".$sqm." ㎡</p>";
if ($old_p!='')  $show.="<br><p style='color:orange'>Original Price: ".$old_p." ¥</p>";
if ($new_p!='')  $show.="<br><p style='color:orange'>Current Price: ".$new_p." ¥</p>";

//get author info
$author=$post_results['author'];

$query_get_author_info="select * from user where id='$author'";
$author_res=mysql_query($query_get_author_info);
$author_info=mysql_fetch_array($author_res,MYSQL_ASSOC);
$author_nickname=$author_info['nickname'];
$author_signature=$author_info['signature'];
$author_pic=$author_info['headimg'];

//......still

//seen ++
$seen=$seen+1;
$query_reset_post_seen="update post set seen=seen+1 where id='$postid'";
mysql_query($query_reset_post_seen);



//get comment info
$query_comm_num="select count(*) from comment where valid='1' and postid='$postid'";
$comm_res=mysql_query($query_comm_num,$conn);

if (mysql_num_rows($comm_res))
{
    $rs=mysql_fetch_array($comm_res);
    $comment_num=$rs[0];
    //echo "<h1>comm ".$comment_num."</h1>";
}
else {$comment_num=0;//echo "<h1>comm 0</h1>";
}

$query_main_comment_info="select * from comment where valid='1' and postid='$postid' and formerid is null";
$comment_res=mysql_query($query_main_comment_info);



?>



<body>



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

<body>

<script type="text/javascript">



wx.config({
          debug: false, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
          appId: 'wxbdc7bc1e209bdac4', // 必填，公众号的唯一标识
          timestamp: <?php echo $timestamp ?>, // 必填，生成签名的时间戳
          nonceStr:  "<?php echo $nonceStr?>", // 必填，生成签名的随机串
          signature:  "<?php echo $signature?>",// 必填，签名，见附录1
          jsApiList: [
          'previewImage'
          ] // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
          
          
          });


function preview(obj){
    
    
    prefix="http://myhomie.chinaxueyun.com/mobi_1/blog/";
    urls=[];
    if ($("#file_UserPic1").attr('src')!='')
    {
        urls.push(prefix+$("#file_UserPic1").attr('src'));
       
        if ($("#file_UserPic2").attr('src')!='')
            urls.push(prefix+$("#file_UserPic2").attr('src'));
        
        if($("#file_UserPic3").attr('src')!='')
            urls.push(prefix+$("#file_UserPic3").attr('src'));
        
        
        wx.previewImage({
                        current: obj.src,
                        urls: urls
                        });
    }
    
    
}


</script>


<header class="hasManyCity hasManyCitytwo" id="header">
<a href="javascript:history.go(-1)" class="fl fanhui"><i class="iconfont icon-fanhui"></i></a>
<div class="header-tit">
&nbsp;&nbsp;&nbsp;&nbsp;Post
</div>
</header>
<!-- screening -->


<!-- technology-left -->
<div class="technology">
<div class="container">
<div class="col-md-9 technology-left">
<div class="agileinfo">

<br>
<h2 class="w3">Detailed Page</h2>
<br>
<div class="single">


<?php  if ($pic1!='') echo "<img src='$pic1' onclick='preview(this);' id='file_UserPic1' class='img-responsive'><br>";
    if ($pic2!='') echo "<img src='$pic2' onclick='preview(this);' id='file_UserPic2' class='img-responsive'><br>";
    if ($pic3!='') echo "<img src='$pic3' onclick='preview(this);' id='file_UserPic3' class='img-responsive'><br>";
    ?>

                    <div class="b-bottom">
                        <h5 class="top"><?php echo $title ?></h5>
                        <p class="sub"><?php echo $content ?></p>
                        <p><a class="span_link" href="#" style="color:red"><span class="glyphicon glyphicon-calendar"></span><?php echo $created_time ?></a><a class="span_link" href="#" style="color:red"><span class="glyphicon glyphicon-comment"></span><?php echo $comment_num ?></a><a class="span_link" href="#" style="color:red"><span class="glyphicon glyphicon-eye-open"></span><?php echo $seen ?> </a></p>
                        <?php echo $show ?>
                    </div>
                </div>
                <div class="response">
                    <h4>Author</h4>
                    <div class="media response-info">
                        <div class="media-left response-text-left">
                            <a href="http://www.smartsupremesoft.com:55151/?from_id=<?php echo $userid ?>&to_id=<?php echo $author ?>&from_name=<?php echo $usernickname ?>&to_name=<?php echo $author_nickname ?>&from_img=<?php echo $userpic ?>&to_img=<?php echo $author_pic ?>">
                                <img src="../<?php echo $author_pic ?>" class="img-responsive" alt="">
                            </a>
                        </div>
                        <div class="media-body response-text-right">
                            <p><?php echo $author_signature ?></p>
                            <ul>
                                <li><a href="#"><span class="glyphicon glyphicon-user"></span> <?php echo $author_nickname ?></a></li>
                            </ul>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                    <div class="clearfix"> </div>
                </div>


                <div class="response">
                    <h4>Responses</h4>

                    <?php

                    while ($row = mysql_fetch_array($comment_res, MYSQL_ASSOC)) {

                        $commentatorid=$row['author'];
                        $pic=$row['pic'];
                        $content=$row['content'];
                        $no=$row['id'];
                        $created_time=$row['created_time'];

                        //get commentator's name & pic
                        $query_get_c_info="select * from user where id='$commentatorid'";
                        $res_c=mysql_query($query_get_c_info);
                        $result_c=mysql_fetch_array($res_c,MYSQL_ASSOC);

                        $headimg="../".$result_c['headimg'];
                        $name=$result_c['nickname'];


                        ?>

                        <hr>
                        <div class="media response-info">
                            <div class="media-left response-text-left">
                                <a href="#">
                                    <img src="<?php echo $headimg  ?>" class="img-responsive" alt="">
                                </a>
                            </div>
                            <div class="media-body response-text-right">
                                <?php if ($pic!='') echo "<img src='$pic' class='img-responsive'>"; ?>
                                <p><?php echo $content ?></p>
                                <ul>
                                    <li><?php echo $created_time ?></li>
                                    <li><a href="#"><?php echo $name ?></a></li>
                                    <li><a onclick="reply_scroll(<?php echo $no  ?>)">Reply</a></li>
                                </ul>

                                <?php

                                $query_get_r="select * from comment where postid='$postid' and valid='1' and formerid='$no'";
                                $res_r=mysql_query($query_get_r);
                                while ($result_r = mysql_fetch_array($res_r, MYSQL_ASSOC)) {


                                    $r_commentatorid=$result_r['author'];
                                    $r_pic=$result_r['pic'];
                                    $r_content=$result_r['content'];
                                    $r_no=$result_r['id'];
                                    $r_created_time=$result_r['created_time'];

                                    //get commentator's name & pic
                                    $query_get_r_info="select * from user where id='$r_commentatorid'";
                                    $res_r_info=mysql_query($query_get_r_info);
                                    $result_r_info=mysql_fetch_array($res_r_info,MYSQL_ASSOC);

                                    $r_headimg="../".$result_r_info['headimg'];
                                    $r_name=$result_r_info['nickname'];



                                    ?>

                                    <div class="media response-info">
                                        <div class="media-left response-text-left">
                                            <a href="#">
                                                <img src="<?php echo $r_headimg  ?>" class="img-responsive" alt="">
                                            </a>
                                        </div>
                                        <div class="media-body response-text-right">
                                            <?php if ($r_pic!='') echo "<img src='$r_pic' class='img-responsive'>"; ?>
                                            <p><?php echo $r_content ?></p>
                                            <ul>
                                                <li><?php echo $r_created_time ?></li>
                                                <li><a href="#"><?php echo $r_name ?></a></li>

                                            </ul>
                                        </div>

                                        <div class="clearfix"></div>
                                    </div>

                                    <?php
                                }
                                ?>


                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <?php


                    }

                    ?>


                </div>
                <script type="text/javascript">
                    function check_comment()
                    {
                        if (document.getElementById("content_text").value=="" || document.getElementById("content_text").value=="Your Comment...")
                        {
                            alert("Please fill in the content!");
                            return false;
                        }
                        else return true;


                    }


                </script>

                <div class="coment-form" id="pos">
                    <h4>Leave your comment</h4>
                    <form action="comment_action.php?postid=<?php echo $postid ?>" onsubmit="return check_comment();" method="post" enctype="multipart/form-data">
                        <input type="hidden" id="reply" name="reply">
                        Choose a pic(optional):
                        <input type="file" name="comment_pic" accept="image/gif,image/jpg,image/png,image/jpeg" style="-webkit-user-select: text">
                        <textarea style="-webkit-user-select: text" id="content_text" name="content" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Your Comment...';}" required="">Your Comment...</textarea>
                        <input type="submit" value="Submit Comment">
                    </form>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <!-- technology-right -->

        <?php

        $query_get_pop="select * from post where valid='1' and check_status='1' order by seen desc limit 0,5";
        $res_pop=mysql_query($query_get_pop);






        ?>


        <div class="col-md-3 technology-right">


            <div class="blo-top1">

                <div class="tech-btm">
                    <div class="search-1">
                        <form action="index.php" method="get">
                            <input type="hidden" name="search" value="1">
                            <input type="search" name="keyword" style="-webkit-user-select: text" placeholder="Search Posts..">
                            <input type="submit" value="">
                        </form>
                    </div>
                    <h4>Popular Posts </h4>
                    <?php

                    while ($result_pop = mysql_fetch_array($res_pop, MYSQL_ASSOC)) {


                        $pop_id=$result_pop['id'];
                        $pop_pic = $result_pop['pic1'];
                        $pop_title = $result_pop['title'];
                        $pop_content=$result_pop['content'];
                        $pop_content=substr($pop_content,0,50)."...";


                        ?>


                        <div class="blog-grids">
                            <div class="blog-grid-left">
                                <a href="singlepage.php?postid=<?php echo $pop_id  ?>"><img src="<?php echo $pop_pic ?>" class="img-responsive" alt=""></a>
                            </div>
                            <div class="blog-grid-right">

                                <h3><a href="singlepage.php?postid=<?php echo $pop_id  ?>"><?php echo $pop_title  ?></a></h3>
                                <br>
                                <br>
                                <br>
                                <h5><a href="singlepage.php?postid=<?php echo $pop_id  ?>"><?php echo $pop_content  ?></a></h5>
                            </div>
                            <div class="clearfix"></div>
                        </div>


                        <?php

                    }

                    ?>

                    <?php

                    $query_get_random="select * from post where valid='1' and check_status='1' order by rand() limit 0,9";
                    $res_random=mysql_query($query_get_random);






                    ?>


                    <div class="insta">
                        <h4>Random Posts</h4>
                        <ul>
<?php
while ($result_random = mysql_fetch_array($res_random, MYSQL_ASSOC)) {


    $random_id = $result_random['id'];
    $random_pic = $result_random['pic1'];
    $random_title = $result_random['title'];

    ?>
    <li><a href="singlepage.php?postid=<?php echo $random_id ?>"><img style="height:150px;width:150px;" src="<?php echo $random_pic ?>"
                                                                      class="img-responsive" alt=""></a></li>

    <?php

    mysql_close();

}
?>

                        </ul>
                    </div>

                    <p>Copyright © MyHomie,inc 1997-2018. All Rights Reserved.</p>

                </div>



            </div>


        </div>
        <div class="clearfix"></div>
        <!-- technology-right -->
    </div>
</div>
<input type="hidden" id="save_f" value="<?php echo $if  ?>">



<?php
/*       if ($if=='1')
       {

        echo ('<script type="text/javascript">$(document).ready(function(){alert('1');$("#favorite").css("background-color","red");});</script>');
       }
*/
?>






<script type="text/javascript">





    function reply_scroll(prev_id)
    {

        document.getElementById("reply").value=prev_id;

        var reply_offset=$("#pos").offset();
        $("body,html").animate({
            scrollTop:reply_offset.top
        },0);
    }


    function aod(){

        var save_f=$("#save_f").val();
        if (save_f=='0')
        {
            if (confirm("Do you want to add this post to favorite?")){

                location.href="add_favorite.php?postid=<?php echo $postid  ?>";
            }
        }
        else if (save_f=='1')
        {
            //$("#favorite").css("background-color","red");
            if (confirm("Do you want to delete this post from favorite?")){

                location.href="delete_favorite.php?postid=<?php echo $postid  ?>";
            }
        }


    }


</script>



<div class="side-bar">
    <a href="../index.php" class="icon-qq" style="filter:alpha(Opacity=60);opacity:0.6"></a>
    <a href="#" class="icon-chat" style="filter:alpha(Opacity=60);opacity:0.6"><div class="chat-tips"><i></i>
            <img style="width:138px;height:138px;" src="../img/qrcode.jpg" alt="Official Account "></div></a>
    <a target="_blank" id="favorite" onclick="aod()" style="background-color:skyblue;filter:alpha(Opacity=60);opacity:0.6"  class="icon-blog" ></a>

</div>


<style type="text/css">

    .side-bar a,.chat-tips i {background: url(../img/right_bg.png) no-repeat;filter:alpha(Opacity=60);opacity:0.6}
    .side-bar {width: 66px;position: fixed;bottom: 20px;right: 25px;font-size: 0;line-height: 0;z-index: 100;}
    .side-bar a {width: 66px;height: 66px;display: inline-block;background-color: #ddd;margin-bottom: 2px;}
    .side-bar a:hover {background-color: #669fdd;}
    .side-bar .icon-qq {background-position: 0 -62px;}
    .side-bar .icon-chat {background-position: 0 -130px;position: relative;}
    .side-bar .icon-blog {background-position: 0 -198px;}


    .side-bar .icon-chat:hover .chat-tips {display: block;}
    .chat-tips {padding: 20px;border: 1px solid #d1d2d6;position: absolute;right: 78px;top: -55px;background-color: #fff;display: none;}
    .chat-tips i {width: 9px;height: 16px;display: inline-block;position: absolute;right: -9px;top: 80px;background-position:-88px -350px;}
    .chat-tips img {width: 138px;height: 138px;}


</style>


<script>

    window.onload=function(){



        var save_f=$("#save_f").val();
        if (save_f=='1')
        {
            $("#favorite").css("background-color","red");

        }
    }


</script>


</body>
<script src="js/other.js" type="text/javascript"></script>
</html>






