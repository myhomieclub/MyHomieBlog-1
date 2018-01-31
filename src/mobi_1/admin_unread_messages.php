

<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Unread Messages</title>
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

if ($_SESSION['isadmin']=='1'){
require_once("connect.php");





?>
<body>
<header class="hasManyCity hasManyCitytwo" id="header">
    <a href="javascript:history.go(-1)" class="fl fanhui"><i class="iconfont icon-fanhui"></i></a>
    <div class="header-tit">
        Unread Messages
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

                            $rent_query = "select count(*) num,msg_from from system_message where msg_read='0' and msg_from!='' and msg_from!='system'  group by msg_from order by num desc;";
                            $res_rent = mysql_query($rent_query);

                            while ($row = mysql_fetch_array($res_rent, MYSQL_ASSOC)) {

                           $num=$row['num'];
                           $msg_from=$row['msg_from'];

                           $user_info_query="select * from user where id='$msg_from'";
                           $res_user=mysql_query($user_info_query);
                           $result_user=mysql_fetch_array($res_user,MYSQL_ASSOC);
                           $headimg=$result_user['headimg'];
                           $nickname=$result_user['nickname'];


                            ?>
                            <li class="sy_recmd_list">
                                <div class="box">
                                    <div class="pub_img">
                                        <a href="admin_pm.php?msg_to=<?php echo $msg_from ?>"><img
                                                src="<?php echo $headimg ?>"
                                                width="145" height="145"></a>
                                    </div>
                                    <div class="pub_wz">
                                        <h3 class="overflow_clear"><a href="#"><?php echo $nickname ?></a></h3>
                                        <div class="nr_box">
                                            <p class="fl fontcl2"><?php echo $num ?> Unread Message(s)</p>
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