<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Posts Management</title>
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
    <script src="js/jquery-1.8.2.min.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/iscroll.js"></script>
    <script type="text/javascript" src="js/jquery.flexslider-min.js"></script>
    <script src="js/hmt.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/index.js"></script>
    <script src="js/swiper.min.js" type="text/javascript" ></script>
</head>

<script type="text/javascript">

    function delete_confirm()
    {
        var returnValue=confirm("Are you sure to delete?");
        if (returnValue==true)
        {
            return true;
        }
        else return false;
    }

</script>



<?php

@session_start();
$userid=$_SESSION["userid"];
//collect data from database
require_once("connect.php");
$query_get_address="select * from post where valid='1' and author='$userid' order by id desc";
$result = mysql_query($query_get_address);




?>

<body>
<header class="hasManyCity hasManyCitytwo" id="header">
    <a href="javascript:history.go(-1)" class="fl fanhui"><i class="iconfont icon-fanhui"></i></a>
    <div class="header-tit">
        My Posts
    </div>
</header>
<div id="container">
    <div id="main" class="mui-clearfix contaniner">

        <?php
        while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {

            $postid=$row['id'];

            $title=$row['title'];
            $pic1=$row['pic1'];
            $content=$row['content'];
            $time=$row['created_time'];
            $status=$row['check_status'];
            if ($status=='-1') $status_word="Status: Unchecked";
            else if ($status=='1') $status_word="Status: Passed";
            else $status_word="Status: Failed to Pass";


            ?>


            <div class="addlist clearfloat">
           
                <div class="top clearfloat box-s">
                    <ul> 
                        
                            <li style="overflow:hidden">
                                <img src="<?php echo $row['pic1'] ?>"/>
                            </li>
                            <li>
                                <p style="font-size: 18px; color: #000;"><?php echo $title ?></p>
                                <p style="font-size: 10px; color: #666;height:16px; line-height: 16px;"><?php echo $time ?></p>
                                <p style="font-size: 14px; color: #111;"><?php echo $content ?></p>
                            </li>
                        
                            <li>
                                <p class="mradd fl"><?php echo $status_word ?></p>
                                <div class="right fr clearfloat">
                                    <a href="delete-post.php?postid=<?php echo $postid ?>" onclick="javascript:return delete_confirm()">
                                           <i class="iconfont icon-lajixiang icon-shanchutwo"></i>
                                           Delete
                                    </a>
                                </div> 
                            </li>
                    </ul>
                </div>
            </div>

            <?php
        }

        mysql_free_result($result);
        mysql_close();






        ?>


    </div>
    <a href="blog/sendPost.php" class="address-add fl">
        Create New Post
    </a>
</div>
<br>
<br>
</body>
</html>
add fl">
        Create New Post
    </a>
</div>
<br>
<br>
</body>
</html>
