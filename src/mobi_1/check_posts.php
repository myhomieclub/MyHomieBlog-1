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

    function pass_confirm()
    {
        var returnValue=confirm("Are you sure to PASS this post?");
        if (returnValue==true)
        {
            return true;
        }
        else return false;
    }
    function fail_confirm()
    {
        var returnValue=confirm("Are you sure to FAIL this post?");
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

if ($_SESSION['isadmin']=='1') {

    $query_get_address = "select * from post where valid='1'  order by id desc";
    $result = mysql_query($query_get_address);


    ?>

    <body>
    <header class="hasManyCity hasManyCitytwo" id="header">
        <a href="admin_functions.php" class="fl fanhui"><i class="iconfont icon-fanhui"></i></a>
        <div class="header-tit">
            Posts Management
        </div>
    </header>
    <div id="container">
        <div id="main" class="mui-clearfix contaniner">

            <?php
            while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {

                $postid = $row['id'];

                $title = $row['title'];
                $content = $row['content'];
                $time = $row['created_time'];
                $status=$row['check_status'];
                if ($status=='-1') $status_word="Status: Unchecked";
                else if ($status=='1') $status_word="Status: Passed";
                else $status_word="Status: Failed to Pass";
                /*
                $valid=$row['valid'];
                if ($valid=='1') $valid_word=" Valid";
                else if ($valid==0) $valid_word=" Invalid";
    */
//$status_word="Unchecked!";
                ?>


                <div class="addlist clearfloat" style="height: auto;border-top: 1px solid #dcdad3;">
                    <div class="top clearfloat box-s">
                        <a href="blog/admin_browse_post.php?postid=<?php echo $postid ?>">
                        <ul>
                            <!--li>
                                <span class="fl"><?php echo $title ?></span>
                                <span class="fr"><?php echo $time ?></span>
                            </li>
                            <li style="width:350px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">
                                <?php echo $content ?>
                            </li-->

                            <li style="overflow:hidden">
                                <img src="<?php echo $row['pic1'] ?>"/>
                            </li>
                            <li style="width:45%; ">
                                <p style="font-size: 18px; color: #000;"><?php echo $title ?></p>
                                <p style="font-size: 10px; color: #666;height:16px; line-height: 16px;"><?php echo $time ?></p>
                                <p style="font-size: 14px; color: #111;"><?php echo $content ?></p>
                            </li>
                        </ul>
                        </a>
                    </div>
                    <div class="bottom clearfloat box-s">
                        <section class="shopcar clearfloat">
                            <div class="list listtwo clearfloat">
                                <div class="xuan xuantwo clearfloat fl">

                                </div>

                                <span class="mradd fl"><?php echo $status_word ?></span>
                                <div class="right fr clearfloat">
                                    <a href="edit_post_tag.php?postid=<?php echo $postid ?>" class="fr">
                                        <i class="iconfont icon-bianji bianjittt"></i>
                                        Edit
                                    </a>
                                    <a href="check_post_action.php?pass=1&postid=<?php echo $postid ?>" class="fr"
                                            onclick="javascript:return pass_confirm()">
                                        <i class="iconfont icon-bianji bianjittt"></i>
                                        Pass
                                    </a>
                                    <a href="check_post_action.php?pass=0&postid=<?php echo $postid ?>" class="fr"
                                       onclick="javascript:return fail_confirm()">
                                        <i class="iconfont icon-bianji bianjittt"></i>
                                        Fail
                                    </a>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>

                <?php
            }

            mysql_free_result($result);
            mysql_close();


            ?>
            <!--
            <div class="addlist clearfloat">
                <div class="top clearfloat box-s">
                    <ul>
                        <li>
                            <span class="fl">John Doe</span>
                            <span class="fr">1303505****</span>
                        </li>
                        <li>
                            Pinfeng campus,ZJUT,Hangzhou,Zhejiang,China
                        </li>
                    </ul>
                </div>
                <div class="bottom clearfloat box-s">
                    <section class="shopcar clearfloat">
                        <div class="list listtwo clearfloat">
                            <div class="xuan xuantwo clearfloat fl">
                                <div class="radio" >
                                    <label>
                                        <input type="checkbox" name="sex" value="" />
                                        <div class="option"></div>
                                    </label>
                                </div>
                            </div>-->

            <!--<span class="mradd fl">Default</span>-->
            <!--<div class="right fr clearfloat">
                <a href="#" class="fr">
                    <i class="iconfont icon-lajixiang icon-shanchutwo"></i>
                    Delete
                </a>
                <a href="#" class="fr">
                    <i class="iconfont icon-bianji bianjittt"></i>
                    Edit
                </a>
            </div>
            </div>
        </section>
    </div>
    </div>-->


        </div>

    </div>
    <br>
    <br>
    </body>
    <?php
}
?>
</html>
