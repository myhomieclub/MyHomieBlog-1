<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Records of My Posts</title>
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

if (!$_SESSION['userid'])
{
    header('index.php');
}
else {
$userid = $_SESSION['userid'];
require_once("connect.php");


$query_get_posts_records = "select id,title,category,seen from post where post.valid='1' and post.check_status='1' and post.id in (select postid from favorite where favorite.userid='$userid' and favorite.valid='1') order by seen desc;";
$result = mysql_query($query_get_posts_records);





?>


<body>
<!--header star-->
<header class="hasManyCity hasManyCitytwo" id="header">
    <a href="javascript:history.go(-1)" class="fl fanhui"><i class="iconfont icon-fanhui"></i></a>
    <div class="header-tit">
        Records of My Favorites
    </div>
</header>
<!--header end-->
<div id="container">
    <div id="main">
        <div class="warp warpthree clearfloat">
            <div class="account clearfloat">
                <div class="top clearfloat">
                    <ul>
                        <li class="box-s">Title</li>
                        <li>Category</li>
                        <li>Seen</li>
                    </ul>
                </div>
                <div class="list clearfloat box-s">
                    <?php
                    while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {


                        $postid=$row['id'];
                        ?>

                        <a href="blog/singlepage.php?postid=<?php echo $postid ?>">
                            <div class="shang clearfloat">
                                <ul style="height:auto">
                                    <li class="box-s" style="font-size:.1rem;height:auto"><?php echo $row['title'] ?>
                                    </li>
                                    <li style="height:auto"><?php echo $row['category'] ?></li>
                                    <li style="font-size:.1rem;height:auto"><?php echo $row['seen'] ?></li>
                                </ul>
                            </div>
                        </a>
                        <?php
                    }

                    mysql_free_result($result);
                    mysql_close();

                    }




                    ?>

                </div>
            </div>
        </div>
    </div>
</div>


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
            <div class="icon i-4"></div>
            <p>Me</p>
        </a>
    </div>
</footer>
</body>

<script src="js/mui.min.js"></script>

<script type="text/javascript" src="js/hmt.js" ></script>

<!--插件-->

</html>

