<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Admin Management</title>
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, width=device-width">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <meta name="format-detection" content="address=no">
    <link rel="stylesheet" type="text/css" href="css/common.css">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="css/mui.min.css"/>
    <link rel="stylesheet" href="css/reset.css">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/iscroll.js"></script>
    <script type="text/javascript" src="js/jquery.flexslider-min.js"></script>
    <script src="js/hmt.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/index.js"></script>
    <script src="js/swiper.min.js" type="text/javascript" ></script>
</head>

<?php
@session_start();
$nickname=$_SESSION['nickname'];
$sig=$_SESSION['signature'];
$headimg=$_SESSION['headimg'];
$userid=$_SESSION['userid'];
require_once("connect.php");
$isadmin=$_SESSION['isadmin'];

if ($isadmin=='1'){

//posts num
$query_posts = "select count(*) from post where check_status='-1' ";
$rqst = mysql_query($query_posts, $conn);
if (mysql_num_rows($rqst)) {
    $result_posts = mysql_fetch_array($rqst);
    $posts = $result_posts[0];
} else {
    $posts = 0;
}

//unread_messages_num
$query_msg = "select count(*) from system_message where msg_to='system' and msg_read='0'";
$rqst3 = mysql_query($query_msg, $conn);
if (mysql_num_rows($rqst3)) {
    $result_msg = mysql_fetch_array($rqst3);
    $msgs = $result_msg[0];
} else {
    $msgs = 0;
}


mysql_close();

?>


<body>
<!--header star-->
<header class="hasManyCity hasManyCitytwo" id="header">
    <a href="javascript:history.go(-1)" class="fl fanhui"><i class="iconfont icon-fanhui"></i></a>
    <div class="header-tit">
        Admin Management
    </div>
    <!--<a href="setup.php" class="fr shoucang sousuo"><i class="iconfont icon-shezhi"></i></a>
    <a href="messages.php" class="fr shoucang sousuo"><i class="iconfont icon-kefu1"></i></a>-->
</header>
<!--header end-->
<div id="container">
    <div id="main">
        <div class="warp clearfloat">
            <div class="h-top clearfloat box-s">
                <div class="tu clearfloat fl">
                    <a href="setup.php">
                        <img src="<?php echo $headimg ?>"/>
                    </a>
                </div>
                <div class="content clearfloat fl">
                    <p class="hname"><?php echo $nickname ?></p>
                    <p class="htel"><?php echo $sig ?></p>
                </div>
                <div class="h-bottom clearfloat">
                    <samp></samp>
                    <ul>
                        <li>
                            <a href="check_posts.php">
                                <p><?php echo $posts ?></p>
                                <span>Unchecked Posts</span>
                            </a>
                        </li>
                        <li>
                            <a href="admin_unread_messages.php">
                                <p><?php echo $msgs ?></p>
                                <span>Unread Messages</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!--<div class="cash clearfloat">
                <div class="cash-tit clearfloat box-s">
                    收藏关注
                </div>
                <div class="shang xia clearfloat">
                    <ul>
                        <li>
                            <a href="tuan.html">
                                <p><i class="iconfont icon-tuangou"></i></p>
                                <span>团购收藏</span>
                            </a>
                        </li>
                        <li>
                            <a href="mall.html">
                                <p><i class="iconfont icon-baihuo"></i></p>
                                <span>百货收藏</span>
                            </a>
                        </li>
                        <li>
                            <a href="remen.html">
                                <p><i class="iconfont icon-shangjia"></i></p>
                                <span>关注商家</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="cash clearfloat">
                <div class="cash-tit clearfloat box-s">
                    我的优惠券
                </div>
                <div class="shang clearfloat">
                    <ul>
                        <li>
                            <a href="coupon.html">
                                <img src="img/sale1.png"/>
                                <span>商家优惠券</span>
                            </a>
                        </li>
                        <li>
                            <a href="coupon.html">
                                <img src="img/sale2.png"/>
                                <span>平台优惠券</span>
                            </a>
                        </li>
                        <li>
                            <a href="member.html">
                                <img src="img/sale3.png"/>
                                <span>我的会员</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            -->

            <div class="cashlist clearfloat">
                <ul>
                    <li class="box-s">
                        <a href="check_posts.php">
                            <p class="fl">Manual Check Posts</p>
                            <i class="iconfont icon-jiantou1 fr"></i>
                        </a>
                    </li>

                    <li class="box-s">
                        <a href="admin_unread_messages.php">
                            <p class="fl">Unread Messages</p>
                            <i class="iconfont icon-jiantou1 fr"></i>
                        </a>
                    </li>

                </ul>
            </div>
            <!--<a href="login.html" class="center-btn db ra3">Login</a>-->
        </div>
    </div>
</div>

<!--footer star-->
<footer id="footer">
    <div>
        <a href="index.php">
            <div class="icon i-1"></div>
            <p>Home</p>
        </a>
    </div>
    <div>
        <a href="blog/index.php">
            <div class="icon i-5"></div>
            <p>Blog</p>
        </a>
    </div>
    <div>
        <a href="blog/sendPost.php">
            <div class="icon i-2"></div>
            <p>Post</p>
        </a>
    </div>
    <div>
        <a href="favorite_records.php">
            <div class="icon i-3"></div>
            <p>Favorite</p>
        </a>
    </div>
    <div>
        <a href="center.php">
            <div class="icon i-4 on"></div>
            <p>Me</p>
        </a>
    </div>
</footer>
<!--footer end-->
<?php
}
?>

</body>
<script type="text/javascript" src="js/jquery-1.8.3.min.js" ></script>
<script src="js/mui.min.js"></script>
<script src="js/others.js"></script>
<script type="text/javascript" src="js/hmt.js" ></script>
<script src="slick/slick.js" type="text/javascript" ></script>
<!--插件-->
<link rel="stylesheet" href="css/swiper.min.css">
<script src="js/swiper.jquery.min.js"></script>
</html>
