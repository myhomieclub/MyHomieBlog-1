<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>System Messages</title>
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

<?php

@session_start();

require_once("connect.php");


$userid = $_SESSION['userid'];

//$browsed_time=date("F j, Y, g:i a");
//browse record
$query_msgs="select * from system_message where msg_from='$userid' or msg_to='$userid' order by id ";
$res_msg=mysql_query($query_msgs);








?>


<body>
<header class="hasManyCity hasManyCitytwo" id="header">
    <a href="javascript:history.go(-1)" class="fl fanhui"><i class="iconfont icon-fanhui"></i></a>
    <div class="header-tit">
        AI & Customer Service
    </div>
</header>
<div class="huifu clearfloat box-s">
    <br>
    <br>
    <br>
    <?php

    $first="true";

    while ( $row=mysql_fetch_array($res_msg,MYSQL_ASSOC))
    {


        $msg_to = $row['msg_to'];
        $msg_from = $row['msg_from'];

        if ($ifirst=="true") $last_time=$row['sent_time'];

        if ($msg_to == $userid)
        {

            $sent_time=$row['sent_time'];
            $content=$row['content'];

            $headimg=$_SESSION['headimg'];


            ?>



            <div class="list clearfloat fl">
                <?php if($first=="true" ){  echo "<p class=\"time\">$sent_time</p>";$first="false"; }
                else if ($sent_time!=$last_time){echo "<p class=\"time\">$sent_time</p>";$last_time=$sent_time;}?>
                <div class="xia clearfloat">
                    <div class="xiaoxitu clearfloat fl">
                        <div class="tu clearfloat fl">
                            <span></span>
                            <img src="img/10.png"/>
                        </div>
                    </div>
                    <i class="iconfont icon-shanchu fr"></i>
                    <div class="youctent clearfloat fr box-s">
                        <samp><img src="img/25.png"/></samp>
                        <?php echo $content ?>
                    </div>
                </div>
            </div>

            <?php
        }
        else if ($msg_from == $userid) {

            $sent_time=$row['sent_time'];
            $content=$row['content'];


            ?>

            <div class="list listtwo clearfloat fl">
                <?php if($first=="true" ){  echo "<p class=\"time\">$sent_time</p>";$first="false"; }
                else if ($sent_time!=$last_time){echo "<p class=\"time\">$sent_time</p>";$last_time=$sent_time;}?>
                <div class="xia clearfloat">
                    <i class="iconfont icon-shanchu icon-shanchuone fl"></i>
                    <div class="youctent clearfloat fl box-s">
                        <samp><img src="img/27.png"/></samp>
                        <?php echo $content ?>
                    </div>
                    <div class="xiaoxitu clearfloat fr">
                        <div class="tu clearfloat fl">
                            <span></span>
                            <img src="img/10.png"/>
                        </div>
                    </div>
                </div>
            </div>

            <?php


        }
    }

    $query_read="update system_message set msg_read='1' where msg_to='$userid' and msg_read='0'";
    mysql_query($query_read);


    mysql_close();
    ?>

    <!--
                <div class="list clearfloat fl">
                    <p class="time">2015-08-22 17:26</p>
                    <div class="xia clearfloat">
                        <div class="xiaoxitu clearfloat fl">
                            <div class="tu clearfloat fl">
                                <span></span>
                                <img src="img/10.png"/>
                            </div>
                        </div>
                        <i class="iconfont icon-shanchu fr"></i>
                        <div class="youctent clearfloat fr box-s">
                            <samp><img src="img/25.png"/></samp>
                            This is a message sent from the server
                            automatically. If you want to know more,
                            please leave a message which we will reply
                            later. If it's important, Add Homey to your friend
                            and then discuss in detail. Thx for your supporting
                            MyHomie. We are the world!
                        </div>
                    </div>
                </div>-->
</div>
<br><br><br>
<br><br><br>
<script type="text/javascript">

    function check(){
        var result=document.getElementById("content").value;
        if (result==""){
            alert("Please fill in the content!");
            return false;
        }
        else document.forms[0].submit();
    }

</script>
<div class="hfctent clearfloat box-s" id="footer">
    <form action="send_msg_action.php" method="post">
        <input type="text" name="content" value="" id="content" style="-webkit-user-select: text" class="fl text">
        <input type="button"  value="" class="fr btn" onclick="check()"/>
    </form>
</div>
</body>
</html>
