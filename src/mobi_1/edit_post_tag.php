<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Edit Tag</title>
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
if ($_SESSION['isadmin']=='1') {
//collect data from database
    require_once("connect.php");


    $postid = $_GET['postid'];
    $query_get_post = "select * from post where id='$postid'  ";
    $result = mysql_query($query_get_post);
    $info = mysql_fetch_array($result);

    $post = $info['tag'];
    $result_02=$info['priority'];



    ?>


    <body>
    <header class="hasManyCity hasManyCitytwo" id="header">
        <a href="javascript:history.go(-1)" class="fl fanhui"><i class="iconfont icon-fanhui"></i></a>
        <div class="header-tit">
            Edit Tag
        </div>
        <a onclick="document.forms[0].submit()" href="#" class="fr baocun">Save</a>
    </header>
    <form action="edit_post_tag_action.php?postid=<?php echo $postid ?>" method="post">
        <div id="container">
            <div id="main" class="mui-clearfix add-post">
                <div class="plist clearfloat data">
                    <ul>
                        <li class="clearfloat">
                            <a href="#">
                                <p class="fl">Tag</p>
                            </a>
                        </li>

                    </ul>
                </div>
                <textarea name="tag" rows="4" cols="80" style="-webkit-user-select: text"
                          placeholder="(e.g. a post about rent you should write: less than 800;hangzhou,zhejiang;...   )."
                          class="textare box-s"><?php echo $post ?></textarea>
                <div class="plist clearfloat data">
                    <ul>
                        <li class="clearfloat">
                            <a href="#">
                                <p class="fl">Priority</p>
                            </a>
                        </li>

                    </ul>
                </div>


                <select name="priority" class="selector">
                    <option >0</option>
                    <option >1</option>
                    <option >2</option>
                    <option >3</option>
                    <option >4</option>
                    <option >5</option>
                    <option >6</option>
                    <option >7</option>
                    <option >8</option>
                    <option >9</option>
                </select>
                <script>

<?php
    if ($result_02!='')
    {
    
    ?>
                   $(".selector").val(<?php echo $result_02 ?>);

<?php
    }
    ?>
                </script>
            </div>
        </div>
    </form>
    </body>
    <!--默认按钮-->
    <?php
        }mysql_close();
?>

</html>
